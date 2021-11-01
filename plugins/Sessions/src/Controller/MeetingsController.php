<?php
declare(strict_types=1);
namespace Sessions\Controller;

use Sessions\Controller\AppController;
use Cake\Event\Event;
use GuzzleHttp\Client;
const BUFFER = 1024;

/**
 * SessionBookings Controller
 *
 * @property \Sessions\Model\Table\SessionBookingsTable $SessionBookings
 * @method \Sessions\Model\Entity\SessionBooking[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MeetingsController extends AppController
{
	public function index()
	{
		/* $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
		$arr_token = $this->get_access_token();
		$accessToken = $arr_token->access_token;
		try {
			$response = $client->request('GET', '/v2/users/me/meetings', [
				"headers" => [
					"Authorization" => "Bearer $accessToken"
				]
			]);
	 
			$data = json_decode($response->getBody()->getContents());
		} catch(Exception $e) {
			echo $e->getMessage();
		} */
		
		$query = $this->Meetings->find();
        $query->where(['Meetings.user_id' => $this->getRequest()->getAttribute('identity')->id]);
        $options['order'] = ['Meetings.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $meetings = $this->paginate($query);
        $this->set(compact('meetings'));
	}
	
	public function redirectZoomOauth()
	{
		$url = "https://zoom.us/oauth/authorize?response_type=code&client_id=".CLIENT_ID."&redirect_uri=".REDIRECT_URI;
		header("Location: ".$url);
		die();
	}
	
	public function createToken() {
		
		if(!empty($_GET['code'])) {		
			try {
				$client = new \GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
			 
				$response = $client->request('POST', '/oauth/token', [
					"headers" => [
						"Authorization" => "Basic ". base64_encode(CLIENT_ID.':'.CLIENT_SECRET)
					],
					'form_params' => [
						"grant_type" => "authorization_code",
						"code" => $_GET['code'] ?? '',
						"redirect_uri" => REDIRECT_URI
					],
				]);
				
				$token = $response->getBody()->getContents();
				$this->update_access_token($token);
				$this->Flash->success(__('Access token inserted successfully.'));
			} catch(Exception $e) {
				echo $e->getMessage();
			}
		} else {
			$this->Flash->error(__('There is some error to generate code.'));
		}
		return $this->redirect(['controller' => 'settings','action' => 'index']);
		die;
	}
	
	
	public function createMeeting() {
		$this->loadModel('Sessions.SessionBookings');
		$sessionBooking = \Cake\ORM\TableRegistry::getTableLocator()->get('Sessions.SessionBookings')
		->find('all')
		->contain(['Users', 'Teacher','Meetings']);
	
		$this->loadModel('Courses.Courses');
		$courses = \Cake\ORM\TableRegistry::getTableLocator()->get('Courses.Courses')
		->find('all')
		->contain(['ParentCourses', 'GradingTypes', 'Boards', 'Subjects', 'Users', 'Meetings']);
		$client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us'], ['http_errors' => false]);
		$arr_token = $this->get_access_token();
		$accessToken = $arr_token['access_token'];
		if(!empty($sessionBooking)) {
			foreach($sessionBooking as $value) {
		      if(empty($value->meetings) && $value->session_status == 1 && !empty($value->teacher->zoom_email)){
				 $topic = $value->topic;
				 $startTime = $value->start_date->format('Y-m-d').'T'.$value->start_date->format('H:i:s');
				 $duration = (strtotime($value->end_date->format('Y-m-d H:i:s')) - strtotime($value->start_date->format('Y-m-d H:i:s')))/60;
				 $time = (string) time();
				
				try {
					$email = $value->teacher->email;
					$response = $client->request('POST', '/v2/users/'.$email.'/meetings', [
						"headers" => [
							"Authorization" => "Bearer $accessToken",
							'Accept' => 'application/json'
						],
						'json' => [
							"topic" => $topic,
							"type" => 2,                              
							"start_time" => $startTime,
							"duration" => $duration, 
							"password" => substr($time, 4,10),
							"settings" => [
								"join_before_host" => true,
								"audio" => "voip",
								"auto_recording"=> "cloud"
							]
							
						],
					]);
					$requestData = json_decode($response->getBody()->getContents(), true);
					
					$requestData['meeting_id'] = $requestData['id'];
					$requestData['settings'] = json_encode($requestData['settings']);
					$requestData['session_booking_id'] = $value->id;
				} catch(\GuzzleHttp\Exception\RequestException $e) {
					if( 401 == $e->getCode() ) {
						$refresh_token = $this->get_refersh_token();
						$client = new \GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
						$response = $client->request('POST', '/oauth/token', [
							"headers" => [
								"Authorization" => "Basic ". base64_encode(CLIENT_ID.':'.CLIENT_SECRET)
							],
							'form_params' => [
								"grant_type" => "refresh_token",
								"refresh_token" => $refresh_token
							],
						]);
						$this->update_access_token($response->getBody()->getContents());
						$this->createMeeting();
					} else {
						$e->getMessage();
					}
				}
				$requestData['user_id'] = $value->teacher->id;
				if($requestData['session_booking_id']) {
					$meeting = $this->Meetings->newEmptyEntity();
					$meeting = $this->Meetings->patchEntity($meeting, $requestData);
					echo $this->Meetings->save($meeting);
				}
		      }
			}
		} 
		if(!empty($courses)) {
			foreach($courses as $value) {
		      if(empty($value->meetings) && !empty($value->start_date) && !empty($value->user->zoom_email)){
				$topic = $value->title;
				$startTime = $value->start_date->format('Y-m-d').'T'.$value->start_date->format('H:i:s');
				$duration = $value->duration;
				$time = (string) time();
				try {
					$email = $value->user->zoom_email;
					$response = $client->request('POST', '/v2/users/'.$email.'/meetings', [
						"headers" => [
							"Authorization" => "Bearer $accessToken",
							'Accept' => 'application/json'
						],
						'json' => [
							"topic" => $topic,
							"type" => 2,                              
							"start_time" => $startTime,
							"duration" => $duration, 
							"password" => substr($time, 4,10),
							"settings" => [
								"join_before_host" => true,
								"audio" => "voip",
								"auto_recording"=> "cloud"
							]
							
						],
					]);
					$requestData = json_decode($response->getBody()->getContents(), true);
					
					$requestData['meeting_id'] = $requestData['id'];
					$requestData['settings'] = json_encode($requestData['settings']);
					$requestData['course_id'] = $value->id;
				} catch(\GuzzleHttp\Exception\RequestException $e) {
					$e->getMessage();
				}
				$requestData['user_id'] = $value->user->id;
				if($requestData['course_id']) {
					$meeting = $this->Meetings->newEmptyEntity();
					$meeting = $this->Meetings->patchEntity($meeting, $requestData);
					echo $this->Meetings->save($meeting);
				}
				
		      }
			}
		}
		die;
		
	}
	public function createOrUpdateMeeting($sessionId,$id = null) {
		$this->loadModel('Sessions.SessionBookings');
		$sessionBooking = \Cake\ORM\TableRegistry::getTableLocator()->get('Sessions.SessionBookings')
		->get($sessionId, ['contain' => ['Users', 'Teacher', 'Subjects', 'GradingTypes', 'Boards', 'TeacherSchedules']]);
		
		$topic = $sessionBooking->subject->title.'('.$sessionBooking->board->title . " Grade " . $sessionBooking->grading_type->title .')';
		
		$startTime = $sessionBooking->booking_date->format('Y-m-d').'T'.$sessionBooking->booking_date->format('H-i-s');
		
		$duration = (strtotime($sessionBooking->teacher_schedule->end_at->format('Y-m-d H:i:s')) - strtotime($sessionBooking->teacher_schedule->start_at->format('Y-m-d H:i:s')))/3600;
		
		$client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us'], ['http_errors' => false]);
		$arr_token = $this->get_access_token();
		$accessToken = $arr_token['access_token'];
		$status = 1;
		if($id){
            $meeting = $this->Meetings->get($id, [
                'contain' => [],
            ]);
			$meetingArr = $meeting->toArray();
			
			$time = (string) time();
			$requestData = $this->request->getData();
			$requestData = $meetingArr;
			$requestData['topic'] = $topic;
			$requestData['type'] = 2;
			$requestData['start_time'] = $startTime;
			$requestData['duration'] = $duration;
			$requestData['password'] = substr($time, 4,10);
			try {
				$response = $client->request('PATCH', '/v2/meetings/'.$meeting->meeting_id, [
					"headers" => [
						"Authorization" => "Bearer $accessToken"
					],

					'json' => $data,
				]);
				if($response->getStatusCode() == 204) {
					$status = 1;
				}
			} catch(\GuzzleHttp\Exception\RequestException  $e) {
				echo $e->getMessage();
			}
			
        }else{
			$time = (string) time();
			try {
				$response = $client->request('POST', '/v2/users/'.$email.'/meetings', [
					"headers" => [
						"Authorization" => "Bearer $accessToken",
						'Accept' => 'application/json'
					],
					'json' => [
						"topic" => $topic,
						"type" => 2,                              
						"start_time" => $startTime,
						"duration" => $duration, 
						"password" => substr($time, 4,10),
						"settings" => [
							"join_before_host" => true,
							"audio" => "voip",
							"waiting_room" => false
						]
						
					],
				]);
				if($response->getStatusCode() == 201) {
					$status = 1;
				}
				$requestData = json_decode($response->getBody()->getContents(), true);
				$requestData['meeting_id'] = $requestData['id'];
				$requestData['settings'] = json_encode($requestData['settings']);
			} catch(\GuzzleHttp\Exception\RequestException $e) {
				if( 401 == $e->getCode() ) {
					$refresh_token = $this->get_refersh_token();
					$client = new \GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
					$response = $client->request('POST', '/oauth/token', [
						"headers" => [
							"Authorization" => "Basic ". base64_encode(CLIENT_ID.':'.CLIENT_SECRET)
						],
						'form_params' => [
							"grant_type" => "refresh_token",
							"refresh_token" => $refresh_token
						],
					]);
					$this->update_access_token($response->getBody()->getContents());
					$this->createOrUpdateMeeting();
				} else {
					$e->getMessage();
				}
			}
           $meeting = $this->Meetings->newEmptyEntity();
        }
		
		$requestData['user_id'] = $this->getRequest()->getAttribute('identity')->id;
		if ($status==1 && !empty($requestData['meeting_id'])) {
			$meeting = $this->Meetings->patchEntity($meeting, $requestData);
			if ($this->Meetings->save($meeting)) {
				$this->Flash->success(__('The meeting data has been saved.'));

				return $this->redirect(['controller' => 'SessionBookings','action' => 'index']);
			}
		}
		$this->Flash->error(__('The meeting could not be saved. Please, try again.'));
	}
	
	public function view($id) {
		
		/* $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
		$arr_token = $this->get_access_token();
		$accessToken = $arr_token->access_token;
		try {
			$response = $client->request('GET', '/v2/meetings/'.$meetingId, [
				"headers" => [
					"Authorization" => "Bearer $accessToken"
				]
			]);
	 
			$data = json_decode($response->getBody()->getContents());
		} catch(Exception $e) {
			echo $e->getMessage();
		} */
		$meeting = $this->Meetings->get($id, [
            'contain' => [],
        ]);
        $this->set(compact('meeting'));
	}
	
	public function delete($meetingId) {
		
		$client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
		$arr_token = $this->get_access_token();
		$accessToken = $arr_token['access_token'];
		$meeting = $this->Meetings->get($meetingId);
		try {
			$response = $client->request('DELETE', '/v2/meetings/'.$meeting->meeting_id, [
				"headers" => [
					"Authorization" => "Bearer $accessToken"
				]
			]);
			if($response->getStatusCode() == 204) { 
				$this->Meetings->delete($meeting);
			}
		} catch(Exception $e) {
			echo $e->getMessage();
		}
	}
	
	public function recording($id) {
		$client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
		$arr_token = $this->get_access_token();
		$accessToken = $arr_token['access_token'];
		$meeting = $this->Meetings->get($id);
		try {
			$response = $client->request('GET', '/v2/meetings/83163523979/recordings', [
				"headers" => [
					"Authorization" => "Bearer $accessToken"
				]
			]);
			echo 'test';
			
			$data = json_decode($response->getBody()->getContents());
			
		} catch(\GuzzleHttp\Exception\RequestException $e) {
			if( 401 == $e->getCode() ) {
				$refresh_token = $this->get_refersh_token();
				$response = $client->request('POST', '/oauth/token', [
					"headers" => [
						"Authorization" => "Basic ". base64_encode(CLIENT_ID.':'.CLIENT_SECRET)
					],
					'form_params' => [
						"grant_type" => "refresh_token",
						"refresh_token" => $refresh_token
					],
				]);
				$this->update_access_token($response->getBody()->getContents());
				$this->recording($id);
			} else {
				echo $e->getMessage();
			}
		}
		die;
	}
	
	public function updateStatus() {
		$client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
		$arr_token = $this->get_access_token();
		$accessToken = $arr_token['access_token'];
		$meetings = $this->Meetings->find()->where(['status' => 'waiting'])->all();
		if (!empty($meetings)) {
			foreach($meetings as $meeting) {
				$meetingTime = strtotime(date("Y-m-d H:i:s" ,strtotime($meeting->start_time."+".$meeting->duration.'minutes')));
				if($meetingTime < time()) {
					try {
						$response = $client->request('PUT', '/v2/meetings/'.$meeting->meeting_id.'/status', [
							"headers" => [
								"Authorization" => "Bearer $accessToken"
							],
							'json' => [
									"status" => 'end'
								],
						]);
						if($response->getStatusCode() == 204) {
							$requestData['status'] = 'end';
							$meeting = $this->Meetings->patchEntity($meeting, $requestData);
							if ($this->Meetings->save($meeting)) {
								$this->Flash->success(__('The meeting data has been saved.'));
								return $this->redirect(['controller' => 'SessionBookings','action' => 'index']);
							}
						}
						
					} catch(Exception $e) {
						echo $e->getMessage();
					}
				}
			}
		}
		die;
	}
	
	public function startMeeting() {
		$this->layout = false;
	}
	
	// Check is table empty
    public function is_table_empty() {
		$this->loadModel('Tokens');
		$result = $this->Tokens->find('all')->all()->toArray();
        if(!empty($result)) {
            return false;
        }
  
        return true;
    }
  
    // Get access token
    public function get_access_token() {
		$this->loadModel('Tokens');
		$result = $this->Tokens->find('all')->all()->toArray();
		if(!empty($result)) 
			return json_decode($result[0]['access_token'], true);
    }
  
    // Get referesh token
    public function get_refersh_token() {
        $this->loadModel('Tokens');
		$result = $this->Tokens->find('all')->all()->toArray();
		$result = json_decode($result[0]['access_token']);
        return $result->refresh_token;
    }
  
    // Update access token
    public function update_access_token($newToken) {
		$this->loadModel('Tokens');
		if(!$this->is_table_empty()) {
			$res = $this->Tokens->find('all')->all()->toArray();
				
			$token = $this->Tokens->get($res[0]->id, [
                'contain' => [],
            ]);
			$data['access_token'] = $newToken;
            $tokenSave = $this->Tokens->patchEntity($token, $data);
			$this->Tokens->save($tokenSave);
        }else{
            $token = $this->Tokens->newEmptyEntity();
			$data['access_token'] = $newToken;
            $tokenSave = $this->Tokens->patchEntity($token, $data);
			$this->Tokens->save($tokenSave);
        }
    }
}

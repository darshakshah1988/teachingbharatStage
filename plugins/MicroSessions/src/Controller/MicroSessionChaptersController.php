<?php
declare(strict_types=1);

namespace MicroSessions\Controller;
use \Firebase\JWT\JWT;


use MicroSessions\Controller\AppController;

/**
 * MicroSessionChapters Controller
 *
 * @method \MicroSessions\Model\Entity\MicroSessionChapter[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MicroSessionChaptersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($microsession_id = null)
    {

       // $course = $this->MicroSessionChapters->MicroSessions->get($microsession_id);
        $query = $this->MicroSessionChapters->find()->contain(['MicroSessions'])->where(['MicroSessionChapters.micro_session_id' => $microsession_id]);
       // $options['order'] = ['CourseChapters.position' => 'ASC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $microSessionChapters = $this->paginate($query);
        $this->set(compact('microSessionChapters','microsession_id'));
    }

    /**
     * View method
     *
     * @param string|null $id Micro Session Chapter id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null,$microsession_id=null)
    {
        $microSessionChapter = $this->MicroSessionChapters->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('microSessionChapter','microsession_id'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($microsession_id,$chapter_id = null)
    {

        if($chapter_id){
            $microSessionChapter = $this->MicroSessionChapters->get($chapter_id, [
                'contain' => [],
            ]);
        }else{
            $microSessionChapter = $this->MicroSessionChapters->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {

            $microSessionChapter = $this->MicroSessionChapters->patchEntity($microSessionChapter, $this->request->getData());
            $microSessionChapter->micro_session_id = $microsession_id;
            $microSessionChapter->listing_id = $this->getRequest()->getAttribute('identity')->listing_id;


              $date = date('Y-m-d H:i:s',(strtotime($microSessionChapter->start_date.' '.$microSessionChapter->start_time)));
              $date1 = strtotime($microSessionChapter->start_date.' '.$microSessionChapter->start_time);
              $date2 = strtotime($microSessionChapter->end_date.' '.$microSessionChapter->end_time);
              $duration = ($date2 - $date1) / 60;

              $data = array(
                  'title'        => $microSessionChapter->title,
                  'date'         => $date,
                  'duration'     => $duration,
                  'password'     => 00752,
                  'created_id'   => 1,
                  'api_type'     => 'global',
                  'host_video'   => 'enable',
                  'client_video' => 'enable',
                  'description'  => '',
                  'timezone'     => 'IST',
              );
              $response =  $this->createAMeeting($data);

            if(isset($response->id)){
                $microSessionChapter->zoom_meeting_id = $response->id;
                $microSessionChapter->zoom_url = $response->join_url;
            }

            if ($this->MicroSessionChapters->save($microSessionChapter)) {
                $this->Flash->success(__('The micro session chapter has been saved.'));

                return $this->redirect(['action' => 'index',$microsession_id]);
            }
            $this->Flash->error(__('The micro session chapter could not be saved. Please, try again.'));
        }
        $this->set(compact('microSessionChapter','microsession_id'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Micro Session Chapter id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null,$microsession_id=null)
    {
        $microSessionChapter = $this->MicroSessionChapters->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $microSessionChapter = $this->MicroSessionChapters->patchEntity($microSessionChapter, $this->request->getData());
            if ($this->MicroSessionChapters->save($microSessionChapter)) {
                $this->Flash->success(__('The micro session chapter has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The micro session chapter could not be saved. Please, try again.'));
        }
        $this->set(compact('microSessionChapter','microsession_id'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Micro Session Chapter id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */


    public function delete($id = null)
    {

        $this->request->allowMethod(['post', 'delete']);
        $microSessionChapter = $this->MicroSessionChapters->get($id);
        if ($this->MicroSessionChapters->delete($microSessionChapter)) {
            $result = ['status' => true, 'message' => __('The micro session chapter has been deleted.')];
        } else {
            $result = ['status' => false, 'message' => __('The micro session chapter could not be deleted. Please, try again.')];
        }

        $this->set([
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'data' => $microSessionChapter,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);
        //$this->set(compact('microSessionChapters'));
    }

    protected function sendRequest($data){
        $request_url = 'https://api.zoom.us/v2/users/me/meetings';
        $headers     = array(
            'authorization: Bearer ' . $this->generateJWTKey(),
            'content-type: application/json',
        );
        $postFields = json_encode($data);
        $ch         = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response    = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err         = curl_error($ch);
        curl_close($ch);
        if (!$response) {
            return false;
        }
        return json_decode($response);
    }

    private function generateJWTKey()
    {
        $zoom_api_key    = 'B0RWdIUDR4a-7vQQ3u2Q5g';
        $zoom_api_secret = 'QEANdwmjvawOjbaq1h0OMvcEDd6wlMi0RXe9';

        $key    = $zoom_api_key;
        $secret = $zoom_api_secret;
        $token  = array(
            "iss" => $key,
            "exp" => time() + 3600,
        );
        return JWT::encode($token, $secret);
    }

    public function createAMeeting($data = array()){
        $post_time           = $data['date'];
        $start_time          = date("Y-m-d\TH:i:s", strtotime($post_time));
        $createAMeetingArray = array();
        if (!empty($data['alternative_host_ids'])) {
            if (count($data['alternative_host_ids']) > 1) {
                $alternative_host_ids = implode(",", $data['alternative_host_ids']);
            } else {
                $alternative_host_ids = $data['alternative_host_ids'][0];
            }
        }
        $createAMeetingArray['topic']      = $data['title'];
        $createAMeetingArray['agenda']     = "";
        $createAMeetingArray['type']       = 2;
        $createAMeetingArray['start_time'] = $start_time;
        $createAMeetingArray['timezone']   = $data['timezone'];
        $createAMeetingArray['password']   = !empty($data['password']) ? $data['password'] : "";
        $createAMeetingArray['duration']   = !empty($data['duration']) ? $data['duration'] : 60;
        $createAMeetingArray['settings']   = array(
            'join_before_host'  => false,
            'host_video'        =>  true,
            'participant_video' => true,
            'mute_upon_entry'   => false,
            'enforce_login'     => false,
            'auto_recording'    => "none",
            'alternative_hosts' => isset($alternative_host_ids) ? $alternative_host_ids : "",
        );
        return $this->sendRequest($createAMeetingArray);
    }


    public function getZoomRecordings($meetingID = NULL){

        if(!empty($meetingID)){
            $request_url = 'https://api.zoom.us/v2/meetings/'.$meetingID.'/recordings';
            $headers     = array(
                'authorization: Bearer ' . $this->generateJWTKey(),
                'content-type: application/json',
            );
            $ch         = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $request_url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            $response    = curl_exec($ch);
            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $err         = curl_error($ch);
            curl_close($ch);

            $response = json_decode($response);
            $recordingFiles = '';
            if(isset($response->recording_files) && count($response->recording_files) > 0){
                foreach($response->recording_files as $recordingFile){
                    $recordingFiles = $recordingFile->play_url;
                }
            }
            if(!empty($recordingFiles)){echo($recordingFiles);die;}
        }
        echo 'fileNotAvailable';die;

    }

}

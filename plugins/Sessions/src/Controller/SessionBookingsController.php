<?php
declare(strict_types=1);
namespace Sessions\Controller;

use Sessions\Controller\AppController;
use Cake\Event\Event;
use Cake\View\ViewBuilder;
/**
 * SessionBookings Controller
 *
 * @property \Sessions\Model\Table\SessionBookingsTable $SessionBookings
 * @method \Sessions\Model\Entity\SessionBooking[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SessionBookingsController extends AppController
{
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->SessionBookings->find();
        $query->contain(['Users', 'Teacher', 'Meetings']);


        if($this->getRequest()->getAttribute('identity')->role == "teacher"){
            $query->where(['SessionBookings.teacher_id' => $this->getRequest()->getAttribute('identity')->id]);
        }else{
            $query->where(['SessionBookings.user_id' => $this->getRequest()->getAttribute('identity')->id]);
        }
       
        $options['order'] = ['SessionBookings.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $sessionBookings = $this->paginate($query);
        
        $this->set(compact('sessionBookings'));
    }

    /**
     * scheduled method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function scheduled()
    {
        $query = $this->SessionBookings->find('upcoming');
        $query->contain(['Users', 'Teacher', 'Subjects', 'GradingTypes', 'Boards', 'TeacherSchedules']);
        if($this->getRequest()->getAttribute('identity')->role == "teacher"){
            $query->where(['SessionBookings.teacher_id' => $this->getRequest()->getAttribute('identity')->id]);
        }else{
            $query->where(['SessionBookings.user_id' => $this->getRequest()->getAttribute('identity')->id]);
        }
        $options['order'] = ['SessionBookings.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $sessionBookings = $this->paginate($query);
        //dd($sessionBookings->toArray());
        $this->set(compact('sessionBookings'));
    }

    /**
     * View method
     *
     * @param string|null $id Session Booking id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sessionBooking = $this->SessionBookings->get($id, [
            'contain' => ['Users', 'Teacher'],
        ]);

        $this->set(compact('sessionBooking'));
    }

    /**
     * sessionRequest method
     *
     * @param string|null $id Session Booking id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function sessionRequest($id = null)
    {
        $sessionBooking = $this->SessionBookings->get($id, [
            'contain' => ['Users', 'Teacher'],
        ]);

        $this->set(compact('sessionBooking'));
    }

    /**
     * sessionModify method
     *
     * @param string|null $id Session Booking id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function sessionModify($id = null)
    {
        $sessionBooking = $this->SessionBookings->get($this->request->getQuery('id'), [
            'contain' => ['Users', 'Teacher'],
        ]);

        $subjects = $this->SessionBookings->Users->UserProfiles->PrimarySubjects->find('list', ['limit' => 200]);
        $gradingTypes = $this->SessionBookings->Users->GradingTypes->find('list', ['limit' => 200]);
        $user_id = $sessionBooking->teacher_id;
        $teacherSchedules = $this->SessionBookings->Users->TeacherSchedules->find('list', ['limit' => 200])
        ->matching("Users", function($q) use($user_id){
            return $q->where(['Users.id' => $user_id]);
        });
        $boards = $this->SessionBookings->Users->Boards->find('list', ['limit' => 200]);

        $this->set(compact('sessionBooking', 'subjects', 'gradingTypes', 'teacherSchedules', 'boards'));
    }

 
    /**
     * Add/Edit method
     * Edit: param string|null $id Session Booking id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $sessionBooking = $this->SessionBookings->get($id, [
                'contain' => [],
            ]);
        }else{
            $sessionBooking = $this->SessionBookings->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $sessionBooking = $this->SessionBookings->patchEntity($sessionBooking, $this->request->getData());
            if ($this->SessionBookings->save($sessionBooking)) {
                $this->Flash->success(__('The session booking has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The session booking could not be saved. Please, try again.'));
        }
        $users = $this->SessionBookings->Users->find('list', ['limit' => 200]);
        $subjects = $this->SessionBookings->Subjects->find('list', ['limit' => 200]);
        $gradingTypes = $this->SessionBookings->GradingTypes->find('list', ['limit' => 200]);
        $boards = $this->SessionBookings->Boards->find('list', ['limit' => 200]);
        $teacherSchedules = $this->SessionBookings->TeacherSchedules->find('list', ['limit' => 200]);
        $this->set(compact('sessionBooking', 'users', 'subjects', 'gradingTypes', 'boards', 'teacherSchedules'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Session Booking id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function book($user_id)
    {
        $sessionBooking = $this->SessionBookings->newEmptyEntity();
        //dd($this->request->getData());
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sessionBooking = $this->SessionBookings->patchEntity($sessionBooking, $this->request->getData());
            $sessionBooking->teacher_id = $user_id;
            $sessionBooking->user_id = $this->getRequest()->getAttribute('identity')->id;
            if ($this->SessionBookings->save($sessionBooking)) {
                $event = new Event('Users.User.afterSessionBooked', $this, ['data' => $sessionBooking]);
                $this->getEventManager()->dispatch($event); 
                $result = ['status' => true, 'message' => __('You have successfully registered for this session.')];
            }else{
                $result = ['status' => false, 'message' => __('The session booking could not be saved. Please, try again.')];
            }

        }
        
        $this->set([
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'data' => $sessionBooking,
            'errors' => $sessionBooking->getErrors(),
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);
    }


     /**
     * modify method
     *
     * @param string|null $id Session Booking id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function sessionRescheduled($id)
    {
       $sessionBooking = $this->SessionBookings->get($id, [
                'contain' => [],
            ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sessionBooking = $this->SessionBookings->patchEntity($sessionBooking, $this->request->getData());
            if ($this->SessionBookings->save($sessionBooking)) {
                $event = new Event('Users.User.afterRescheduleSession', $this, ['data' => $sessionBooking]);
            $this->getEventManager()->dispatch($event); 
                $result = ['status' => true, 'message' => __('The session booking time has been rescheduled.')];
            }else{
                $result = ['status' => false, 'message' => __('The session booking time rescheduled could not be saved. Please, try again.')];
            }

        }
        
        $this->set([
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'data' => $sessionBooking,
            'errors' => $sessionBooking->getErrors(),
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);
    }

    /**
     * sessionStatus method
     *
     * @param string|null $id Session Booking id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function sessionStatus()
    {
        $sessionBooking = $this->SessionBookings->get($this->request->getData('id'), [
                'contain' => ['Users', 'Teacher'],
            ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data['session_status'] = $this->request->getData('session_status');
            if($this->request->getData('reason')){
                $data['reason'] = $this->request->getData('reason');
            }
            $sessionBooking = $this->SessionBookings->patchEntity($sessionBooking, $data);
            if ($this->SessionBookings->save($sessionBooking)) {
                $event = new Event('Users.User.afterChangeSessionStatus', $this, ['data' => $sessionBooking, 'role' => $this->getRequest()->getAttribute('identity')->role]);
            $this->getEventManager()->dispatch($event); 
                $result = ['status' => true, 'message' => __('The session booking status has been updated.')];
            }else{
                $result = ['status' => false, 'message' => __('The session booking status could not be updated. Please, try again.')];
            }

        }
        
        $this->set([
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'data' => $sessionBooking,
            'errors' => $sessionBooking->getErrors(),
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);
    }


    /**
     * Delete method
     *
     * @param string|null $id Session Booking id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sessionBooking = $this->SessionBookings->get($id);
        if ($this->SessionBookings->delete($sessionBooking)) {
            $this->Flash->success(__('The session booking has been deleted.'));
        } else {
            $this->Flash->error(__('The session booking could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function joinSession()
	{
	}
	public function startMeeting() {
		//$this->viewBuilder->layout(false);
		//$this->viewBuilder()->autoLayout(false);
		$this->layout='ajax';



		//$this->viewBuilder()->enableAutoLayout(false);

	}
}

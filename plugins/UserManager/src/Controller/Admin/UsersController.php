<?php
declare(strict_types=1);

namespace UserManager\Controller\Admin;

use UserManager\Controller\AppController;
use Cake\Core\Configure;
use Cake\Event\Event;
/**
 * Users Controller
 *
 * @property \UserManager\Model\Table\UsersTable $Users
 * @method \UserManager\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Users->find('teacher')->contain(['UserProfiles']);
        $options['order'] = ['Users.created' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $users = $this->paginate($query);
        //dd($users->toArray());
        $this->set(compact('users'));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function students($type = "student")
    {
        $query = $this->Users->find('student')->contain(['UserProfiles']);
        $options['order'] = ['Users.created' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $users = $this->paginate($query);
        $this->set(compact('users', 'type'));
        $this->render('index');
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->findById($id)->contain(['GradingTypes', 'TeacherSchedules', 'UserProfiles.Occupations', 'UserProfiles.PrimarySubjects', 'UserProfiles.SecondarySubjects', 'UserProfiles.Locations', 'SocialAccounts', 'Boards', 'UserDocuments'])->firstOrFail();
            //dd($user);
        $this->set(compact('user'));
    }

 
    /**
     * Add/Edit method
     * Edit: param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $user = $this->Users->get($id, [
                'contain' => ['UserProfiles', 'GradingTypes', 'TeacherSchedules', 'Boards'],
            ]);
        }else{
            $user = $this->Users->newEmptyEntity(); 
        }
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
			///dd($user);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The {0} detail has been saved.', $user->role));
                if($user->role == "teacher"){
                    return $this->redirect(['action' => 'index']); 
                }
                return $this->redirect(['action' => 'students']); 
                
            }

            $this->Flash->error(__('The {0} detail could not be saved. Please, try again.', $user->role));
        }
        $gradingTypes = $this->Users->GradingTypes->find('list', ['limit' => 200]);
        $boards = $this->Users->Boards->find('list', ['limit' => 200]);
        $teacherSchedules = $this->Users->TeacherSchedules->find('list', ['limit' => 200]);
        $locations = $this->Users->UserProfiles->Locations->ParentLocations->find('treeList', ['keyField' => 'id', 'valueField' => 'title'])->toArray();
        $subjects = $this->Users->UserProfiles->PrimarySubjects->find('list', ['limit' => 200]);
        $occupations = $this->Users->UserProfiles->Occupations->find('list', ['limit' => 200])->where(['Occupations.status' => 1]); 
        $this->set(compact('user', 'gradingTypes', 'teacherSchedules', 'locations', 'boards', 'subjects', 'occupations'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['GradingTypes', 'TeacherSchedules'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $gradingTypes = $this->Users->GradingTypes->find('list', ['limit' => 200]);
        $teacherSchedules = $this->Users->TeacherSchedules->find('list', ['limit' => 200]);
        $this->set(compact('user', 'gradingTypes', 'teacherSchedules'));
    }

    /**
     * userStatus method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function userStatus($id)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]); 
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->updateToken(Configure::read('Users.Token.expiration'));
            if ($this->Users->save($user)) {
                $user->setHidden(['password', 'token_expires', 'api_token']);
                $event = new Event('Users.Teacher.afterApproved', $this, ['user' => $user]);
                $this->getEventManager()->dispatch($event); 

                $result = ['status' => true, 'message' => __('The teacher status has been saved.')];
            }else{
                $result = ['status' => false,'message' => 'The teacher status could not be saved. Please, try again.', 'errors' => $user->getErrors()];
            }
        }
        $this->set([
            'user'=> $user,
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message', 'errors']);
    }


    /**
     * fileDownload method
     *
     * @param string|null $id Media id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function fileDownload($id)
    {
        $mediaImg = $this->Users->UserProfiles->find()->contain(['Users'])->where(['UserProfiles.id'=>$id])->first();
        $nominate_file_path = WWW_ROOT .'img/'. $mediaImg->resume_path."/".$mediaImg->resume;
        if (!empty($mediaImg->resume_path) && !empty($mediaImg->resume) && file_exists("img/".$mediaImg->resume_path . $mediaImg->resume)) {
            $ext = pathinfo($mediaImg->resume, PATHINFO_EXTENSION);
            //echo $ext;die;
            $uname = strtolower(str_replace(" ","_",$mediaImg->user->name));
            return $response = $this->response->withFile(
                $nominate_file_path,
                    ['download' => true, 'name' => $uname.".".$ext]
                );

        }else{
            $this->Flash->error(__('This file is not available.'));
            $this->redirect($this->referer());
        }
    }

    /**
     * download method
     *
     * @param string|null $id Media id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function uDocdownload($id)
    { 

        $userDocument = $this->Users->UserDocuments->find()->contain(['Users'])
                        ->where(['UserDocuments.id'=>$id])->FirstOrFail();
        $nominate_file_path = WWW_ROOT .'img/'. $userDocument->document_file_path."/".$userDocument->document_file;
        if (!empty($userDocument->document_file_path) && !empty($userDocument->document_file) && file_exists("img/".$userDocument->document_file_path . $userDocument->document_file)) {
            $ext = pathinfo($userDocument->document_file, PATHINFO_EXTENSION);
            //echo $ext;die;
            $uname = strtolower(str_replace(" ","_",\Cake\Core\Configure::read('constants.DOCUMENT_TYPE')[$userDocument->document_type_id] ?? ""));
            return $response = $this->response->withFile(
                $nominate_file_path,
                    ['download' => true, 'name' => $uname.".".$ext]
                );

        }else{
            $this->Flash->error(__('This file is not available.'));
            $this->redirect($this->referer());
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Location id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $result = ['status' => true, 'message' => __('The user has been deleted.')];
        } else {
            $result = ['status' => false, 'message' => __('The user could not be deleted. Please, try again.')];
        }

        $this->set([
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'data' => $user,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteOld($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

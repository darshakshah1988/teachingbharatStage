<?php
declare(strict_types=1);

namespace MicroSessions\Controller;

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
            // echo "<pre>";
             //print_r($microSessionChapter);
             //die();
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


    
}

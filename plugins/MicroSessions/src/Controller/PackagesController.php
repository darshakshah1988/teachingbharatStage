<?php
declare(strict_types=1);

namespace MicroSessions\Controller;

use MicroSessions\Controller\AppController;

/**
 * Packages Controller
 *
 * @method \MicroSessions\Model\Entity\Package[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PackagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $packages = $this->paginate($this->Packages);

        $this->set(compact('packages'));
    }

    /**
     * View method
     *
     * @param string|null $id Package id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $package = $this->Packages->get($id, [
            'contain' => [],
        ]);

        $gradingTypes = $this->Packages->GradingTypes->find('list', ['limit' => 200]);
        $boards = $this->Packages->Boards->find('list', ['limit' => 200]);
        $subjects = $this->Packages->Subjects->find('list', ['limit' => 200]);
        $this->set(compact('package',  'gradingTypes', 'boards', 'subjects'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
       $package = $this->Packages->newEmptyEntity();
       if ($this->request->is(['patch', 'post', 'put'])) {
            $package = $this->Packages->patchEntity($package, $this->request->getData());
            $package->user_id = $this->getRequest()->getAttribute('identity')->id;
            $subjectid = $this->request->getData('subject_id');
            $package->subject_id =  implode(",", $subjectid);
            if ($this->Packages->save($package)) {
            $this->Flash->success(__('The package has been saved.'));
            return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The package could not be saved. Please, try again.'));
        }

        $gradingTypes = $this->Packages->GradingTypes->find('list', ['limit' => 200]);
        $boards = $this->Packages->Boards->find('list', ['limit' => 200]);
        $subjects = $this->Packages->Subjects->find('list', ['limit' => 200]);
        $this->set(compact('package',  'gradingTypes', 'boards', 'subjects'));

    }

    /**
     * Edit method
     *
     * @param string|null $id Package id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $package = $this->Packages->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $package = $this->Packages->patchEntity($package, $this->request->getData());
            $subjectid = $this->request->getData('subject_id');
            $package->subject_id =  implode(",", $subjectid);
            if ($this->Packages->save($package)) {
                $this->Flash->success(__('The package has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The package could not be saved. Please, try again.'));
        }
         $gradingTypes = $this->Packages->GradingTypes->find('list', ['limit' => 200]);
        $boards = $this->Packages->Boards->find('list', ['limit' => 200]);
        $subjects = $this->Packages->Subjects->find('list', ['limit' => 200]);

        $this->set(compact('package',  'gradingTypes', 'boards', 'subjects'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Package id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $package = $this->Packages->get($id);
        if ($this->Packages->delete($package)) {
       $result = ['status' => true, 'message' => __('The package has been deleted.')];
        } else {
            $result = ['status' => false, 'message' => __('The package could not be deleted. Please, try again.')];
        }
        $this->set([
                    'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
                    'status' => $result['status'] ?? null,
                    'message' => $result['message'] ?? null,
                    'data' => $package,
                    'errors' => $result['errors'] ?? null,
                    ]);
                $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);
    }
}

<?php
declare(strict_types=1);

namespace EmailManager\Controller\Admin;

use EmailManager\Controller\AppController;

/**
 * EmailHooks Controller
 *
 * @property \EmailManager\Model\Table\EmailHooksTable $EmailHooks
 *
 * @method \EmailManager\Model\Entity\EmailHook[] paginate($object = null, array $settings = [])
 */
class EmailHooksController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $query = $this->EmailHooks->find('domain');
        $query->order(['EmailHooks.id' => 'DESC']);
        $emailHooks = $query->all();
        $this->Authorization->authorize($query); 
        $canEmailHook = $this->EmailHooks->newEmptyEntity();
        $this->set(compact('emailHooks', 'canEmailHook'));
    }

    /**
     * View method
     *
     * @param string|null $id Email Hook id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $emailHook = $this->EmailHooks->get($id, [
            'contain' => ['EmailTemplates']
        ]);
        $this->Authorization->authorize($emailHook);
        $this->set('emailHook', $emailHook);
        $this->set('_serialize', ['emailHook']);
    }

    /**
     * Add/Edit method
     *
     * case: add
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * cse: edit
     * @param string|null $id Email Hook id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null) {

        if ($id) {
            $emailHook = $this->EmailHooks->get($id, [
                'contain' => []
            ]);
        } else {
            $emailHook = $this->EmailHooks->newEmptyEntity();
        }
        if (!$this->Authorization->can($emailHook, 'create')) {
            if (!$this->request->is('Ajax')) {
                $this->Flash->error(__('You don\'t have permission to access email hook add form.'));
                return $this->redirect(['action' => 'index']);
            }else{
                return ['status' => false, 'message' => 'You don\'t have permission to access email hook add form.'];
            }
        }
        if ($this->request->is(['post', 'patch', 'put'])) {
            $emailHook = $this->EmailHooks->patchEntity($emailHook, $this->request->getData());
            if ($this->EmailHooks->save($emailHook)) {
                $status = true;
                $message = __('The email hook has been saved.');
                if (!$this->request->is('Ajax')) {
                    $this->Flash->success($message);
                    return $this->redirect(['action' => 'index']);
                } else {
                    $result = ['status' => $status, 'message' => $message];
                }
            }else{
                if ($this->request->is('Ajax')){
                    $result = ['status' => false,'message' => 'The email hook could not be saved. Please, try again.', 'errors' => $emailHook->getErrors()];
                }else{
                    $this->Flash->error(__('The email hook could not be saved. Please, try again.'));
                }
            }

        }
        $hooks = $this->EmailHooks->find('domain')->order(['EmailHooks.id' => 'DESC'])->all();
        $this->set([
                'emailHook'=> $emailHook,
                'hooks' => $hooks,
                'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
                'status' => $result['status'] ?? null,
                'message' => $result['message'] ?? null,
                'errors' => $result['errors'] ?? null,
                ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message', 'errors']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Email Hook id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $emailHook = $this->EmailHooks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $emailHook = $this->EmailHooks->patchEntity($emailHook, $this->request->getData());
            if ($this->EmailHooks->save($emailHook)) {
                $this->Flash->success(__('The email hook has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email hook could not be saved. Please, try again.'));
        }
        $this->set(compact('emailHook'));
        $this->set('_serialize', ['emailHook']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Email Hook id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $emailHook = $this->EmailHooks->get($id);
        if (!$this->Authorization->can($emailHook, 'create')) {
            return ['status' => false, 'message' => 'You don\'t have permission to delete email hook.'];
        }
        if ($this->EmailHooks->delete($emailHook)) {
            $result = ['status' => true, 'message' => __('The email hook has been deleted.')];
        } else {
            $result = ['status' => false, 'message' => __('The email hook could not be deleted. Please, try again.')];
        }
        $this->set([
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message', 'errors']);
    }

   /**
     * ChangeFlag method
     *
     * @param string|null &id Admin User id.
     * @param string|null &id field those update table field.
     * @param string|null &status Admin status.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function changeFlag()
    {
        if ($this->request->is('ajax') && $this->request->getData('id')) {
            $status = $this->EmailHooks->newEmptyEntity();
            $field = $this->request->getData('field');
            $status->id = $this->request->getData('id');
            $status->$field = $this->request->getData('status');
            if ($this->EmailHooks->save($status)) {
                $msg = $this->request->getData($field) == 1 ? __("Your {$field} has activated") : __("Your {$field} has deactivated");
                $response = ["success" => true, "err_msg" => $msg];
            } else {
                $response = ["success" => false, "err_msg" => __("Your Process faild. please try again!!")];
            }
            $this->set([
            'success' => $response['success'],
            'responce' => 200,
            'message' => $response['err_msg'],
            '_jsonOptions' => JSON_FORCE_OBJECT,
            '_serialize' => ['success', 'responce', 'message']
        ]);

        }
    }

}

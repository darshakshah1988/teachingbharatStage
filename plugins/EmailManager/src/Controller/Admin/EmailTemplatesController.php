<?php
declare(strict_types=1);

namespace EmailManager\Controller\Admin;

use EmailManager\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * EmailTemplates Controller
 *
 * @property \EmailManager\Model\Table\EmailTemplatesTable $EmailTemplates
 *
 * @method \EmailManager\Model\Entity\EmailTemplate[] paginate($object = null, array $settings = [])
 */
class EmailTemplatesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $query = $this->EmailTemplates->find('domain');
        $query->contain(['EmailHooks' , 'EmailPreferences']);
        $query->order(['EmailTemplates.id' => 'DESC']);
        $this->Authorization->authorize($query);
        $emailTemplates = $query->all();
        $emailHooks = $this->EmailTemplates->EmailHooks->find('list', ['limit' => 200,'conditions'=>['EmailHooks.status'=>1]])->find('domain');
        $emailPreferences = $this->EmailTemplates->EmailPreferences->find('list', ['limit' => 200])->find('domain');
        $canEmailTemplates = $this->EmailTemplates->newEmptyEntity();
        $this->set(compact('emailTemplates','emailHooks','emailPreferences', 'canEmailTemplates'));
        $this->set('_serialize', ['emailTemplates']);
    }

    /**
     * View method
     *
     * @param string|null $id Email Template id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $emailTemplate = $this->EmailTemplates->get($id, [
            'contain' => ['EmailHooks', 'EmailPreferences']
        ]);
        $this->Authorization->authorize($emailTemplate);
        $this->set('emailTemplate', $emailTemplate);
        $this->set('_serialize', ['emailTemplate']);
    }

    /**
     * Add/Edit method
     *
     * case: add
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * cse: edit
     * @param string|null $id Email Template id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function add($id = null) {

        if ($id) {
            $emailTemplate = $this->EmailTemplates->get($id, [
                'contain' => []
            ]);
        } else {
            $emailTemplate = $this->EmailTemplates->newEmptyEntity();
        }
        if (!$this->Authorization->can($emailTemplate, 'create')) {
            if (!$this->request->is('Ajax')) {
                $this->Flash->error(__('You don\'t have permission to access email template add form.'));
                return $this->redirect(['action' => 'index']);
            }else{
                return ['status' => false, 'message' => 'You don\'t have permission to access email template add form.'];
            }
        }
        if ($this->request->is(['post', 'patch', 'put'])) {
            $emailTemplate = $this->EmailTemplates->patchEntity($emailTemplate, $this->request->getData());
            if ($this->EmailTemplates->save($emailTemplate)) {
                $status = true;
                $message = __('The email template has been saved.');
                if (!$this->request->is('Ajax')) {
                    $this->Flash->success($message);
                    return $this->redirect(['action' => 'index']);
                } else {
                    $result = ['status' => $status, 'message' => $message];
                }
            }else{
                if ($this->request->is('Ajax')){
                    $result = ['status' => false,'message' => 'The email template could not be saved. Please, try again.', 'errors' => $emailTemplate->getErrors()];
                }else{
                    $this->Flash->error(__('The email template could not be saved. Please, try again.'));
                }
            }
        }
        $emailHooks = $this->EmailTemplates->EmailHooks->find('domain')->find('list', ['limit' => 200,'conditions'=>['EmailHooks.status'=>1]]);
        $emailPreferences = $this->EmailTemplates->EmailPreferences->find('domain')->find('list', ['limit' => 200]);
        $templates = $this->EmailTemplates->find()->find('domain')->contain(['EmailHooks'])->order(['EmailTemplates.id' => 'DESC'])->limit(10)->all();

        $this->set([
            'emailTemplate'=> $emailTemplate,
            'emailHooks' => $emailHooks,
            'emailPreferences' => $emailPreferences,
            'templates' => $templates,
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
     * @param string|null $id Email Template id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $emailTemplate = $this->EmailTemplates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $emailTemplate = $this->EmailTemplates->patchEntity($emailTemplate, $this->request->getData());
            if ($this->EmailTemplates->save($emailTemplate)) {
                $this->Flash->success(__('The email template has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email template could not be saved. Please, try again.'));
        }
        $emailHooks = $this->EmailTemplates->EmailHooks->find('list', ['limit' => 200])->find('domain');
        $emailPreferences = $this->EmailTemplates->EmailPreferences->find('list', ['limit' => 200])->find('domain');
        $this->set(compact('emailTemplate', 'emailHooks', 'emailPreferences'));
        $this->set('_serialize', ['emailTemplate']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Email Template id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $emailTemplates = $this->EmailTemplates->get($id);
        if (!$this->Authorization->can($emailTemplates, 'create')) {
            return ['status' => false, 'message' => 'You don\'t have permission to delete email template.'];
        }
        if ($this->EmailTemplates->delete($emailTemplates)) {
            $result = ['status' => true, 'message' => __('The email template has been deleted.')];
        } else {
            $result = ['status' => false, 'message' => __('The email template could not be deleted. Please, try again.')];
        }
        $this->set([
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message', 'errors']);
    }



}

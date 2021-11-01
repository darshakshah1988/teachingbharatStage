<?php
declare(strict_types=1);

namespace Settings\Controller\Admin;

use Settings\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * Settings Controller
 *
 * @method \Settings\Model\Entity\Setting[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SettingsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Settings->find('domain');
        $options['order'] = ['Settings.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $query->where(['Settings.manager' => 'general']);
        $this->paginate = $options;
        $this->Authorization->authorize($query);
        $settings = $this->paginate($query);
        $this->set(compact('settings'));
    }

    /**
     * View method
     *
     * @param string|null $id Setting id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $setting = $this->Settings->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($setting);
        $this->set(compact('setting'));
    }


    /**
     * Add/Edit method
     * Edit: param string|null $id Setting id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $setting = $this->Settings->get($id, [
                'contain' => [],
            ]);
        }else{
            $setting = $this->Settings->newEmptyEntity();
        }
        $this->Authorization->authorize($setting, 'create');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request = $this->request->withData('manager','general');
            $setting = $this->Settings->patchEntity($setting, $this->request->getData());
            if ($this->Settings->save($setting)) {
                $this->Flash->success(__('The setting has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The setting could not be saved. Please, try again.'));
        }

        $this->set(compact('setting'));
    }

    /**
     * logos method
     * Comments: add front, admin, logos and fav icons
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function logos() {
        $setting = $this->Settings->find('domain')->find('logos')->all();
        $this->Authorization->authorize($this->Settings->newEmptyEntity(), 'create');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $setting = $this->Settings->patchEntities($setting, $this->request->getData(), ['validate' => 'logo']);
            //dd($setting);
            if ($this->Settings->saveMany($setting)) {
                $this->Flash->success(__('Theme file details has been saved.'));
                return $this->redirect(['action' => 'logos']);
            } else {
                $this->Flash->error(__('Theme file details could not be saved. Please, try again.'));
            }
        }
        $_dir = str_replace("\\", "/", $this->Settings->_dir);
        $this->set(compact('setting','_dir'));
    }

    /**
     * upload logo file method
     * Comments: add front, admin, logos and fav icons
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function uploads() {
        $this->Authorization->authorize($this->Settings->newEmptyEntity(), 'create');
        if ($this->request->is("Ajax")) {
            $is_dest = "img/tmp/";
            if (!file_exists($is_dest)) {
                //mkdir($is_dest, 0777, true);
                $dir = new Folder(WWW_ROOT . 'img/tmp/', true, 0755);
                $is_dest = $dir->path;
            }
            $fileData = $this->request->getData('file');
            if (strlen($fileData->getClientFilename()) > 1) {
                $ext = pathinfo($fileData->getClientFilename(), PATHINFO_EXTENSION);
                $allowedExt = array('gif', 'jpeg', 'png', 'jpg', 'tif', 'bmp', 'ico');
                if ($this->request->getData('allow_ext')) {
                    $allowedExt = explode(",", $this->request->getData('allow_ext'));
                }
                if (in_array(strtolower($ext), $allowedExt)) {
                    $upload_img = $fileData->getClientFilename();
                    $ran = time();
                    $upload_img = $ran . "_" . $fileData->getClientFilename();
                    if (strlen($upload_img) > 100) {
                        $upload_img = $ran . "_" . rand() . "." . $ext;
                    }
                    $upload_img = str_replace(' ', '_', $upload_img);
                    $fileData->moveTo($is_dest . $upload_img);
                    $data['filename'] = $upload_img;
                    $data['image_path'] = $this->request->getAttribute("webroot") . "img/tmp/" . $upload_img;
                    $data['success'] = true;
                    $data['message'] = "file successfully uploaded!";
                } else {
                    $data['success'] = false;
                    $data['message'] = "invalid file type!";
                }
            } else {
                $data['success'] = false;
                $data['message'] = "invalid file!";
            }
        }
        $this->set($data);
        $this->viewBuilder()->setOption('serialize', ['filename', 'image_path','success', 'message']);
    }


    /**
     * Edit method
     *
     * @param string|null $id Setting id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $setting = $this->Settings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $setting = $this->Settings->patchEntity($setting, $this->request->getData());
            if ($this->Settings->save($setting)) {
                $this->Flash->success(__('The setting has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The setting could not be saved. Please, try again.'));
        }
        $this->set(compact('setting'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Setting id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteNoAjax($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $setting = $this->Settings->get($id);
        if ($this->Settings->delete($setting)) {
            $this->Flash->success(__('The setting has been deleted.'));
        } else {
            $this->Flash->error(__('The setting could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
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
        $settings = $this->Settings->get($id);
        if (!$this->Authorization->can($settings, 'create')) {
            return ['status' => false, 'message' => 'You don\'t have permission to delete setting.'];
        }
        if ($this->Settings->delete($settings)) {
            $result = ['status' => true, 'message' => __('The setting has been deleted.')];
        } else {
            $result = ['status' => false, 'message' => __('The setting could not be deleted. Please, try again.')];
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

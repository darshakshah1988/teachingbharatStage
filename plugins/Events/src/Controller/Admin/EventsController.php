<?php
declare(strict_types=1);

namespace Events\Controller\Admin;

use Events\Controller\AppController;

/**
 * Events Controller
 *
 * @property \Events\Model\Table\EventsTable $Events
 * @method \Events\Model\Entity\Event[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EventsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Events->find();
        $query->contain(['AdminUsers', 'Listings']);
       
        $options['order'] = ['Events.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $events = $this->paginate($query);
        $this->set(compact('events'));
    }

    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => ['AdminUsers', 'Listings', 'EventDocuments', 'EventSocialLinks'],
        ]);

        $this->set(compact('event'));
    }

 
    /**
     * Add/Edit method
     * Edit: param string|null $id Event id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $event = $this->Events->get($id, [
                'contain' => ['EventImages', 'EventVideos'],
            ]);
        }else{
            $event = $this->Events->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            //dd($this->request->getData());
            $event = $this->Events->patchEntity($event, $this->request->getData());
            $event->admin_user_id = $this->Authentication->getIdentity()->id;
            //dd($event->getErrors());
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event could not be saved. Please, try again.'));
        }
        $adminUsers = $this->Events->AdminUsers->find('list', ['limit' => 200]);
        $listings = $this->Events->Listings->find('list', ['limit' => 200]);
        $this->set(compact('event', 'adminUsers', 'listings'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => ['Phinxlog'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->getData());
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event could not be saved. Please, try again.'));
        }
        $adminUsers = $this->Events->AdminUsers->find('list', ['limit' => 200]);
        $listings = $this->Events->Listings->find('list', ['limit' => 200]);
        $phinxlog = $this->Events->Phinxlog->find('list', ['limit' => 200]);
        $this->set(compact('event', 'adminUsers', 'listings', 'phinxlog'));
    }


     /**
     * tempcrop file method
     * Comments: add front, admin, logos and fav icons
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function tempcrop() {
        //$this->Authorization->authorize($this->Settings->newEmptyEntity(), 'create');
            $is_dest = "img/tmp/";
            if (!file_exists($is_dest)) {
                //mkdir($is_dest, 0777, true);
                $dir = new Folder(WWW_ROOT . 'img/tmp/', true, 0755);
                $is_dest = $dir->path;
            }
            //dd($this->request->getData('file'));
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
                    $data['status'] = true;
                    $data['message'] = "file successfully uploaded!";
                } else {
                    $data['status'] = false;
                    $data['message'] = "invalid file type!";
                }
            } else {
                $data['status'] = false;
                $data['message'] = "invalid file!";
            }
        $this->set($data);
        $this->viewBuilder()->setOption('serialize', ['filename', 'image_path','status', 'message']);
    }

     public function tempcropOld()
    {
        $is_dest = "img/tmp/";
        if (!file_exists($is_dest)) {
            mkdir($is_dest, 0777, true);
        }
        $directory = WWW_ROOT . $is_dest;
        $directory = str_replace("\\", "/", $directory);
        $json = [];
        $data = '';
        if ($this->request->getData('file') && strlen($this->request->getData('file.name')) > 1) {
            $file = $this->request->getData('file');
            $upFile = new \Cake\Filesystem\File($file['tmp_name'], false, 0755);
            // Sanitize the filename
            $filename = basename(html_entity_decode($file['name'], ENT_QUOTES, 'UTF-8'));
            $extension = (new \Cake\Filesystem\File($file['name'], false))->ext();
            //$filenameOrig = str_replace(".{$extension}", '', $file['name']);
            $filenameOrig = time() . "-" . rand() . "." . $extension;

            // Allowed file extension types
            $allowed = array('jpg', 'jpeg', 'gif', 'png');
            if (!in_array(strtolower($extension), $allowed)) {
                $json['error'] = $filename . " " . __('Incorrect file type!');
            }
            // Allowed file mime types
            $is_mime = array('image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png', 'image/gif');
            if (!in_array($upFile->mime(), $is_mime)) {
                $json['error'] = $filename . ' Incorrect file type!';
            }
            // Return any upload error
            if ($file['error'] != UPLOAD_ERR_OK) {
                $json['error'] = $filename . ' error_upload_' . $file['error'];
            }

            if (!$json) {
                if ($upFile->copy($directory . '/' . $filenameOrig, TRUE)) {
                    $data = ['filename' => $filenameOrig, 'full_path' => $directory, 'base_path' => $this->request->getAttribute('webroot') . $is_dest];
                    $fileList = "<i class='fa fa-check green'></i> " . $filename . " file successfully uploaded!";
                } else {
                    $fileList = "<i class='fa fa-close red'></i> " . $filename . " file is invalid!";
                    $json['error'] = __($filename . " file is invalid!");
                }
            } else {
                $fileList = $json['error'];
            }
        }

        $this->set([
            'status' => !$json ? TRUE : FALSE,
            'responce' => 200,
            'message' => $fileList,
            'data' => $data,
            '_jsonOptions' => JSON_FORCE_OBJECT,
            '_serialize' => ['status', 'responce', 'message', 'data']
        ]);
    }


    /**
     * Delete method
     *
     * @param string|null $id Enquiry Status id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            $result = ['status' => true, 'message' => __('The event has been deleted.')];
        } else {
            $result = ['status' => false, 'message' => __('The event could not be deleted. Please, try again.')];
        }

        $this->set([
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'data' => $event,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deletesss($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('The event has been deleted.'));
        } else {
            $this->Flash->error(__('The event could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function deleteImages($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $bannerImage = $this->Events->EventDocuments->get($id);
        if ($this->Events->EventDocuments->delete($bannerImage)) {
            $msg = __('The document has been deleted.');
            $response = ["success" => TRUE, "err_msg" => $msg];
        } else {
            $msg = __('The document could not be deleted. Please, try again.');
            $response = ["success" => FALSE, "err_msg" => $msg];
        }
        $this->set([
            'status' => $response['success'],
            'responce' => 200,
            'message' => $response['err_msg'],
            'data' => $bannerImage,
        ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'responce', 'message', 'data']);
        if (!$this->request->is('ajax')) {
            $response['success'] === TRUE ? $this->Flash->success($msg) : $this->Flash->error($msg);
            return $this->redirect(['action' => 'index']);
        }
    }
}

<?php
declare(strict_types=1);

namespace Media\Controller\Admin;

use Media\Controller\AppController;

/**
 * Medias Controller
 *
 * @method \Media\Model\Entity\Media[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MediasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        $query = $this->Medias->find();
        if($this->request->getQuery('type')){
            $query->find($this->request->getQuery('type'));
            $slug = $this->request->getQuery('type');
            $title = $this->request->getQuery('type') == "gallery" ? "Photo Gallery" : ucfirst($this->request->getQuery('type'));
        }else{
            $slug = "banner";
            $title = "Banner";
        }
        $options['order'] = ['Medias.position' => 'ASC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $medias = $this->paginate($query);
        
        $this->set(compact('medias', 'title', 'slug'));
    }

    /**
     * View method
     *
     * @param string|null $id Media id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $media = $this->Medias->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('media'));
    }



    /**
     * Add/Edit method
     * Edit: param string|null $id Media id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $media = $this->Medias->get($id, [
                'contain' => ['MediaFiles'],
            ]);
        }else{
            $media = $this->Medias->newEmptyEntity();
        }
        if($this->request->getQuery('type')){
            $slug = $this->request->getQuery('type');
            $title = $this->request->getQuery('type') == "gallery" ? "Photo Gallery" : ucfirst($this->request->getQuery('type'));
        }else{
            $slug = "banner";
            $title = "Banner";
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request = $this->request->withData('media_type', $slug);
            //dd($this->request->getData());
            $media = $this->Medias->patchEntity($media, $this->request->getData());
            //dd($media->getErrors());
            if ($this->Medias->save($media)) {
                $this->Flash->success(__('The media has been saved.'));
                $urlQueryS['action'] = 'index';
                if(!empty($this->request->getQuery())){
                    $urlQueryS['?'] = $this->request->getQuery();
                }
                return $this->redirect($urlQueryS);
            }
            $this->Flash->error(__('The media could not be saved. Please, try again.'));
        }
        $this->set(compact('media', 'title', 'slug'));
    }

    /**
     * gallery method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function gallery()
    {
        $query = $this->Medias->find('gallery');
        $options['order'] = ['Medias.position' => 'ASC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $medias = $this->paginate($query);
        $this->viewBuilder()->setTemplate('index');
        $slug = "gallery";
        $title = "Photo Gallery";
        $this->set(compact('medias', 'title', 'slug'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Media id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $media = $this->Medias->get($id);
        if ($this->Medias->delete($media)) {
            $result = ['status' => true, 'message' => __('The media has been deleted.')];
        } else {
            $result = ['status' => false, 'message' => __('The media could not be deleted. Please, try again.')];
        }

        $this->set([
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'data' => $media,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);
    }


    /**
     * Delete image method
     *
     * @param string|null $id Media id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteImage($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $mediaFiles = $this->Medias->MediaFiles->get($id);
        // if (!$this->Authorization->can($emailHook, 'create')) {
        //     return ['status' => false, 'message' => 'You don\'t have permission to delete email hook.'];
        // }
        $mediaFiles->listing_id = \Cake\Core\Configure::read('LISTING_ID');
        if ($this->Medias->MediaFiles->delete($mediaFiles)) {
            $result = ['status' => true, 'message' => __('The media image has been deleted.')];
        } else {
            $result = ['status' => false, 'message' => __('The media image could not be deleted. Please, try again.')];
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
     * fileDownload method
     *
     * @param string|null $id Media id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function fileDownload($id)
    {
        $mediaImg = $this->Medias->MediaFiles->find()->where(['MediaFiles.id'=>$id])->first();
        $nominate_file_path = WWW_ROOT .'img/'. $mediaImg->media_image_path."/".$mediaImg->media_image;
        if (!empty($mediaImg->media_image_path) && !empty($mediaImg->media_image) && file_exists("img/".$mediaImg->media_image_path . $mediaImg->media_image)) {
            $ext = pathinfo($mediaImg->media_image, PATHINFO_EXTENSION);
            //echo $ext;die;
            $uname = strtolower(str_replace(" ","_",$mediaImg->title));
            return $response = $this->response->withFile(
                $nominate_file_path,
                    ['download' => true, 'name' => $uname.".".$ext]
                );

        }else{
            $this->Flash->error(__('This file is not available.'));
            $this->redirect($this->referer());
        }
    }
}

<?php
declare(strict_types=1);

namespace Media\Controller;

use Media\Controller\AppController;

/**
 * Medias Controller
 *
 * @property \Media\Model\Table\MediasTable $Medias
 * @method \Media\Model\Entity\Media[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MediasController extends AppController
{
    
    /**
     * gallery method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function gallery()
    {
        $query = $this->Medias->find('gallery');
        $query->contain(['MediaFiles']);
       
        $options['order'] = ['Medias.position' => 'ASC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $medias = $this->paginate($query);
        //dd($medias);
        $this->set(compact('medias'));
    }

    /**
     * View method
     *
     * @param string|null $id Media id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function downloads($id = null)
    {
        $query = $this->Medias->find('download');
        $query->contain(['MediaFiles']);
       
        $options['order'] = ['Medias.position' => 'ASC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $medias = $this->paginate($query);

        $this->set(compact('medias'));
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
                'contain' => [],
            ]);
        }else{
            $media = $this->Medias->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $media = $this->Medias->patchEntity($media, $this->request->getData());
            if ($this->Medias->save($media)) {
                $this->Flash->success(__('The media has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The media could not be saved. Please, try again.'));
        }
        $listings = $this->Medias->Listings->find('list', ['limit' => 200]);
        $this->set(compact('media', 'listings'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Media id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $media = $this->Medias->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $media = $this->Medias->patchEntity($media, $this->request->getData());
            if ($this->Medias->save($media)) {
                $this->Flash->success(__('The media has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The media could not be saved. Please, try again.'));
        }
        $listings = $this->Medias->Listings->find('list', ['limit' => 200]);
        $this->set(compact('media', 'listings'));
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
            $this->Flash->success(__('The media has been deleted.'));
        } else {
            $this->Flash->error(__('The media could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
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

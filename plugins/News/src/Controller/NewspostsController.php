<?php
declare(strict_types=1);

namespace News\Controller;

use News\Controller\AppController;

/**
 * Newsposts Controller
 *
 * @property \News\Model\Table\NewspostsTable $Newsposts
 * @method \News\Model\Entity\Newspost[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NewspostsController extends AppController
{
    

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Newsposts->find();
        $query->contain(['AdminUsers']);
        $options['order'] = ['Newsposts.position' => 'ASC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $newsposts = $this->paginate($query);
        $this->set(compact('newsposts'));
    }

    /**
     * Detail method
     *
     * @param string|null $id Newspost id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function detail($slug)
    {

        $query = $this->Newsposts->find();
        $query->where(['Newsposts.slug' => $slug]);
        $query->contain(['Listings', 'AdminUsers']);
        $newspost = $query->firstOrFail();

        $this->set(compact('newspost'));
    }

    
}

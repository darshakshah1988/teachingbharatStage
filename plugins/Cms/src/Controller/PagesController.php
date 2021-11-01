<?php
declare(strict_types=1);

namespace Cms\Controller;

use Cms\Controller\AppController;

/**
 * Pages Controller
 *
 * @property \Cms\Model\Table\PagesTable $Pages
 * @method \Cms\Model\Entity\Page[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PagesController extends AppController
{
    

    /**
     * detail method
     *
     * @param string|null $slug Page slug.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function detail($slug = null)
    {
        $page = $this->Pages->find()->where(['slug' => $slug])->first();
        if (empty($page)) {
            throw new NotFoundException(__('Page not found'));
        }
        $this->set('page', $page);
        $this->set('_serialize', ['page']);
    }

    /**
     * View method
     *
     * @param string|null $id Page id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $page = $this->Pages->get($id, [
            'contain' => ['Listings'],
        ]);

        $this->set(compact('page'));
    }

}

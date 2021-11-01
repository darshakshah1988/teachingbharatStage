<?php
declare(strict_types=1);

namespace Reviews\Controller\Admin;

use Reviews\Controller\AppController;

/**
 * Reviews Controller
 *
 * @property \Reviews\Model\Table\ReviewsTable $Reviews
 * @method \Reviews\Model\Entity\Review[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReviewsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Reviews->find('type', ['type' => $this->request->getQuery('review_type')]);
        $query->contain(['Users', 'Courses']); 
       
        $options['order'] = ['Reviews.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $reviews = $this->paginate($query);
        //dd($reviews);
        $this->set(compact('reviews'));
    }

    /**
     * View method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $review = $this->Reviews->get($id, [
            'contain' => ['Users', 'Courses'],
        ]);

        $this->set(compact('review'));
    }

 
    /**
     * Add/Edit method
     * Edit: param string|null $id Review id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $review = $this->Reviews->get($id, [
                'contain' => [],
            ]);
        }else{
            $review = $this->Reviews->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $review = $this->Reviews->patchEntity($review, $this->request->getData());
            if ($this->Reviews->save($review)) {
                $this->Flash->success(__('The review has been saved.'));

                return $this->redirect(['action' => 'index', '?' => $this->request->getQuery()]);
            }
            $this->Flash->error(__('The review could not be saved. Please, try again.'));
        }
        $users = $this->Reviews->Users->find('list', ['keyField' => 'id', 'valueField' => 'name', 'limit' => 200])->find('teacher')->find('active');
        if($this->request->getQuery('review_type') == "session"){
            $courses = $this->Reviews->Courses->find('list', ['limit' => 200])->find('session');
        }else{
            $courses = $this->Reviews->Courses->find('list', ['limit' => 200])->find('course');
        }
        
        
        $this->set(compact('review', 'users', 'courses' ));
    }

    /**
     * Edit method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $review = $this->Reviews->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $review = $this->Reviews->patchEntity($review, $this->request->getData());
            if ($this->Reviews->save($review)) {
                $this->Flash->success(__('The review has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The review could not be saved. Please, try again.'));
        }
        $users = $this->Reviews->Users->find('list', ['limit' => 200]);
        $courses = $this->Reviews->Courses->find('list', ['limit' => 200]);
        $this->set(compact('review', 'users', 'courses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $review = $this->Reviews->get($id);
        if ($this->Reviews->delete($review)) {
            $this->Flash->success(__('The review has been deleted.'));
        } else {
            $this->Flash->error(__('The review could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

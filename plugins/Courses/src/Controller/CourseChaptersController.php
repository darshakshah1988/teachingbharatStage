<?php
declare(strict_types=1);

namespace Courses\Controller;

use Courses\Controller\AppController;

/**
 * CourseChapters Controller
 *
 * @method \Courses\Model\Entity\CourseChapter[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CourseChaptersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($course_id)
    {
        $course = $this->CourseChapters->Courses->get($course_id);
        $query = $this->CourseChapters->find()->contain(['Courses'])->where(['CourseChapters.course_id' => $course_id]);
        $options['order'] = ['CourseChapters.position' => 'ASC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $courseChapters = $this->paginate($query);
        //dd($courseChapters);
        $this->set(compact('course', 'courseChapters'));
    }

    /**
     * View method
     *
     * @param string|null $id Course Chapter id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $courseChapter = $this->CourseChapters->get($id, [
            'contain' => ['Courses'],
        ]);

        $this->set(compact('courseChapter'));
    }

 
    /**
     * Add/Edit method
     * Edit: param string|null $id Course Chapter id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $courseChapter = $this->CourseChapters->get($id, [
                'contain' => [],
            ]);
        }else{
            $courseChapter = $this->CourseChapters->newEmptyEntity();
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            //dd($this->request->getData());
            $courseChapter = $this->CourseChapters->patchEntity($courseChapter, $this->request->getData());
            $courseChapter->course_id = $this->request->getQuery('course_id');
            if ($this->CourseChapters->save($courseChapter)) {
                $response['message'] = __('The course chapter has been saved.');
                $response['status'] = true;
            }else{
                $response['message'] = __('The course chapter could not be saved. Please, try again.');
                $response['status'] = false;
            }
        }

        $this->set([
            'status' => $response['status'] ?? '',
            'code' => isset($response['status']) ? 200 : 422,
            'message' => $response['message'] ?? "",
            'errors' => $courseChapter->getErrors(),
            'courseChapter' => $courseChapter
         ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code', 'message', 'errors']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Course Chapter id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $courseChapter = $this->CourseChapters->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $courseChapter = $this->CourseChapters->patchEntity($courseChapter, $this->request->getData());
            if ($this->CourseChapters->save($courseChapter)) {
                $this->Flash->success(__('The course chapter has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The course chapter could not be saved. Please, try again.'));
        }
        $this->set(compact('courseChapter'));
    }

     /**
     * download method
     *
     * @param string|null $id Media id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function download($id)
    { 

        if(!$this->getRequest()->getAttribute('identity')){
            $this->redirect($this->referer());
        }

        $downloadableFile = $this->CourseChapters->find()->contain(['Courses'])->where(['CourseChapters.id'=>$id])->first();
        $nominate_file_path = WWW_ROOT .'img/'. $downloadableFile->chapter_file_path."/".$downloadableFile->chapter_file;
        if (!empty($downloadableFile->chapter_file_path) && !empty($downloadableFile->chapter_file) && file_exists("img/".$downloadableFile->chapter_file_path . $downloadableFile->chapter_file)) {
            $ext = pathinfo($downloadableFile->chapter_file, PATHINFO_EXTENSION);
            //echo $ext;die;
            $uname = strtolower(str_replace(" ","_",$downloadableFile->course->title));
            return $response = $this->response->withFile(
                $nominate_file_path,
                    ['download' => true, 'name' => $uname.".".$ext]
                );

        }else{
            $this->Flash->error(__('This file is not available.'));
            $this->redirect($this->referer());
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Course Chapter id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $courseChapter = $this->CourseChapters->get($id);
        if ($this->CourseChapters->delete($courseChapter)) {
            $result = ['status' => true, 'message' => __('The course chapter has been deleted.')];
        } else {
            $result = ['status' => false, 'message' => __('The course chapter could not be deleted. Please, try again.')];
        }

        $this->set([
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'data' => $courseChapter,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);
    }
}

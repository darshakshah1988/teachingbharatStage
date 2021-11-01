<?php
declare(strict_types=1);

namespace UserManager\Controller;

use UserManager\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Dashboard Controller
 *
 * @method \UserManager\Model\Entity\Dashboard[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DashboardController extends AppController
{

    public function initialize() : void
    {
        parent::initialize();
        //$this->viewBuilder()->setLayout('TeachingTheme.auth');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $dashboard = [];
        // $user = $this->getRequest()->getAttribute('identity');
        // dd($user);
        $courseCount = TableRegistry::getTableLocator()->get('Courses.Courses')
        ->find('course')
        ->where(['Courses.user_id' => $this->getRequest()->getAttribute('identity')->id])
        ->count();
        $sessionCount = TableRegistry::getTableLocator()->get('Sessions.SessionBookings')->find()->where(['SessionBookings.teacher_id' => $this->getRequest()->getAttribute('identity')->id])->count();


        
        $this->set(compact('courseCount', 'sessionCount'));

    }

   
}

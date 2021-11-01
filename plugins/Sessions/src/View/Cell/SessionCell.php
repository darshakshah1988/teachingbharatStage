<?php
declare(strict_types=1);

namespace Sessions\View\Cell;

use Cake\View\Cell;
use Cake\ORM\TableRegistry;

/**
 * Session cell
 */
class SessionCell extends Cell
{
    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Initialization logic run at the end of object construction.
     *
     * @return void
     */
    public function initialize(): void
    {
    }

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {

    }

     /**
     * Default pending method.
     *
     * @return void
     */
    public function dashboard($type, $user)
    {

        $query = TableRegistry::getTableLocator()->get('Sessions.SessionBookings')->find();
        if($type == "pending"){
            $query->find('pending');
        }else{
             $query->find('upcoming');
        }

        $query->contain(['Users', 'Teacher', 'Subjects', 'GradingTypes', 'Boards', 'TeacherSchedules']);
        if($user->role == "teacher"){
            $query->where(['SessionBookings.teacher_id' => $user->id]);
        }else{
            $query->where(['SessionBookings.user_id' => $user->id]);
        }
        $query->order(['SessionBookings.id' => 'DESC']);
        $query->limit(20);
        $sessionBookings = $query->all();
        $this->set(compact('sessionBookings', 'type'));
    }
}

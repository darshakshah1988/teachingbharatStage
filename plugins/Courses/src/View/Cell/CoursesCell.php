<?php
declare(strict_types=1);

namespace Courses\View\Cell;

use Cake\View\Cell;
use Cake\ORM\TableRegistry;

/**
 * Courses cell
 */
class CoursesCell extends Cell
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
     * Enrolle display method.
     *
     * @return void
     */
    public function enrolle($id = null)
    {
        $enrolled = TableRegistry::getTableLocator()->get('Orders.Orders')->find()
                    ->innerJoinWith('OrderCourses', function($q) use($id){
                        return $q->where(['OrderCourses.course_id' => $id]);
                    })
                    ->distinct('Orders.id')
                    ->where(['Orders.transaction_status' => 1])
                    ->count();
        $this->set(compact('enrolled'));
    }
}

<?php
declare(strict_types=1);

namespace Events\View\Cell;

use Cake\View\Cell;
use Cake\ORM\TableRegistry;

/**
 * Event cell
 */
class EventCell extends Cell
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
        $query = TableRegistry::getTableLocator()->get('Events.Events')->find();
        $query->order(['Events.position' => 'ASC']);
        $query->limit(10);
        $events = $query->all();
        $this->set(compact('events'));
    }
}

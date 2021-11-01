<?php
declare(strict_types=1);

namespace Announcement\View\Cell;

use Cake\View\Cell;
use Cake\ORM\TableRegistry;

/**
 * Announcement cell
 */
class AnnouncementCell extends Cell
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

        $query = TableRegistry::getTableLocator()->get('Announcement.Announcements')->find();
        $query->order(['Announcements.id' => 'DESC']);
        $query->limit(10);
        $announcements = $query->all();
        $this->set(compact('announcements'));

    }
}

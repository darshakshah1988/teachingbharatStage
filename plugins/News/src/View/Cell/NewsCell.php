<?php
declare(strict_types=1);

namespace News\View\Cell;

use Cake\View\Cell;
use Cake\ORM\TableRegistry;

/**
 * News cell
 */
class NewsCell extends Cell
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
        $query = TableRegistry::getTableLocator()->get('News.Newsposts')->find();
        $query->order(['Newsposts.position' => 'ASC']);
        $query->limit(10);
        $newsposts = $query->all();
        $this->set(compact('newsposts'));
    }
}

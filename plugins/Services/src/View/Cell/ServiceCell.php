<?php
declare(strict_types=1);

namespace Services\View\Cell;

use Cake\View\Cell;
use Cake\ORM\TableRegistry;

/**
 * Service cell
 */
class ServiceCell extends Cell
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
        $query = TableRegistry::getTableLocator()->get('Services.Services')->find();
        $query->order(['Services.position' => 'ASC']);
        $query->limit(10);
        $services = $query->all();
        $this->set(compact('services'));
    }
}

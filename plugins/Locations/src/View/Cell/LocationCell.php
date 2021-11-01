<?php
declare(strict_types=1);

namespace Locations\View\Cell;

use Cake\View\Cell;
use Cake\ORM\TableRegistry;

/**
 * Location cell
 */
class LocationCell extends Cell
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
     * getParentMenus method.
     *
     * @return void
     */
    public function getParents($id = null) {
        $records = TableRegistry::getTableLocator()->get('Locations.Locations')->getParentLocationList($id);
        $this->set(compact('records','id')); 
    }
}

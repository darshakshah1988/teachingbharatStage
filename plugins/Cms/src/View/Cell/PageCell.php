<?php
declare(strict_types=1);

namespace Cms\View\Cell;

use Cake\View\Cell;
use Cake\ORM\TableRegistry;

/**
 * Page cell
 */
class PageCell extends Cell
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
    public function display($option)
    {
        $query = TableRegistry::getTableLocator()->get('Cms.Pages')->find();
        if(isset($option['slug']) && !empty($option['slug'])){
            $query->where(['Pages.slug' => $option['slug']]);
        }
        $page = $query->first();
        $this->set(compact('page'));

    }
}

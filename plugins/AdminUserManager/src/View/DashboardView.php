<?php
declare(strict_types=1);

namespace AdminUserManager\View;

use Cake\View\View;
use Cake\ORM\TableRegistry;

/**
 * DashboardView View
 */
class DashboardView extends View
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
     * render method.
     *
     * @return void
     */
    public function render($view = null, $layout = null)
    {
        // Custom logic here.
    }
}

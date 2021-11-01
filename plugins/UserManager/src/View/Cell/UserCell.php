<?php
declare(strict_types=1);

namespace UserManager\View\Cell;

use Cake\View\Cell;
use Cake\ORM\TableRegistry;

/**
 * User cell
 */
class UserCell extends Cell
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
    public function display($id)
    {
        $query = TableRegistry::getTableLocator()->get('UserManager.Users')->find()->contain(['UserProfiles.GradingTypes']);
        $query->where(['Users.id' => $id]);
        $user = $query->first();
        $this->set(compact('user'));
    }
}

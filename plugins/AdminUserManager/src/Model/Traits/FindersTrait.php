<?php
namespace AdminUserManager\Model\Traits;

/**
 * Admin User Finders 
 *
 * @mixin \Cake\ORM\Query
 */

trait FindersTrait
{

    /**
     * This filters function is a 'finder' to use in the check status of user
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @param type $options Options Array
     * @return \Cake\ORM\Query
     */

    public function findStatus(\Cake\ORM\Query $query, array $options)
    {
        return $query->where(['AdminUsers.status' => 1]);
    }

}
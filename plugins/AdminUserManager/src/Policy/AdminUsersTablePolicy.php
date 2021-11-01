<?php
declare(strict_types=1);

namespace AdminUserManager\Policy;

use AdminUserManager\Model\Entity\AdminUsersTable;
use Authorization\IdentityInterface;
use Cake\ORM\Query;
use Authorization\Policy\BeforePolicyInterface;
use Authorization\Policy\Result;
/**
 * AdminUsersTable policy
 */
class AdminUsersTablePolicy implements BeforePolicyInterface
{ 


/**
     * Check if $user is supper user or admin it will default allow all actions
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param AdminUserManager\Model\Entity\AdminUser $adminUser
     * @return bool
     */
    public function before($user, $resource, $action)
    {
        if ($user->getOriginalData()->is_supper_admin) {
            return new Result(true);
        }else if($user->getOriginalData()->roles){
            $isRoles = [];
            foreach($user->getOriginalData()->roles as $role){
                    $isRoles[$role->id] = $role->id;
            }
            if(!empty(array_intersect([4, 5, 6], $isRoles))){
                return new Result(true);
            }
        }
        return new Result(true);
        // fall through
    }

    public function canIndex(IdentityInterface $user, Query $query)
    {
        
        return new Result(false, 'You don\'t have permission to access staff users');
    }

    public function scopeIndex(IdentityInterface $user, Query $query)
    {
        return $query->where(['AdminUsers.listing_id' => \Cake\Core\Configure::read('LISTING_ID')]);
    }

    /**
     * Check if $user can create AdminUsersTable
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param AdminUserManager\Model\Entity\AdminUsersTable $adminUsersTable
     * @return bool
     */
    public function canCreate(IdentityInterface $user, AdminUsersTable $adminUsersTable)
    {
    }

    /**
     * Check if $user can update AdminUsersTable
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param AdminUserManager\Model\Entity\AdminUsersTable $adminUsersTable
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, AdminUsersTable $adminUsersTable)
    {
    }

    /**
     * Check if $user can delete AdminUsersTable
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param AdminUserManager\Model\Entity\AdminUsersTable $adminUsersTable
     * @return bool
     */
    public function canDelete(IdentityInterface $user, AdminUsersTable $adminUsersTable)
    {
    }

    /**
     * Check if $user can view AdminUsersTable
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param AdminUserManager\Model\Entity\AdminUsersTable $adminUsersTable
     * @return bool
     */
    public function canView(IdentityInterface $user, AdminUsersTable $adminUsersTable)
    {
    }
}

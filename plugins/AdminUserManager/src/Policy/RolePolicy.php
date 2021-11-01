<?php
declare(strict_types=1);

namespace AdminUserManager\Policy;

use AdminUserManager\Model\Entity\Role;
use Authorization\IdentityInterface;
use Authorization\Policy\Result;
use Authorization\Policy\BeforePolicyInterface;
use Cake\Collection\Collection;

/**
 * Role policy
 */
class RolePolicy implements BeforePolicyInterface
{

    public function before($user, $resource, $action)
    {
        if ($user->getOriginalData()->is_supper_admin) {
            return new Result(true);
        }else if($user->getOriginalData()->roles){
            $isRoles = [];
            foreach($user->getOriginalData()->roles as $role){
                    $isRoles[$role->id] = $role->id;
            }
            if(in_array(5, $isRoles)){
                return new Result(true);
            }
            
        }
        return new Result(true);
        // fall through
    }

    /**
     * Check if $user can create AdminUsersTable
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param AdminUserManager\Model\Entity\AdminUsersTable $adminUsersTable
     * @return bool
     */
    // public function canIndex(IdentityInterface $user, Query $query)
    // {
    //     if($user->is_supper_admin){
    //         return true;
    //     }else if($user->is_supper_admin){
    //         return true;
    //     }
    //     return false;
    // }




    /**
     * Check if $user can create Role
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param AdminUserManager\Model\Entity\Role $role
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Role $role)
    {
        if($user->is_supper_admin){
            return new Result(true);
        }
        return new Result(false, 'You don\'t have permission to create roles');
    }

    /**
     * Check if $user can update Role
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param AdminUserManager\Model\Entity\Role $role
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Role $role)
    {
    }

    /**
     * Check if $user can delete Role
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param AdminUserManager\Model\Entity\Role $role
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Role $role)
    {
        if($user->is_supper_admin){
            return new Result(true);
        }
        return new Result(false, 'You don\'t have permission to view');
    }

    /**
     * Check if $user can view Role
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param AdminUserManager\Model\Entity\Role $role
     * @return bool
     */
    public function canView(IdentityInterface $user, Role $role)
    {
        if($user->is_supper_admin){
            return new Result(true);
        }
        return new Result(false, 'You don\'t have permission to view');
    }
}

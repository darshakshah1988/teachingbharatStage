<?php
declare(strict_types=1);

namespace AdminUserManager\Policy;

use AdminUserManager\Model\Entity\AdminUser;
use Authorization\IdentityInterface;
use Authorization\Policy\Result;
use Authorization\Policy\BeforePolicyInterface;
/**
 * AdminUser policy
 */
class AdminUserPolicy implements BeforePolicyInterface
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
    /**
     * Check if $user can create AdminUser
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param AdminUserManager\Model\Entity\AdminUser $adminUser
     * @return bool
     */
    public function canCreate(IdentityInterface $user, AdminUser $adminUser)
    {
        if($user->is_supper_admin){
            return new Result(true);
        }
        return new Result(false, 'You don\'t have permission to create admin');
    } 

    /**
     * Check if $user can update AdminUser
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param AdminUserManager\Model\Entity\AdminUser $adminUser
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, AdminUser $adminUser)
    {
    }

    /**
     * Check if $user can delete AdminUser
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param AdminUserManager\Model\Entity\AdminUser $adminUser
     * @return bool
     */
    public function canDelete(IdentityInterface $user, AdminUser $adminUser)
    {
    }

    /**
     * Check if $user can view AdminUser
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param AdminUserManager\Model\Entity\AdminUser $adminUser
     * @return bool
     */
    public function canView(IdentityInterface $user, AdminUser $adminUser)
    {
    }

    
}

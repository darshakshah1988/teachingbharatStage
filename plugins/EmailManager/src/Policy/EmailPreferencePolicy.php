<?php
declare(strict_types=1);

namespace EmailManager\Policy;

use Authorization\IdentityInterface;
use EmailManager\Model\Entity\EmailPreference;
use Authorization\Policy\Result;
use Authorization\Policy\BeforePolicyInterface;
/**
 * EmailPreference policy
 */
class EmailPreferencePolicy implements BeforePolicyInterface
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
        return new Result(true);
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
        // fall through
    }
    /**
     * Check if $user can create EmailPreference
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param EmailManager\Model\Entity\EmailPreference $emailPreference
     * @return bool
     */
    public function canCreate(IdentityInterface $user, EmailPreference $emailPreference)
    {
        if($user->is_supper_admin){
            return new Result(true);
        }
        return new Result(false, 'not valid user');
    }

    /**
     * Check if $user can update EmailPreference
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param EmailManager\Model\Entity\EmailPreference $emailPreference
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, EmailPreference $emailPreference)
    {
    }

    /**
     * Check if $user can delete EmailPreference
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param EmailManager\Model\Entity\EmailPreference $emailPreference
     * @return bool
     */
    public function canDelete(IdentityInterface $user, EmailPreference $emailPreference)
    {
    }

    /**
     * Check if $user can view EmailPreference
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param EmailManager\Model\Entity\EmailPreference $emailPreference
     * @return bool
     */
    public function canView(IdentityInterface $user, EmailPreference $emailPreference)
    {
        if($user->is_supper_admin){
            return new Result(true);
        }
        return new Result(false, 'not valid user');
    }
}

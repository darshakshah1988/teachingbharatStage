<?php
declare(strict_types=1);

namespace EmailManager\Policy;

use Authorization\IdentityInterface;
use EmailManager\Model\Entity\EmailTemplate;
use Authorization\Policy\Result;
use Authorization\Policy\BeforePolicyInterface;
/**
 * EmailTemplate policy
 */
class EmailTemplatePolicy implements BeforePolicyInterface
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
     * Check if $user can create EmailTemplate
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param EmailManager\Model\Entity\EmailTemplate $emailTemplate
     * @return bool
     */
    public function canCreate(IdentityInterface $user, EmailTemplate $emailTemplate)
    {
        if($user->is_supper_admin){
            return new Result(true);
        }
        return new Result(false, 'not valid user');
    }

    /**
     * Check if $user can update EmailTemplate
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param EmailManager\Model\Entity\EmailTemplate $emailTemplate
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, EmailTemplate $emailTemplate)
    {
        if($user->is_supper_admin){
            return new Result(true);
        }
        return new Result(false);
    }

    /**
     * Check if $user can delete EmailTemplate
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param EmailManager\Model\Entity\EmailTemplate $emailTemplate
     * @return bool
     */
    public function canDelete(IdentityInterface $user, EmailTemplate $emailTemplate)
    {
        if($user->is_supper_admin){
            return new Result(true);
        }
        return new Result(false);
    }

    /**
     * Check if $user can view EmailTemplate
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param EmailManager\Model\Entity\EmailTemplate $emailTemplate
     * @return bool
     */
    public function canView(IdentityInterface $user, EmailTemplate $emailTemplate)
    {
        if($user->is_supper_admin){
            return new Result(true);
        }
        return new Result(false);
    }
}

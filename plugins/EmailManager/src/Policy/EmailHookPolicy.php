<?php
declare(strict_types=1);

namespace EmailManager\Policy;

use Authorization\IdentityInterface;
use EmailManager\Model\Entity\EmailHook;
use Authorization\Policy\Result;
use Cake\Http\ServerRequest;
use Authorization\Policy\BeforePolicyInterface;
/**
 * EmailHook policy
 */
class EmailHookPolicy implements BeforePolicyInterface
{
    public function before($user, $resource, $action)
    {
        return new Result(true);
        // fall through
    }
    /**
     * Check if $user can create EmailHook
     *
     * @param Authorization\IdentityInterface $user The user.
     * @return bool
     */
    public function canCreate(IdentityInterface $user, EmailHook $emailHook)
    {
        if($user->is_supper_admin){
            return new Result(true);
        }
        return new Result(false, 'not valid user');
    }

    /**
     * Check if $user can update EmailHook
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param EmailManager\Model\Entity\EmailHook $emailHook
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, EmailHook $emailHook)
    {
        if($user->is_supper_admin){
            return new Result(true);
        }
        return new Result(false);
    }

    /**
     * Check if $user can delete EmailHook
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param EmailManager\Model\Entity\EmailHook $emailHook
     * @return bool
     */
    public function canDelete(IdentityInterface $user, EmailHook $emailHook)
    {
        if($user->is_supper_admin){
            return new Result(true);
        }
        return new Result(false);
    }

    /**
     * Check if $user can view EmailHook
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param EmailManager\Model\Entity\EmailHook $emailHook
     * @return bool
     */
    public function canView(IdentityInterface $user, EmailHook $emailHook)
    {
        if($user->is_supper_admin){
            return new Result(true);
        }
        return new Result(false);
    }
}

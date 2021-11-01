<?php
declare(strict_types=1);

namespace EmailManager\Policy;

use Authorization\IdentityInterface;
use EmailManager\Model\Entity\EmailTemplates;
use Cake\ORM\Query;
use Authorization\Policy\Result;
use Authorization\Policy\BeforePolicyInterface;

/**
 * EmailTemplates policy
 */
class EmailTemplatesTablePolicy implements BeforePolicyInterface
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
     * Check if $user can view list of  Listing Types
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\ListingTypesTable $listingTypesTable
     * @return bool
     */
    public function canIndex(IdentityInterface $user)
    {
        if($user->is_supper_admin){
            return new Result(true);
        }else if($user->listing->listing_type_id == 1){
            return new Result(true);
        }
        return new Result(false, 'not-owner');

    }
    /**
     * scope for get our self listings
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\ListingTypesTable $listingTypesTable
     * @return bool
     */
    public function scopeIndex(IdentityInterface $user, Query $query)
    {
        //thesre we need to put another conditions according to staff role
        if(!$user->is_supper_admin){
            $query->where(['Listings.admin_user_id' => $user->id]);
        }
        return $query;
    }

    /**
     * Check if $user can create EmailHooksTable
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param EmailManager\Model\Entity\EmailHooksTable $emailHooksTable
     * @return bool
     */
    public function canCreate(IdentityInterface $user, EmailTemplates $emailHooksTable)
    {
        if($user->is_supper_admin){
            return new Result(true);
        }
        return new Result(false, 'not valid user');
    }

    /**
     * Check if $user can update EmailHooksTable
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param EmailManager\Model\Entity\EmailHooksTable $emailHooksTable
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, EmailHooksTable $emailHooksTable)
    {
    }

    /**
     * Check if $user can delete EmailHooksTable
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param EmailManager\Model\Entity\EmailHooksTable $emailHooksTable
     * @return bool
     */
    public function canDelete(IdentityInterface $user, EmailHooksTable $emailHooksTable)
    {
    }

    /**
     * Check if $user can view EmailHooksTable
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param EmailManager\Model\Entity\EmailHooksTable $emailHooksTable
     * @return bool
     */
    public function canView(IdentityInterface $user, EmailHooksTable $emailHooksTable)
    {
    }
}

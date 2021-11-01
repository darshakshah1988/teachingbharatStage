<?php
declare(strict_types=1);

namespace Listings\Policy;

use Authorization\IdentityInterface;
use Listings\Model\Entity\ListingsTable;
use Cake\ORM\Query;
use Authorization\Policy\Result;

/**
 * ListingsTable policy
 */
class ListingsTablePolicy
{
    

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
     * Check if $user can view list of  Listing Types
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\ListingTypesTable $listingTypesTable
     * @return bool
     */
    public function canIndex(IdentityInterface $user, Query $query)
    {
        if($user->is_supper_admin){
            return new Result(true);
        }else if($user->listing->listing_type_id == 1){
            return new Result(true);
        }
        return new Result(false, 'not-owner');

    }


    /**
     * Check if $user can create ListingsTable
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\ListingsTable $listingsTable
     * @return bool
     */
    public function canCreate(IdentityInterface $user, ListingsTable $listingsTable)
    {
        return new Result(true);
    }


    /**
     * Check if $user can update ListingsTable
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\ListingsTable $listingsTable
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, ListingsTable $listingsTable)
    {
    }

    /**
     * Check if $user can delete ListingsTable
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\ListingsTable $listingsTable
     * @return bool
     */
    public function canDelete(IdentityInterface $user, ListingsTable $listingsTable)
    {
    }

    /**
     * Check if $user can view ListingsTable
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\ListingsTable $listingsTable
     * @return bool
     */
    public function canView(IdentityInterface $user, ListingsTable $listingsTable)
    {
    }
}

<?php
declare(strict_types=1);

namespace Listings\Policy;

use Authorization\IdentityInterface;
use Listings\Model\Entity\ListingTypesTable;
use Cake\ORM\Query;
use Authorization\Policy\Result;

/**
 * ListingTypesTable policy
 */
class ListingTypesTablePolicy
{


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
        }else if($user->is_supper_admin){
            return new Result(true);
        }
        return new Result(false, 'not-owner');

    }



    /**
     * Check if $user can create ListingTypesTable
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\ListingTypesTable $listingTypesTable
     * @return bool
     */
    public function canCreate(IdentityInterface $user, ListingTypesTable $listingTypesTable)
    {
    }

    /**
     * Check if $user can update ListingTypesTable
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\ListingTypesTable $listingTypesTable
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, ListingTypesTable $listingTypesTable)
    {
    }

    /**
     * Check if $user can delete ListingTypesTable
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\ListingTypesTable $listingTypesTable
     * @return bool
     */
    public function canDelete(IdentityInterface $user, ListingTypesTable $listingTypesTable)
    {
    }

    /**
     * Check if $user can view ListingTypesTable
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\ListingTypesTable $listingTypesTable
     * @return bool
     */
    public function canView(IdentityInterface $user, ListingTypesTable $listingTypesTable)
    {
    }
}

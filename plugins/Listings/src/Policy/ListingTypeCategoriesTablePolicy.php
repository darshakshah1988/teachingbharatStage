<?php
declare(strict_types=1);

namespace Listings\Policy;

use Authorization\IdentityInterface;
use Listings\Model\Entity\ListingTypeCategoriesTable;
use Cake\ORM\Query;

/**
 * ListingTypeCategoriesTable policy
 */
class ListingTypeCategoriesTablePolicy
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
            return true;
        }else if($user->is_supper_admin){
            return true;
        }
        return false;
    }

    

    /**
     * Check if $user can create ListingTypeCategoriesTable
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\ListingTypeCategoriesTable $listingTypeCategoriesTable
     * @return bool
     */
    public function canCreate(IdentityInterface $user, ListingTypeCategoriesTable $listingTypeCategoriesTable)
    {
    }

    /**
     * Check if $user can update ListingTypeCategoriesTable
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\ListingTypeCategoriesTable $listingTypeCategoriesTable
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, ListingTypeCategoriesTable $listingTypeCategoriesTable)
    {
    }

    /**
     * Check if $user can delete ListingTypeCategoriesTable
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\ListingTypeCategoriesTable $listingTypeCategoriesTable
     * @return bool
     */
    public function canDelete(IdentityInterface $user, ListingTypeCategoriesTable $listingTypeCategoriesTable)
    {
    }

    /**
     * Check if $user can view ListingTypeCategoriesTable
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\ListingTypeCategoriesTable $listingTypeCategoriesTable
     * @return bool
     */
    public function canView(IdentityInterface $user, ListingTypeCategoriesTable $listingTypeCategoriesTable)
    {
    }
}

<?php
declare(strict_types=1);

namespace Listings\Policy;

use Authorization\IdentityInterface;
use Listings\Model\Entity\ListingTypeCategory;

/**
 * ListingTypeCategory policy
 */
class ListingTypeCategoryPolicy
{


    /**
     * Check if $user can create ListingType
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\ListingType $listingType
     * @return bool
     */
    public function canAdd(IdentityInterface $user, ListingTypeCategory $listingType)
    {
        if($user->is_supper_admin){
            return true;
        }
        return false;
    }

    /**
     * Check if $user can create ListingTypeCategory
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\ListingTypeCategory $listingTypeCategory
     * @return bool
     */
    public function canCreate(IdentityInterface $user, ListingTypeCategory $listingTypeCategory)
    {
    }

    /**
     * Check if $user can update ListingTypeCategory
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\ListingTypeCategory $listingTypeCategory
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, ListingTypeCategory $listingTypeCategory)
    {
    }

    /**
     * Check if $user can delete ListingTypeCategory
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\ListingTypeCategory $listingTypeCategory
     * @return bool
     */
    public function canDelete(IdentityInterface $user, ListingTypeCategory $listingTypeCategory)
    {
    }

    /**
     * Check if $user can view ListingTypeCategory
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\ListingTypeCategory $listingTypeCategory
     * @return bool
     */
    public function canView(IdentityInterface $user, ListingTypeCategory $listingTypeCategory)
    {
    }
}

<?php
declare(strict_types=1);

namespace Listings\Policy;

use Authorization\IdentityInterface;
use Listings\Model\Entity\Listing;
use Authorization\Policy\Result;
/**
 * Listing policy
 */
class ListingPolicy
{
  

     /**
     * Check if $user can create ListingType
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\ListingType $listingType
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Listing $listingType)
    {
        if($user->is_supper_admin){
            return true;
        }
        return false;
    }

    /**
     * Check if $user can quick add listing
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\ListingsTable $listingsTable
     * @return bool
     */
    public function canQuickAdd(IdentityInterface $user)
    {
        return false;
    }

    /**
     * Check if $user can create Listing
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\Listing $listing
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Listing $listing)
    {
       return new Result(false,'hi hello');
    }

    /**
     * Check if $user can update Listing
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\Listing $listing
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Listing $listing)
    {
    }

    /**
     * Check if $user can delete Listing
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\Listing $listing
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Listing $listing)
    {
    }

    /**
     * Check if $user can view Listing
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\Listing $listing
     * @return bool
     */
    public function canView(IdentityInterface $user, Listing $listing)
    {
    }
}

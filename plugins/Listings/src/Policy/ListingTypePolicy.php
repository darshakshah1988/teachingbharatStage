<?php
declare(strict_types=1);

namespace Listings\Policy;

use Authorization\IdentityInterface;
use Listings\Model\Entity\ListingType;
use Cake\ORM\Query;
/**
 * ListingType policy
 */
class ListingTypePolicy
{


    public function canIndex(IdentityInterface $user, Query $query)
    {
        if($user->is_supper_admin){
            return true;
        }else if($user->is_supper_admin){
            return true;
        }
        return true;
    }

    /**
     * Check if $user can create ListingType
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\ListingType $listingType
     * @return bool
     */
    public function canAdd(IdentityInterface $user, ListingType $listingType)
    {
        if($user->is_supper_admin){
            return true;
        }
        return false;
    }

    /**
     * Check if $user can update ListingType
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\ListingType $listingType
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, ListingType $listingType)
    {
    }

    /**
     * Check if $user can delete ListingType
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\ListingType $listingType
     * @return bool
     */
    public function canDelete(IdentityInterface $user, ListingType $listingType)
    {
        return true;
    }

    /**
     * Check if $user can view ListingType
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Listings\Model\Entity\ListingType $listingType
     * @return bool
     */
    public function canView(IdentityInterface $user, ListingType $listingType)
    {
        return true;
    }
}

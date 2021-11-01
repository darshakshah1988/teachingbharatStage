<?php
declare(strict_types=1);

namespace Enquiry\Policy;

use Authorization\IdentityInterface;
use Enquiry\Model\Table\EnquiriesTable;
use Cake\ORM\Query;
/**
 * Enquiries policy
 */
class EnquiriesTablePolicy
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
}

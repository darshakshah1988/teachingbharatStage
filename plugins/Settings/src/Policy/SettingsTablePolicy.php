<?php
declare(strict_types=1);

namespace Settings\Policy;

use Authorization\IdentityInterface;
use Settings\Model\Table\SettingTable;
use Cake\ORM\Query;
use Authorization\Policy\Result;
use Authorization\Policy\BeforePolicyInterface;
/**
 * Settings policy
 */
class SettingsTablePolicy implements BeforePolicyInterface
{

    public function before($user, $resource, $action)
    {
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
        return new Result(true);
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
    
}

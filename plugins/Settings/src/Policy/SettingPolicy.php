<?php
declare(strict_types=1);

namespace Settings\Policy;

use Authorization\IdentityInterface;
use Settings\Model\Entity\Setting;
use Authorization\Policy\Result;
/**
 * Setting policy
 */
class SettingPolicy
{
    /**
     * Check if $user can create Setting
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Settings\Model\Entity\Setting $setting
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Setting $setting)
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
        return new Result(false, 'You don\'t have permission to add new setting');

    }

    /**
     * Check if $user can update Setting
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Settings\Model\Entity\Setting $setting
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Setting $setting)
    {
        if ($user->getOriginalData()->is_supper_admin) {
            return new Result(true);
        }else if($user->getOriginalData()->roles){
            $isRoles = [];
            foreach($user->getOriginalData()->roles as $role){
                    $isRoles[$role->id] = $role->id;
            }
            if(in_array(5, $isRoles)){
                return new Result(true);
            }
            
        }
        return new Result(true);
        return new Result(false, 'You don\'t have permission to add new setting');
    }

    /**
     * Check if $user can delete Setting
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Settings\Model\Entity\Setting $setting
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Setting $setting)
    {
        if($user->is_supper_admin){
            return new Result(true);
        }
        return new Result(true);
        return new Result(false, 'not valid user');
    }

    /**
     * Check if $user can view Setting
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Settings\Model\Entity\Setting $setting
     * @return bool
     */
    public function canView(IdentityInterface $user, Setting $setting)
    {
        if($user->is_supper_admin){
            return new Result(true);
        }
        return new Result(true);
        return new Result(false, 'not valid user');
    }
}

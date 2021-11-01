<?php
declare(strict_types=1);

namespace AdminUserManager\Policy;

use AdminUserManager\Model\Table\RolesTable;
use Authorization\IdentityInterface;
use Cake\ORM\Query;
use Authorization\Policy\Result;
use Authorization\Policy\BeforePolicyInterface;

/**
 * Roles policy
 */
class RolesTablePolicy implements BeforePolicyInterface
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
            if(in_array(5, $isRoles)){
                return new Result(true);
            }
            
        }
        return new Result(true);
        // fall through
    }

	/**
     * Check if $user can view list of roles
     *
     * @param Authorization\IdentityInterface $user The user.
     * @return bool
     */
	public function canIndex(IdentityInterface $user, Query $query)
    {
       
        if($user->is_supper_admin){
            return new Result(true);
        }else if($user->is_supper_admin){
            return new Result(true);
        }
        return new Result(false, 'You don\'t have permission to access roles');
    }
}

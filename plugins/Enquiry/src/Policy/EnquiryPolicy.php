<?php
declare(strict_types=1);

namespace Enquiry\Policy;

use Authorization\IdentityInterface;
use Enquiry\Model\Entity\Enquiry;
use Authorization\Policy\Result;
use Authorization\Policy\BeforePolicyInterface;
/**
 * Enquiry policy
 */
class EnquiryPolicy implements BeforePolicyInterface
{

    /**
     * Check if $user have supper user policy default allow
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Enquiry\Model\Entity\Enquiry $enquiry
     * @return bool
     */
    public function before($user, $resource, $action)
    {
        if($user->is_supper_admin){
            return new Result(true);
        }
        // fall through
    }
    /**
     * Check if $user can create Enquiries
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Enquiry\Model\Entity\Enquiry $enquiry
     * @return bool
     */
    // public function canIndex(IdentityInterface $user, Enquiry $enquiry)
    // {
    //     return true;
    // }

    /**
     * Check if $user can create Enquiries
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Enquiry\Model\Entity\Enquiry $enquiry
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Enquiry $enquiry)
    {
        return new Result(true);
    }

    /**
     * Check if $user can update Enquiries
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Enquiry\Model\Entity\Enquiry $enquiry
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Enquiry $enquiry)
    {
    }

    /**
     * Check if $user can delete Enquiries
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Enquiry\Model\Entity\Enquiry $enquiry
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Enquiry $enquiry)
    {
    }

    /**
     * Check if $user can view Enquiries
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Enquiry\Model\Entity\Enquiry $enquiry
     * @return bool
     */
    public function canView(IdentityInterface $user, Enquiry $enquiry)
    {
        return new Result(true);
    }
}

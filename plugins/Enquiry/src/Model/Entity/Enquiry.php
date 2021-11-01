<?php
declare(strict_types=1);

namespace Enquiry\Model\Entity;

use Cake\ORM\Entity;

/**
 * Enquiry Entity
 *
 * @property int $id
 * @property int $listing_id
 * @property int|null $admin_user_id
 * @property string $enquiry_type
 * @property string $referred_by
 * @property string $subject
 * @property string|null $full_name
 * @property string $mobile
 * @property string $email
 * @property string|null $address
 * @property string|null $description
 * @property int|null $priority_type_id
 * @property int|null $enquiry_status_id
 * @property int|null $assigned_user_id
 * @property \Cake\I18n\FrozenDate|null $end_date
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Enquiry\Model\Entity\Listing $listing
 * @property \Enquiry\Model\Entity\AdminUser $admin_user
 * @property \Enquiry\Model\Entity\PriorityType $priority_type
 * @property \Enquiry\Model\Entity\EnquiryStatus $enquiry_status
 * @property \Enquiry\Model\Entity\AssignedUser $assigned_user
 * @property \Enquiry\Model\Entity\EnquiryComment[] $enquiry_comments
 */
class Enquiry extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'listing_id' => true,
        'admin_user_id' => true,
        'enquiry_type' => true,
        'referred_by' => true,
        'subject' => true,
        'full_name' => true,
        'mobile' => true,
        'email' => true,
        'address' => true,
        'description' => true,
        'remark' => true,
        'priority_type_id' => true,
        'enquiry_status_id' => true,
        'assigned_user_id' => true,
        'end_date' => true,
        'created' => true,
        'modified' => true,
        'listing' => true,
        'admin_user' => true,
        'priority_type' => true,
        'enquiry_status' => true,
        'assigned_user' => true,
        'enquiry_comments' => true,
    ];
}

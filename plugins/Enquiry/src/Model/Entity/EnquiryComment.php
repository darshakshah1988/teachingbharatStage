<?php
declare(strict_types=1);

namespace Enquiry\Model\Entity;

use Cake\ORM\Entity;

/**
 * EnquiryComment Entity
 *
 * @property int $id
 * @property int $enquiry_id
 * @property string $comment
 * @property int $enquiry_status_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Enquiry\Model\Entity\Enquiry $enquiry
 * @property \Enquiry\Model\Entity\EnquiryStatus $enquiry_status
 */
class EnquiryComment extends Entity
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
        'enquiry_id' => true,
        'admin_user_id' => true,
        'comment' => true,
        'enquiry_status_id' => true,
        'created' => true,
        'modified' => true,
        'enquiry' => true,
        'enquiry_status' => true,
    ];
}

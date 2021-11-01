<?php
declare(strict_types=1);

namespace Enquiry\Model\Entity;

use Cake\ORM\Entity;

/**
 * PriorityType Entity
 *
 * @property int $id
 * @property int $listing_id
 * @property string $title
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Enquiry\Model\Entity\Listing $listing
 * @property \Enquiry\Model\Entity\Enquiry[] $enquiries
 */
class PriorityType extends Entity
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
        'title' => true,
        'position' => true,
        'created' => true,
        'modified' => true,
        'listing' => true,
        'enquiries' => true,
    ];
}

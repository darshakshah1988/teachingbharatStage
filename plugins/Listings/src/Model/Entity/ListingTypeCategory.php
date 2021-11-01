<?php
declare(strict_types=1);

namespace Listings\Model\Entity;

use Cake\ORM\Entity;

/**
 * ListingTypeCategory Entity
 *
 * @property int $id
 * @property int $listing_type_id
 * @property string $title
 * @property int $sort_order
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Listings\Model\Entity\ListingType $listing_type
 * @property \Listings\Model\Entity\ListingDetail[] $listing_details
 */
class ListingTypeCategory extends Entity
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
        'listing_type_id' => true,
        'title' => true,
        'sort_order' => true,
        'created' => true,
        'modified' => true,
        'listing_type' => true,
        'listing_details' => true,
    ];
}

<?php
declare(strict_types=1);

namespace Listings\Model\Entity;

use Cake\ORM\Entity;

/**
 * ListingType Entity
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $sort_order
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Listings\Model\Entity\ListingTypeCategory[] $listing_type_categories
 * @property \Listings\Model\Entity\Listing[] $listings
 */
class ListingType extends Entity
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
        'title' => true,
        'slug' => true,
        'sort_order' => true,
        'created' => true,
        'modified' => true,
        'listing_type_categories' => true,
        'listings' => true,
    ];
}

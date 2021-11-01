<?php
declare(strict_types=1);

namespace Locations\Model\Entity;

use Cake\ORM\Entity;

/**
 * Location Entity
 *
 * @property int $id
 * @property int $parent_id
 * @property string $title
 * @property string $slug
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $iso_alpha2_code
 * @property string|null $iso_alpha3_code
 * @property int|null $iso_numeric_code
 * @property string|null $formatted_address
 * @property int $lft
 * @property int $rght
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Locations\Model\Entity\Location $parent_location
 * @property \Locations\Model\Entity\Listing[] $listings
 * @property \Locations\Model\Entity\Location[] $child_locations
 * @property \Locations\Model\Entity\UserProfile[] $user_profiles
 * @property \Locations\Model\Entity\Phinxlog[] $phinxlog
 */
class Location extends Entity
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
        'parent_id' => true,
        'title' => true,
        'slug' => true,
        'latitude' => true,
        'longitude' => true,
        'iso_alpha2_code' => true,
        'iso_alpha3_code' => true,
        'iso_numeric_code' => true,
        'formatted_address' => true,
        'lft' => true,
        'rght' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'parent_location' => true,
        'listings' => true,
        'child_locations' => true,
        'user_profiles' => true,
        'phinxlog' => true,
    ];
}

<?php
declare(strict_types=1);

namespace Settings\Model\Entity;

use Cake\ORM\Entity;

/**
 * Setting Entity
 *
 * @property int $id
 * @property int $listing_id
 * @property string $title
 * @property string $slug
 * @property string $config_value
 * @property string $manager
 * @property string $field_type
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Settings\Model\Entity\Listing $listing
 * @property \Settings\Model\Entity\Phinxlog[] $phinxlog
 */
class Setting extends Entity
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
        'slug' => true,
        'config_value' => true,
        'manager' => true,
        'field_type' => true,
        'created' => true,
        'modified' => true,
        'listing' => true,
        'phinxlog' => true,
    ];
}

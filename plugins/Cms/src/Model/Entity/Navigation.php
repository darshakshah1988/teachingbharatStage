<?php
declare(strict_types=1);

namespace Cms\Model\Entity;

use Cake\ORM\Entity;

/**
 * Navigation Entity
 *
 * @property int $id
 * @property int $listing_id
 * @property string $title
 * @property string $slug
 * @property int|null $parent_id
 * @property string $menu_link
 * @property int $is_nav_type
 * @property string $target
 * @property int $lft
 * @property int $rght
 * @property bool $status
 * @property bool|null $is_top
 * @property bool|null $is_bottom
 * @property int $position
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Cms\Model\Entity\Listing $listing
 * @property \Cms\Model\Entity\ParentNavigation $parent_navigation
 * @property \Cms\Model\Entity\ChildNavigation[] $child_navigations
 */
class Navigation extends Entity
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
        'parent_id' => true,
        'menu_link' => true,
        'is_nav_type' => true,
        'target' => true,
        'lft' => true,
        'rght' => true,
        'status' => true,
        'is_top' => true,
        'is_bottom' => true,
        'position' => true,
        'created' => true,
        'modified' => true,
        'listing' => true,
        'parent_navigation' => true,
        'child_navigations' => true,
    ];
}

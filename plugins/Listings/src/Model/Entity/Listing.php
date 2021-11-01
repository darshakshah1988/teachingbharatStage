<?php
declare(strict_types=1);

namespace Listings\Model\Entity;

use Cake\ORM\Entity;

/**
 * Listing Entity
 *
 * @property int $id
 * @property int $admin_user_id
 * @property string $code
 * @property int $listing_type_id
 * @property int|null $parent_id
 * @property string $title
 * @property string $slug
 * @property string|null $tag_line
 * @property string $protocol
 * @property string|null $domain_name
 * @property string|null $registration_no
 * @property \Cake\I18n\FrozenDate|null $registration_date
 * @property string|null $logo
 * @property string|null $logo_dir
 * @property int|null $logo_size
 * @property string|null $logo_type
 * @property string|null $banner
 * @property string|null $banner_dir
 * @property int|null $banner_size
 * @property string|null $banner_type
 * @property string|null $thumb_image
 * @property string|null $thumb_image_dir
 * @property int|null $thumb_image_size
 * @property string|null $thumb_image_type
 * @property int $location_id
 * @property string $address_line_1
 * @property string|null $address_line_2
 * @property string $postcode
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string $short_description
 * @property string $description
 * @property string $meta_title
 * @property string $meta_keyword
 * @property string $meta_description
 * @property bool|null $is_visible
 * @property bool $status
 * @property int $sort_order
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Listings\Model\Entity\AdminUser[] $admin_users
 * @property \Listings\Model\Entity\ListingType $listing_type
 * @property \Listings\Model\Entity\Listing $parent_listing
 * @property \Listings\Model\Entity\Location $location
 * @property \Listings\Model\Entity\AcademicYear[] $academic_years
 * @property \Listings\Model\Entity\InstitutionType[] $institution_types
 * @property \Listings\Model\Entity\ListingDetail[] $listing_details
 * @property \Listings\Model\Entity\Listing[] $child_listings
 * @property \Listings\Model\Entity\Role[] $roles
 */
class Listing extends Entity
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
        'admin_user_id' => true,
        'code' => true,
        'listing_type_id' => true,
        'parent_id' => true,
        'title' => true,
        'slug' => true,
        'tag_line' => true,
        'protocol' => true,
        'domain_name' => true,
        'registration_no' => true,
        'registration_date' => true,
        'logo' => true,
        'logo_dir' => true,
        'logo_size' => true,
        'logo_type' => true,
        'banner' => true,
        'banner_dir' => true,
        'banner_size' => true,
        'banner_type' => true,
        'thumb_image' => true,
        'thumb_image_dir' => true,
        'thumb_image_size' => true,
        'thumb_image_type' => true,
        'location_id' => true,
        'address_line_1' => true,
        'address_line_2' => true,
        'postcode' => true,
        'latitude' => true,
        'longitude' => true,
        'short_description' => true,
        'description' => true,
        'meta_title' => true,
        'meta_keyword' => true,
        'meta_description' => true,
        'is_visible' => true,
        'status' => true,
        'sort_order' => true,
        'created' => true,
        'modified' => true,
        'admin_users' => true,
        'listing_type' => true,
        'parent_listing' => true,
        'location' => true,
        'academic_years' => true,
        'institution_types' => true,
        'listing_details' => true,
        'child_listings' => true,
        'roles' => true,
    ];
}

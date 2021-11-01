<?php
declare(strict_types=1);

namespace Announcement\Model\Entity;

use Cake\ORM\Entity;

/**
 * Announcement Entity
 *
 * @property int $id
 * @property int $listing_id
 * @property int $admin_user_id
 * @property string $title
 * @property string|null $slug
 * @property string $description
 * @property int|null $is_popup
 * @property string|null $banner
 * @property string|null $banner_dir
 * @property int|null $banner_size
 * @property string|null $banner_type
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Announcement\Model\Entity\Listing $listing
 * @property \Announcement\Model\Entity\AdminUser $admin_user
 */
class Announcement extends Entity
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
        'title' => true,
        'slug' => true,
        'description' => true,
        'is_popup' => true,
        'banner' => true,
        'banner_dir' => true,
        'banner_size' => true,
        'banner_type' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'listing' => true,
        'admin_user' => true,
    ];

    /**
     * Fields that will be add in JSON response.
     *
     * @var array
     */
    protected $_virtual = ['image_path'];
    
    /**
     * Get the profile image path with a valid sapretar.
     *
     * @param  string  $value
     * @return string
     */
    protected function _getImagePath()
    {
        if($this->banner_dir){
            return str_replace("\\", "/", str_replace("webroot\img\\","", str_replace("webroot/img/","",$this->banner_dir)));
        } 
    }
}

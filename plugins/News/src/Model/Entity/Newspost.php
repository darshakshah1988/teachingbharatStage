<?php
declare(strict_types=1);

namespace News\Model\Entity;

use Cake\ORM\Entity;

/**
 * Newspost Entity
 *
 * @property int $id
 * @property int $listing_id
 * @property int $admin_user_id
 * @property string $title
 * @property string $slug
 * @property string $short_description
 * @property string $description
 * @property string|null $banner_image
 * @property string|null $banner_dir
 * @property string|null $banner_size
 * @property string|null $banner_type
 * @property string|null $header_image
 * @property string|null $header_dir
 * @property int|null $header_size
 * @property string|null $header_type
 * @property string $meta_title
 * @property string $meta_keyword
 * @property string $meta_description
 * @property bool $status
 * @property int $position
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \News\Model\Entity\Listing $listing
 * @property \News\Model\Entity\AdminUser $admin_user
 */
class Newspost extends Entity
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
        'short_description' => true,
        'description' => true,
        'banner_image' => true,
        'banner_dir' => true,
        'banner_size' => true,
        'banner_type' => true,
        'header_image' => true,
        'header_dir' => true,
        'header_size' => true,
        'header_type' => true,
        'meta_title' => true,
        'meta_keyword' => true,
        'meta_description' => true,
        'status' => true,
        'position' => true,
        'created' => true,
        'modified' => true,
        'listing' => true,
        'admin_user' => true, 
    ];

    protected $_virtual = ['banner_path', 'header_path']; 
    
    protected function _getBannerPath()
    {
        if($this->banner_dir){
            $path = str_replace("\\", "/", str_replace("webroot\img\\","", str_replace("webroot/img/","",$this->banner_dir)));
            return $path;
        }
    }
    
    protected function _getHeaderPath()
    {
        if($this->header_dir){
            return str_replace("\\", "/", str_replace("webroot\img\\","", str_replace("webroot/img/","",$this->header_dir)));
        }
    }
}

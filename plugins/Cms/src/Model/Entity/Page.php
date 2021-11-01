<?php
declare(strict_types=1);

namespace Cms\Model\Entity;

use Cake\ORM\Entity;

/**
 * Page Entity
 *
 * @property int $id
 * @property int $listing_id
 * @property string $title
 * @property string|null $sub_title
 * @property string $slug
 * @property string $short_description
 * @property string $description
 * @property string|null $banner
 * @property string|null $banner_dir
 * @property int|null $banner_size
 * @property string|null $banner_type
 * @property string $meta_title
 * @property string $meta_keyword
 * @property string $meta_description
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Cms\Model\Entity\Listing $listing
 */
class Page extends Entity
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
        'sub_title' => true,
        'slug' => true,
        'short_description' => true,
        'description' => true,
        'banner' => true,
        'banner_dir' => true,
        'banner_size' => true,
        'banner_type' => true,
        'meta_title' => true,
        'meta_keyword' => true,
        'meta_description' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'listing' => true,
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

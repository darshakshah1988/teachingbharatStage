<?php
declare(strict_types=1);

namespace Services\Model\Entity;

use Cake\ORM\Entity;

/**
 * Service Entity
 *
 * @property int $id
 * @property int $listing_id
 * @property string $title
 * @property string $slug
 * @property string $service_icon
 * @property string $short_description
 * @property string $description
 * @property bool $status
 * @property int $position
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Services\Model\Entity\Listing $listing
 * @property \Services\Model\Entity\Phinxlog[] $phinxlog
 */
class Service extends Entity
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
        'service_icon' => true,
        'short_description' => true,
        'description' => true,
        'status' => true,
        'position' => true,
        'banner_image' => true,
        'banner_dir' => true,
        'banner_size' => true,
        'banner_type' => true,
        'header_image' => true,
        'header_dir' => true,
        'header_size' => true,
        'header_type' => true,
        'created' => true,
        'modified' => true,
        'listing' => true,
        'phinxlog' => true,
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

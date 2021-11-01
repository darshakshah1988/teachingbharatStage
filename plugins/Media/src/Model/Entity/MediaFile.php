<?php
declare(strict_types=1);

namespace Media\Model\Entity;

use Cake\ORM\Entity;

/**
 * MediaFile Entity
 *
 * @property int $id
 * @property int $media_id
 * @property string $title
 * @property string|null $sub_title
 * @property string $description
 * @property string|null $external_link
 * @property string|null $media_image
 * @property string|null $media_image_dir
 * @property int|null $media_image_size
 * @property string|null $media_image_type
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Media\Model\Entity\Media $media
 */
class MediaFile extends Entity
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
        'media_id' => true,
        'listing_id' => true,
        'title' => true,
        'sub_title' => true,
        'description' => true,
        'external_link' => true,
        'media_image' => true,
        'media_image_dir' => true,
        'media_image_size' => true,
        'media_image_type' => true,
        'position' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'media' => true,
    ];

    /**
     * Fields that will be add in JSON response.
     *
     * @var array
     */
    protected $_virtual = ['media_image_path'];

    /**
     * Get the profile image path with a valid sapretar.
     *
     * @param  string  $value
     * @return string
     */
    protected function _getMediaImagePath()
    {
        if($this->media_image_dir){
            return str_replace("\\", "/", str_replace("webroot\img\\","", str_replace("webroot/img/","",$this->media_image_dir)));
        }
    }

}

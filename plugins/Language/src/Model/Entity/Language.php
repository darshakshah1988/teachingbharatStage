<?php
declare(strict_types=1);

namespace Language\Model\Entity;

use Cake\ORM\Entity;

/**
 * Language Entity
 *
 * @property int $id
 * @property string $title
 * @property string|null $code
 * @property string|null $locale
 * @property string|null $image
 * @property string|null $image_dir
 * @property int|null $image_size
 * @property string|null $image_type
 * @property int|null $position
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Language extends Entity
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
        'code' => true,
        'locale' => true,
        'image' => true,
        'image_dir' => true,
        'image_size' => true,
        'image_type' => true,
        'position' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
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
        if(isset($this->resume_dir)){
            return str_replace("\\", "/", str_replace("webroot\img\\","", str_replace("webroot/img/","",$this->image_dir)));
        }
    }
}

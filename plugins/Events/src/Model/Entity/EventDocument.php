<?php
declare(strict_types=1);

namespace Events\Model\Entity;

use Cake\ORM\Entity;

/**
 * EventDocument Entity
 *
 * @property int $id
 * @property int $event_id
 * @property int $file_type
 * @property string|null $title
 * @property string|null $caption
 * @property string|null $banner
 * @property string|null $banner_dir
 * @property int|null $banner_size
 * @property string|null $banner_type
 * @property \Cake\I18n\FrozenDate $start_date
 * @property \Cake\I18n\FrozenDate $end_date
 * @property int $position
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Events\Model\Entity\Event $event
 */
class EventDocument extends Entity
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
        'event_id' => true,
        'file_type' => true,
        'title' => true,
        'caption' => true,
        'banner' => true,
        'banner_dir' => true,
        'banner_size' => true,
        'banner_type' => true,
        'position' => true,
        'created' => true,
        'modified' => true,
        'event' => true,
    ];

    protected $_virtual = ['image_path'];
    
   

    protected function _getImagePath()
    {
        if(isset($this->banner_dir)){
            return str_replace("\\", "/", str_replace("webroot\img\\","", str_replace("webroot/img/","",$this->banner_dir)));
        }
    }
}

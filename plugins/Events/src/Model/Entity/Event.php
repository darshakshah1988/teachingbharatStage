<?php
declare(strict_types=1);

namespace Events\Model\Entity;

use Cake\ORM\Entity;

/**
 * Event Entity
 *
 * @property int $id
 * @property int $admin_user_id
 * @property int $listing_id
 * @property string $title
 * @property string|null $sub_title
 * @property string $short_description
 * @property string $description
 * @property string|null $location
 * @property string|null $organizar_name
 * @property string|null $organizer_email
 * @property string|null $organizer_contact_number
 * @property string|null $banner
 * @property string|null $banner_dir
 * @property int|null $banner_size
 * @property string|null $banner_type
 * @property \Cake\I18n\FrozenDate $start_date
 * @property \Cake\I18n\FrozenDate $end_date
 * @property string $meta_title
 * @property string $meta_keyword
 * @property string $meta_description
 * @property bool $status
 * @property int $position
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Events\Model\Entity\AdminUser $admin_user
 * @property \Events\Model\Entity\Listing $listing
 * @property \Events\Model\Entity\Event $parent_event
 * @property \Events\Model\Entity\EventDocument[] $event_documents
 * @property \Events\Model\Entity\EventSocialLink[] $event_social_links
 * @property \Events\Model\Entity\Event[] $child_events
 * @property \Events\Model\Entity\Phinxlog[] $phinxlog
 */
class Event extends Entity
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
        'listing_id' => true,
        'title' => true,
        'slug' => true,
        'sub_title' => true,
        'short_description' => true,
        'description' => true,
        'location' => true,
        'organizar_name' => true,
        'organizer_email' => true,
        'organizer_contact_number' => true,
        'banner' => true,
        'banner_dir' => true,
        'banner_size' => true,
        'banner_type' => true,
        'start_date' => true,
        'end_date' => true,
        'meta_title' => true,
        'meta_keyword' => true,
        'meta_description' => true,
        'status' => true,
        'position' => true,
        'created' => true,
        'modified' => true,
        'admin_user' => true,
        'listing' => true,
        'parent_event' => true,
        'event_documents' => true,
        'event_images' => true,
        'event_videos' => true,
        'event_social_links' => true,
        'child_events' => true,
    ];

    protected $_virtual = ['banner_path']; 

    protected function _getBannerPath()
    {
        if($this->banner_dir){
            $path = str_replace("\\", "/", str_replace("webroot\img\\","", str_replace("webroot/img/","",$this->banner_dir)));
            return $path;
        }
    }
}

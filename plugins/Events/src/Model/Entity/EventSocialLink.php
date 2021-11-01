<?php
declare(strict_types=1);

namespace Events\Model\Entity;

use Cake\ORM\Entity;

/**
 * EventSocialLink Entity
 *
 * @property int $id
 * @property int $event_id
 * @property string $social_type
 * @property string $social_url
 * @property int|null $position
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Events\Model\Entity\Event $event
 */
class EventSocialLink extends Entity
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
        'social_type' => true,
        'social_url' => true,
        'position' => true,
        'created' => true,
        'modified' => true,
        'event' => true,
    ];
}

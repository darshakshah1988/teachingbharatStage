<?php
declare(strict_types=1);

namespace Media\Model\Entity;

use Cake\ORM\Entity;

/**
 * Media Entity
 *
 * @property int $id
 * @property int $listing_id
 * @property string $media_type
 * @property string $title
 * @property bool $status
 * @property int $position
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Media\Model\Entity\Listing $listing
 * @property \Media\Model\Entity\MediaFile[] $media_files
 */
class Media extends Entity
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
        'media_type' => true,
        'title' => true,
        'status' => true,
        'position' => true,
        'created' => true,
        'modified' => true,
        'listing' => true,
        'media_files' => true,
    ];
}

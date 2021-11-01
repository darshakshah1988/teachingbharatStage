<?php
declare(strict_types=1);

namespace MicroSessions\Model\Entity;

use Cake\ORM\Entity;

/**
 * MicroSessionChapter Entity
 *
 * @property int $id
 * @property int $micro_session_id
 * @property string $title
 * @property string $video_url
 * @property string $chapter_file
 * @property string|null $chapter_file_dir
 * @property int|null $chapter_file_size
 * @property string|null $chapter_file_type
 * @property string|null $short_description
 * @property string|null $description
 * @property int $position
 * @property bool $is_free
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \MicroSessions\Model\Entity\MicroSession $micro_session
 */
class MicroSessionChapter extends Entity
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
        'micro_session_id' => true,
        'title' => true,
        'video_url' => true,
        'start_date' => true,
        'end_date' => true,
        'start_time' => true,
        'end_time' => true,
         'chapter_file' => true,
         'chapter_file_dir' => true,
         'chapter_file_size' => true,
         'chapter_file_type' => true,
        //'short_description' => true,
        //'description' => true,
        //'position' => true,
        //'is_free' => true,
        'created' => true,
        'modified' => true,
        'micro_session' => true,
    ];
}

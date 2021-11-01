<?php
declare(strict_types=1);

namespace Courses\Model\Entity;

use Cake\ORM\Entity;

/**
 * CourseChapter Entity
 *
 * @property int $id
 * @property int $course_id
 * @property string $title
 * @property string|null $video_url
 * @property string|null $chapter_file
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
 * @property \Courses\Model\Entity\Course $course
 */
class CourseChapter extends Entity
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
        'course_id' => true,
        'title' => true,
        'video_url' => true,
        'chapter_file' => true,
        'chapter_file_dir' => true,
        'chapter_file_size' => true,
        'chapter_file_type' => true,
        'short_description' => true,
        'description' => true,
        'position' => true,
        'is_free' => true,
        'created' => true,
        'modified' => true,
        'course' => true,
    ];


    /**
     * Fields that will be add in JSON response.
     *
     * @var array
     */
    protected $_virtual = ['chapter_file_path'];

    
    /**
     * Get the profile image path with a valid sapretar.
     *
     * @param  string  $value
     * @return string
     */
    protected function _getChapterFilePath()
    {
        if(isset($this->chapter_file_dir)){
            return str_replace("\\", "/", str_replace("webroot\img\\","", str_replace("webroot/img/","",$this->chapter_file_dir)));
        }
    }
}

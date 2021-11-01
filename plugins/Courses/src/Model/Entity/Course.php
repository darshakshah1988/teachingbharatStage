<?php
declare(strict_types=1);

namespace Courses\Model\Entity;

use Cake\ORM\Entity;

/**
 * Course Entity
 *
 * @property int $id
 * @property int $listing_id
 * @property int|null $parent_id
 * @property int $grading_type_id
 * @property string $title
 * @property string|null $section_name
 * @property string|null $code
 * @property \Cake\I18n\FrozenDate|null $start_date
 * @property \Cake\I18n\FrozenDate|null $end_date
 * @property int $lft
 * @property int $rght
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $board_id
 * @property int $subject_id
 * @property string|null $duration
 * @property string|null $price
 * @property string|null $discount_price
 * @property bool $is_free
 * @property string|null $sample_video
 * @property string|null $short_description
 * @property string|null $description
 *
 * @property \Courses\Model\Entity\Listing $listing
 * @property \Courses\Model\Entity\Course $parent_course
 * @property \Courses\Model\Entity\GradingType $grading_type
 * @property \Courses\Model\Entity\Board $board
 * @property \Courses\Model\Entity\Subject[] $subjects
 * @property \Courses\Model\Entity\CourseChapter[] $course_chapters
 * @property \Courses\Model\Entity\Course[] $child_courses
 * @property \Courses\Model\Entity\Phinxlog[] $phinxlog
 */
class Course extends Entity
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
        'parent_id' => true,
        'grading_type_id' => true,
        'title' => true,
        'section_name' => true,
        'code' => true,
        'start_date' => true,
        'end_date' => true,
        'no_of_seats' => true,
        'lft' => true,
        'rght' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'board_id' => true,
        'subject_id' => true,
        'duration' => true,
        'price' => true,
        'discount_price' => true,
        'is_free' => true,
        'sample_video' => true,
        'short_description' => true,
        'description' => true,
        'course_url' => true,
        'features' => true,
        'listing' => true,
        'what_learn' => true,
        'parent_course' => true,
        'grading_type' => true,
        'board' => true,
        'subject' => true,
        'subjects' => true,
        'course_chapters' => true,
        'child_courses' => true,
        'course_type' => true,
    ];
}

<?php
declare(strict_types=1);

namespace Courses\Model\Entity;

use Cake\ORM\Entity;

/**
 * CourseWatching Entity
 *
 * @property int $id
 * @property int $course_id
 * @property string $user_id
 * @property int|null $views
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Courses\Model\Entity\Course $course
 * @property \Courses\Model\Entity\User $user
 */
class CourseWatching extends Entity
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
        'user_id' => true,
        'views' => true,
        'created' => true,
        'modified' => true,
        'course' => true,
        'user' => true,
    ];
}

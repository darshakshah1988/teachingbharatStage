<?php
declare(strict_types=1);

namespace Orders\Model\Entity;

use Cake\ORM\Entity;

/**
 * TeacherStudentMapping Entity
 *
 * @property int $id
 * @property string $student_id
 * @property int $package_id
 * @property int $subject_id
 * @property string $micro_session_id
 * @property string $teacher_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Orders\Model\Entity\Student $student
 * @property \Orders\Model\Entity\Package $package
 * @property \Orders\Model\Entity\Subject $subject
 * @property \Orders\Model\Entity\MicroSession $micro_session
 * @property \Orders\Model\Entity\Teacher $teacher
 */
class TeacherStudentMapping extends Entity
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
        'student_id' => true,
        'package_id' => true,
        'subject_id' => true,
        'micro_session_id' => true,
        'teacher_id' => true,
        'created' => true,
        'modified' => true,
        'student' => true,
        'package' => true,
        'subject' => true,
        'micro_session' => true,
        'teacher' => true,
    ];
}

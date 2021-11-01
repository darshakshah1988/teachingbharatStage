<?php
declare(strict_types=1);

namespace Sessions\Model\Entity;

use Cake\ORM\Entity;

/**
 * SessionBooking Entity
 *
 * @property int $id
 * @property string $user_id
 * @property int $session_booking_id
 * @property int $course_id
 * @property string $uuid
 * @property int $meeting_id
 * @property string $host_id
 * @property string $host_email
 * @property string|null $topic
 * @property int $type
 * @property string|null $status
 * @property \Cake\I18n\FrozenTime $start_time
 * @property int $duration
 * @property string|null $start_url
 * @property string|null $join_url
 * @property string|null $password
 * @property string|null $h323_password
 * @property string|null $pstn_password
 * @property string|null $encrypted_password
 * @property string|null $settings
 * @property \Cake\I18n\FrozenTime $created_at
 *
 * @property \Sessions\Model\Entity\User $user
 * @property \Sessions\Model\Entity\Subject $subject
 * @property \Sessions\Model\Entity\GradingType $grading_type
 * @property \Sessions\Model\Entity\Board $board
 * @property \Sessions\Model\Entity\TeacherSchedule $teacher_schedule
 */
class Meeting extends Entity
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
        'user_id' => true,
        'session_booking_id' => true,
        'course_id' => true,
        'uuid' => true,
        'meeting_id' => true,
        'host_id' => true,
        'host_email' => true,
        'topic' => true,
        'type' => true,
        'status' => true,
        'start_time' => true,
        'duration' => true,
        'timezone' => true,
        'created_at' => true,
        'start_url' => true,
        'join_url' => true,
        'password' => true,
        'h323_password' => true,
        'pstn_password' => true,
        'encrypted_password' => true,
        'settings' => true
    ];
}

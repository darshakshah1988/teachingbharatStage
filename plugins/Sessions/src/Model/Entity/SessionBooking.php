<?php
declare(strict_types=1);

namespace Sessions\Model\Entity;

use Cake\ORM\Entity;

/**
 * SessionBooking Entity
 *
 * @property int $id
 * @property string $user_id
 * @property int $subject_id
 * @property int $grading_type_id
 * @property int $board_id
 * @property \Cake\I18n\FrozenDate|null $booking_date
 * @property int $teacher_schedule_id
 * @property string|null $razorpay_order
 * @property string|null $note
 * @property string|null $payment_method
 * @property string|null $transaction_status
 * @property string|null $transactionId
 * @property string|null $signature
 * @property string|null $transaction_responce
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Sessions\Model\Entity\User $user
 * @property \Sessions\Model\Entity\Subject $subject
 * @property \Sessions\Model\Entity\GradingType $grading_type
 * @property \Sessions\Model\Entity\Board $board
 * @property \Sessions\Model\Entity\TeacherSchedule $teacher_schedule
 */
class SessionBooking extends Entity
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
        'subject_id' => true,
        'grading_type_id' => true,
        'board_id' => true,
        'booking_date' => true,
        'topic' => true,
        'comment' => true,
        'session_status' => true,
        'teacher_schedule_id' => true,
        'razorpay_order' => true,
        'note' => true,
        'start_date' => true,
        'end_date' => true,
        'payment_method' => true,
        'transaction_status' => true,
        'transactionId' => true,
        'signature' => true,
        'transaction_responce' => true,
        'teacher_comment' => true,
        'reason' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'subject' => true,
        'grading_type' => true,
        'board' => true,
        'teacher_id' => true,
        'teacher_schedule' => true,
    ];
}

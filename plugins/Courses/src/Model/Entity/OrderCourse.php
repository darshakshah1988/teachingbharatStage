<?php
declare(strict_types=1);

namespace Courses\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderCourse Entity
 *
 * @property int $id
 * @property int $order_id
 * @property int $course_id
 * @property string|null $amount
 * @property string|null $discount
 * @property string|null $total_amount
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Courses\Model\Entity\Order $order
 * @property \Courses\Model\Entity\Course $course
 */
class OrderCourse extends Entity
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
        'order_id' => true,
        'course_id' => true,
        'amount' => true,
        'discount' => true,
        'total_amount' => true,
        'created' => true,
        'modified' => true,
        'order' => true,
        'course' => true,
    ];
}

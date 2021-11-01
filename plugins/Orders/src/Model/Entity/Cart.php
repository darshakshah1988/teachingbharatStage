<?php
declare(strict_types=1);

namespace Orders\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cart Entity
 *
 * @property int $id
 * @property string $user_id
 * @property string|null $sessionId
 * @property int $course_id
 * @property int $quantity
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Orders\Model\Entity\User $user
 * @property \Orders\Model\Entity\Course $course
 */
class Cart extends Entity
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
        'sessionId' => true,
        'course_id' => true,
        'quantity' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'course' => true,
    ];
}

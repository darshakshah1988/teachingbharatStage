<?php
declare(strict_types=1);

namespace Orders\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderCoupon Entity
 *
 * @property int $id
 * @property int $order_id
 * @property int $coupon_id
 * @property string $user_id
 * @property string|null $amount
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Orders\Model\Entity\Order $order
 * @property \Orders\Model\Entity\Coupon $coupon
 * @property \Orders\Model\Entity\User $user
 */
class OrderCoupon extends Entity
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
        'coupon_id' => true,
        'user_id' => true,
        'amount' => true,
        'created' => true,
        'modified' => true,
        'order' => true,
        'coupon' => true,
        'user' => true,
    ];
}

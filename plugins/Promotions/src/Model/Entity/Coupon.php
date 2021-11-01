<?php
declare(strict_types=1);

namespace Promotions\Model\Entity;

use Cake\ORM\Entity;

/**
 * Coupon Entity
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $coupon_type
 * @property string $discount
 * @property string|null $total
 * @property \Cake\I18n\FrozenDate|null $date_start
 * @property \Cake\I18n\FrozenDate|null $date_end
 * @property int $uses_total
 * @property int $uses_customer
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Coupon extends Entity
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
        'name' => true,
        'code' => true,
        'coupon_type' => true,
        'discount' => true,
        'total' => true,
        'date_start' => true,
        'date_end' => true,
        'uses_total' => true,
        'uses_customer' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
    ];
}

<?php
declare(strict_types=1);

namespace Orders\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property string|null $invoice_no
 * @property string $user_id
 * @property string|null $amount
 * @property string|null $discount
 * @property string|null $total_amount
 * @property \Cake\I18n\FrozenTime|null $order_date
 * @property string|null $razorpay_order
 * @property string|null $note
 * @property string|null $invoice_file
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Orders\Model\Entity\User $user
 * @property \Orders\Model\Entity\OrderCourse[] $order_courses
 * @property \Orders\Model\Entity\Phinxlog[] $phinxlog
 */
class Order extends Entity
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
        'invoice_no' => true,
        'user_id' => true,
        'amount' => true,
        'discount' => true,
        'total_amount' => true,
        'order_date' => true,
        'razorpay_order' => true,
        'note' => true,
        'invoice_file' => true,
        'payment_method' => true,
        'transaction_status' => true,
        'transactionId' => true,
        'signature' => true,
        'transaction_responce' => true,
        'additional_options' => true,
        'certificate_issue_date' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'order_courses' => true,
        'order_coupons' => true,
        
    ];
}

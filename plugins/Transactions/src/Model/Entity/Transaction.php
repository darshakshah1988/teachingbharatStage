<?php
declare(strict_types=1);

namespace Transactions\Model\Entity;

use Cake\ORM\Entity;

/**
 * Transaction Entity
 *
 * @property int $id
 * @property string $user_id
 * @property string $payment_method
 * @property string $transaction_type
 * @property string $transaction_status
 * @property string|null $amount
 * @property string|null $transactionId
 * @property string|null $transaction_responce
 * @property string|null $note
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Transactions\Model\Entity\User $user
 * @property \Transactions\Model\Entity\Phinxlog[] $phinxlog
 */
class Transaction extends Entity
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
        'payment_method' => true,
        'transaction_type' => true,
        'transaction_status' => true,
        'amount' => true,
        'transactionId' => true,
        'transaction_responce' => true,
        'note' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'phinxlog' => true,
    ];
}

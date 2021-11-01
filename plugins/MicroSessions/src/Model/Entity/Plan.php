<?php
declare(strict_types=1);

namespace MicroSessions\Model\Entity;

use Cake\ORM\Entity;

/**
 * Plan Entity
 *
 * @property int $id
 * @property int $plan_id
 * @property int $listing_id
 * @property string $slug
 * @property string $user_id
 * @property string $plan_name
 * @property string|null $duration
 * @property string|null $price
 * @property string|null $discount_price
 * @property string|null $features
 * @property string|null $other_details
 * @property \Cake\I18n\FrozenDate $start_date
 * @property \Cake\I18n\FrozenDate $end_date
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \MicroSessions\Model\Entity\Plan[] $plans
 * @property \MicroSessions\Model\Entity\Listing $listing
 * @property \MicroSessions\Model\Entity\User $user
 */
class Plan extends Entity
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
        'plan_id' => true,
        'listing_id' => true,
        'slug' => true,
        'user_id' => true,
        'plan_name' => true,
        'duration' => true,
        'price' => true,
        'discount_price' => true,
        'features' => true,
        'other_details' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'plans' => true,
        'listing' => true,
        'user' => true,
    ];
}

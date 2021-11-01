<?php
declare(strict_types=1);

namespace UserManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Occupation Entity
 *
 * @property int $id
 * @property string $title
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \UserManager\Model\Entity\UserProfile[] $user_profiles
 */
class Occupation extends Entity
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
        'title' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'user_profiles' => true,
    ];
}

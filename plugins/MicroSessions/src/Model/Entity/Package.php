<?php
declare(strict_types=1);

namespace MicroSessions\Model\Entity;

use Cake\ORM\Entity;

/**
 * Package Entity
 *
 * @property int $id
 * @property int $package_id
 * @property int $listing_id
 * @property string $slug
 * @property string $user_id
 * @property string $package_name
 * @property string $package_title
 * @property int $grading_type_id
 * @property int $board_id
 * @property int $subject_id
 * @property string|null $short_description
 * @property string|null $description
 * @property \Cake\I18n\FrozenDate $start_date
 * @property \Cake\I18n\FrozenDate $end_date
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified 
 *
 * @property \MicroSessions\Model\Entity\Package[] $packages
 * @property \MicroSessions\Model\Entity\Listing $listing
 * @property \MicroSessions\Model\Entity\User $user
 * @property \MicroSessions\Model\Entity\GradingType $grading_type
 * @property \MicroSessions\Model\Entity\Board $board
 * @property \MicroSessions\Model\Entity\Subject $subject
 */
class Package extends Entity
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
        'package_id' => true,
        'listing_id' => true,
        'slug' => true,
        'user_id' => true,
        'package_name' => true,
        'package_title' => true,
        'grading_type_id' => true,
        'board_id' => true,
        'subject_id' => true,
        'short_description' => true,
        'description' => true,
        'about' => true,            
        'what_included' => true,            
        'what_best' => true,            
        'faq' => true,            
        'status' => true,
        'created' => true,
        'modified' => true,
        'packages' => true,
        'listing' => true,
        'user' => true,
        'grading_type' => true,
        'board' => true,
        'subject' => true,
        'package_file' => true,
        'package_file_dir' => true,
        'package_file_size' => true,
        'package_file_type' => true,
    ];
}

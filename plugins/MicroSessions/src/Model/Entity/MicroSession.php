<?php
declare(strict_types=1);

namespace MicroSessions\Model\Entity;

use Cake\ORM\Entity;

/**
 * MicroSession Entity
 *
 * @property int $id
 * @property int $listing_id
 * @property string $slug
 * @property string $user_id
 * @property int|null $parent_id
 * @property int $grading_type_id
 * @property int $academic_year_id
 * @property string $title
 * @property int $board_id
 * @property int $subject_id
 * @property string|null $duration
 * @property string|null $price
 * @property string|null $discount_price
 * @property bool $is_free
 * @property string|null $short_description
 * @property string|null $description
 * @property string $section_name
 * @property string|null $code
 * @property \Cake\I18n\FrozenDate $start_date
 * @property \Cake\I18n\FrozenDate $end_date
 * @property bool $status
 * @property int $position
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \MicroSessions\Model\Entity\Listing $listing
 * @property \MicroSessions\Model\Entity\User $user
 * @property \MicroSessions\Model\Entity\ParentMicroSession $parent_micro_session
 * @property \MicroSessions\Model\Entity\GradingType $grading_type
 * @property \MicroSessions\Model\Entity\AcademicYear $academic_year
 * @property \MicroSessions\Model\Entity\Board $board
 * @property \MicroSessions\Model\Entity\Subject $subject
 * @property \MicroSessions\Model\Entity\ChildMicroSession[] $child_micro_sessions
 * @property \MicroSessions\Model\Entity\Phinxlog[] $phinxlog
 */
class MicroSession extends Entity
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
        'listing_id' => true,
        'slug' => true,
        'user_id' => true,
        
        'grading_type_id' => true,
        'academic_year_id' => true,
        'title' => true,
        'board_id' => true,
        'subject_id' => true,
        'duration' => true,
        'price' => true,
        'discount_price' => true,
        'is_free' => true,
        'short_description' => true,
        'description' => true,        
        'faq' => true,   
        'start_date' => true,
        'end_date' => true,
        'status' => true,
        'monday'=>true,
        'tuesday'=>true,
        'wednesday'=>true,
        'thursday'=>true,
        'friday'=>true,
        'saturday'=>true,
        'sunday'=>true,
        'plan_id'=>true,
        'package_id'=>true,
        'created' => true,
        'modified' => true,
        'listing' => true,
        'user' => true,
        'parent_micro_session' => true,
        'grading_type' => true,
        'academic_year' => true,
        'board' => true,
        'subject' => true,
        'child_micro_sessions' => true,
        'phinxlog' => true,
        'microsession_file' => true,
        'microsession_file_dir' => true,
        'microsession_file_size' => true,
        'microsession_file_type' => true,
    ];
}

<?php
declare(strict_types=1);

namespace UserManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserProfile Entity
 *
 * @property int $id
 * @property string $user_id
 * @property string|null $alt_mobile
 * @property \Cake\I18n\FrozenDate|null $dob
 * @property int|null $location_id
 * @property string|null $address_line_1
 * @property string|null $address_line_2
 * @property string|null $postcode
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $gender
 * @property string|null $qualification
 * @property string|null $college_university
 * @property int|null $occupation_id
 * @property string|null $experience
 * @property int|null $primary_subject_id
 * @property int|null $secondary_subject_id
 * @property string|null $hours_inweekdays
 * @property string|null $hours_inweekend
 * @property bool|null $is_digital_pen_tablet
 * @property bool|null $is_internet_speed_mbps
 * @property string|null $source_of_rudraa
 * @property string|null $resume
 * @property string|null $resume_dir
 * @property int|null $resume_size
 * @property string|null $resume_type
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \UserManager\Model\Entity\User $user
 * @property \UserManager\Model\Entity\Location $location
 * @property \UserManager\Model\Entity\Occupation $occupation
 * @property \UserManager\Model\Entity\PrimarySubject $primary_subject
 * @property \UserManager\Model\Entity\SecondarySubject $secondary_subject
 */
class UserProfile extends Entity
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
        'mobile' => true,
        'alt_mobile' => true,
        'dob' => true,
        'location_id' => true,
        'address_line_1' => true,
        'address_line_2' => true,
        'postcode' => true,
        'latitude' => true,
        'longitude' => true,
        'gender' => true,
        'grading_type_id' => true,
        'qualification' => true,
        'college_university' => true,
        'occupation_id' => true,
        'experience' => true,
        'experience_month' => true,
        'rate' => true,
        'primary_subject_id' => true,
        'secondary_subject_id' => true,
        'hours_inweekdays' => true,
        'hours_inweekend' => true,
        'is_digital_pen_tablet' => true,
        'is_internet_speed_mbps' => true,
        'source_of_rudraa' => true,
        'pin_number' => true,
        'resume' => true,
        'resume_dir' => true,
        'resume_size' => true,
        'resume_type' => true,
        'about_me' => true,
        'achievement' => true,
        'other_achievement' => true,
        'digital_experience' => true,
        'sms_otp' => true,
        'is_mobile_verified' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'location' => true,
        'occupation' => true,
        'primary_subject' => true,
        'secondary_subject' => true,
        'password' => true,
    ];


    /**
     * Fields that will be add in JSON response.
     *
     * @var array
     */
    protected $_virtual = ['resume_path'];

    
    /**
     * Get the profile image path with a valid sapretar.
     *
     * @param  string  $value
     * @return string
     */
    protected function _getResumePath()
    {
        if(isset($this->resume_dir)){
            return str_replace("\\", "/", str_replace("webroot\img\\","", str_replace("webroot/img/","",$this->resume_dir)));
        }
    }


}

<?php
declare(strict_types=1);

namespace UserManager\Model\Entity;

use Cake\ORM\Entity;
use CakeDC\Users\Model\Entity\User as CakeDCUser;

/**
 * User Entity
 *
 * @property string $id
 * @property string $username
 * @property string|null $email
 * @property string $password
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $token
 * @property \Cake\I18n\FrozenTime|null $token_expires
 * @property string|null $api_token
 * @property \Cake\I18n\FrozenTime|null $activation_date
 * @property string|null $secret
 * @property bool|null $secret_verified
 * @property \Cake\I18n\FrozenTime|null $tos_date
 * @property bool $active
 * @property bool $is_superuser
 * @property string|null $role
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string|null $additional_data
 *
 * @property \UserManager\Model\Entity\SocialAccount[] $social_accounts
 * @property \UserManager\Model\Entity\UserToken[] $user_tokens
 */
class User extends CakeDCUser
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
        'code' => true,
        'username' => true,
        'email' => true,
        'zoom_email' => true,
        'password' => true,
        'first_name' => true,
        'last_name' => true,
        'token' => true,
        'token_expires' => true,
        'api_token' => true,
        'activation_date' => true,
        'secret' => true,
        'secret_verified' => true,
        'tos_date' => true,
        'active' => true,
        'is_superuser' => true,
        'role' => true,
        'profile_photo' => true,
        'photo_dir' => true,
        'photo_size' => true,
        'photo_type' => true,
        'comment' => true,
        'created' => true,
        'modified' => true,
        'additional_data' => true,
        'social_accounts' => true,
        'user_tokens' => true,
        'user_profiles' => true,
        'user_profile' => true,
        'referred_by' => true,
        'teacher_schedules' => true,
        'grading_types' => true,
        'boards' => true,
        'transactions' => true,
        'user_documents' => true,
        'languages' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
        'token',
    ];
    /**
     * Fields that will be add in JSON response.
     *
     * @var array
     */
    protected $_virtual = ['name', 'image_path'];

    /**
     * Get the full name.
     *
     * @param  string  $value
     * @return string
     */
    protected function _getName()
    {
        $name[] = $this->first_name;
        $name[] = $this->last_name;
        return implode(" ", array_filter($name));
    }

    protected function _getImagePath()
    { 
        if(isset($this->photo_dir)){
            return str_replace("\\", "/", str_replace("webroot\img\\","", str_replace("webroot/img/","",$this->photo_dir)));
        }
    }
    
}

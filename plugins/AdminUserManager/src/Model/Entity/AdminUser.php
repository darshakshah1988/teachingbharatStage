<?php
declare(strict_types=1);

namespace AdminUserManager\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * AdminUser Entity
 *
 * @property int $id
 * @property int $listing_id
 * @property string $title
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $last_name
 * @property string $mobile
 * @property \Cake\I18n\FrozenDate $dob
 * @property string $email
 * @property string|null $profile_photo
 * @property string|null $photo_dir
 * @property int|null $photo_size
 * @property string|null $photo_type
 * @property string $password
 * @property bool|null $is_supper_admin
 * @property bool $status
 * @property bool|null $is_verified
 * @property int|null $login_count
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \AdminUserManager\Model\Entity\Listing $listing
 * @property \AdminUserManager\Model\Entity\Role[] $roles
 */
class AdminUser extends Entity
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
        'title' => true,
        'first_name' => true,
        'middle_name' => true,
        'last_name' => true,
        'mobile' => true,
        'dob' => true,
        'email' => true,
        'profile_photo' => true,
        'photo_dir' => true,
        'photo_size' => true,
        'photo_type' => true,
        'password' => true,
        'is_supper_admin' => true,
        'status' => true,
        'is_verified' => true,
        'login_count' => true,
        'created' => true,
        'modified' => true,
        'listing' => true,
        'roles' => true,
        'base64img' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];

    /**
     * Fields that will be add in JSON response.
     *
     * @var array
     */
    protected $_virtual = ['image_path', 'name'];


    /**
     * Get the profile image path with a valid sapretar.
     *
     * @param  string  $value
     * @return string
     */
    protected function _getImagePath()
    {
        if(isset($this->photo_dir)){
            return str_replace("\\", "/", str_replace("webroot\img\\","", str_replace("webroot/img/","",$this->photo_dir)));
        }
    }

    /**
     * Get the full name.
     *
     * @param  string  $value
     * @return string
     */
    protected function _getName()
    {
        $name[] = $this->title;
        $name[] = $this->first_name;
        $name[] = $this->middle_name;
        $name[] = $this->last_name;
        return implode(" ", array_filter($name));
    }

    /**
     * Set the user's encrypted password.
     *
     * @param  string  $value
     * @return void
     */
    protected function _setPassword($password) {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }

}

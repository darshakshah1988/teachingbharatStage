<?php
declare(strict_types=1);

namespace Reviews\Model\Entity;

use Cake\ORM\Entity;

/**
 * Review Entity
 *
 * @property int $id
 * @property string|null $user_id
 * @property int $course_id
 * @property string $name
 * @property int $rating
 * @property string|null $description
 * @property string|null $photo
 * @property string|null $photo_dir
 * @property int|null $photo_size
 * @property string|null $photo_type
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \UserManager\Model\Entity\User $user
 * @property \Courses\Model\Entity\Course $course
 */
class Review extends Entity
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
        'course_id' => true,
        'review_type' => true,
        'name' => true,
        'rating' => true,
        'description' => true,
        'photo' => true,
        'photo_dir' => true,
        'photo_size' => true,
        'photo_type' => true,
        'status' => true,
        'designation' => true,
        'location' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'course' => true,
    ];

    /**
     * Fields that will be add in JSON response.
     *
     * @var array
     */
    protected $_virtual = ['photo_path'];

    /**
     * Get the profile image path with a valid sapretar.
     *
     * @param  string  $value
     * @return string
     */
    protected function _getPhotoPath()
    {
        if($this->photo_dir){
            return str_replace("\\", "/", str_replace("webroot\img\\","", str_replace("webroot/img/","",$this->photo_dir)));
        }
    }
}

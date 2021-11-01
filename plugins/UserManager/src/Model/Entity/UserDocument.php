<?php
declare(strict_types=1);

namespace UserManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserDocument Entity
 *
 * @property int $id
 * @property string $user_id
 * @property int $document_type_id
 * @property string|null $document_file
 * @property string|null $document_dir
 * @property int|null $document_size
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \UserManager\Model\Entity\DocumentType $document_type
 * @property \UserManager\Model\Entity\User $user
 */
class UserDocument extends Entity
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
        'document_type_id' => true,
        'document_file' => true,
        'document_dir' => true,
        'document_size' => true,
        'document_type' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
    ];

     /**
     * Fields that will be add in JSON response.
     *
     * @var array
     */
    protected $_virtual = ['document_file_path'];

    
    /**
     * Get the profile image path with a valid sapretar.
     *
     * @param  string  $value
     * @return string
     */
    protected function _getDocumentFilePath()
    {
        if(isset($this->document_dir)){
            return str_replace("\\", "/", str_replace("webroot\img\\","", str_replace("webroot/img/","",$this->document_dir)));
        }
    }
}

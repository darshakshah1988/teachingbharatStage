<?php
declare(strict_types=1);

namespace UserManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserDocuments Model
 *
 * @property \UserManager\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \UserManager\Model\Table\DocumentTypesTable&\Cake\ORM\Association\BelongsTo $DocumentTypes
 *
 * @method \UserManager\Model\Entity\UserDocument newEmptyEntity()
 * @method \UserManager\Model\Entity\UserDocument newEntity(array $data, array $options = [])
 * @method \UserManager\Model\Entity\UserDocument[] newEntities(array $data, array $options = [])
 * @method \UserManager\Model\Entity\UserDocument get($primaryKey, $options = [])
 * @method \UserManager\Model\Entity\UserDocument findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \UserManager\Model\Entity\UserDocument patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \UserManager\Model\Entity\UserDocument[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \UserManager\Model\Entity\UserDocument|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \UserManager\Model\Entity\UserDocument saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \UserManager\Model\Entity\UserDocument[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \UserManager\Model\Entity\UserDocument[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \UserManager\Model\Entity\UserDocument[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \UserManager\Model\Entity\UserDocument[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserDocumentsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->_dir = 'webroot' . DS . 'img' . DS . 'uploads' . DS;

        $this->setTable('user_documents');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'UserManager.Users',
        ]);
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'document_file' => [
                'fields' => [
                    // if these fields or their defaults exist
                    // the values will be set.
                    'dir' => 'document_dir', // defaults to `dir`
                    'size' => 'document_size', // defaults to `size`
                    'type' => 'document_type', // defaults to `type`
                ],
                'nameCallback' => function ($table, $entity, $data, $field, $settings) {
                        $ext = pathinfo($data->getClientFilename(), PATHINFO_EXTENSION);
                        return rand(100000,999999).time().rand(10000 , 99999).".".$ext;
                        //return strtolower(str_replace(" ","",$data['name']));
                },
                'path' => $this->_dir.'{model}{DS}{field}{DS}',
                'keepFilesOnDelete' => false
            ],
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator->setProvider('upload', \Josegonzalez\Upload\Validation\UploadValidation::class);
        $validator->setProvider('upload', \Josegonzalez\Upload\Validation\ImageValidation::class);
        $validator->setProvider('upload', \Josegonzalez\Upload\Validation\DefaultValidation::class);

        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('document_type_id')
            ->notEmptyString('document_type_id', 'Document Type is required field.');

     
        $validator
            ->add('document_file', 'customName', [
                'rule' => 'isFileUpload',
                'message' => 'Document is required',
                'provider' => 'upload',
                'on' => function($context) {
                    return $context['newRecord'];
                }
            ]);

        $validator->add('document_file', 'file', [
                'rule' => ['mimeType', ['image/jpeg', 'image/png','application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.oasis.opendocument.text']],
                'on' => function ($context) {
                    //dd($context['data']['resume']);
                    return !empty($context['data']['document_file']) && $context['data']['document_file']->getError() == UPLOAD_ERR_OK;
                },
                'message' => 'Your document is not valid! please use valid format e.g JPG, PNG, PDF, DOC, DOCX',
                'last' => true,
            ]);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}

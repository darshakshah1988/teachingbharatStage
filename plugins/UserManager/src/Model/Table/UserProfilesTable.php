<?php
declare(strict_types=1);

namespace UserManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use App\MobileSms;
use Cake\Event\EventInterface;
use Cake\Datasource\EntityInterface;
use ArrayObject;

/**
 * UserProfiles Model
 *
 * @property \UserManager\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \UserManager\Model\Table\LocationsTable&\Cake\ORM\Association\BelongsTo $Locations
 * @property \UserManager\Model\Table\OccupationsTable&\Cake\ORM\Association\BelongsTo $Occupations
 * @property \UserManager\Model\Table\PrimarySubjectsTable&\Cake\ORM\Association\BelongsTo $PrimarySubjects
 * @property \UserManager\Model\Table\SecondarySubjectsTable&\Cake\ORM\Association\BelongsTo $SecondarySubjects
 *
 * @method \UserManager\Model\Entity\UserProfile newEmptyEntity()
 * @method \UserManager\Model\Entity\UserProfile newEntity(array $data, array $options = [])
 * @method \UserManager\Model\Entity\UserProfile[] newEntities(array $data, array $options = [])
 * @method \UserManager\Model\Entity\UserProfile get($primaryKey, $options = [])
 * @method \UserManager\Model\Entity\UserProfile findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \UserManager\Model\Entity\UserProfile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \UserManager\Model\Entity\UserProfile[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \UserManager\Model\Entity\UserProfile|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \UserManager\Model\Entity\UserProfile saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \UserManager\Model\Entity\UserProfile[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \UserManager\Model\Entity\UserProfile[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \UserManager\Model\Entity\UserProfile[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \UserManager\Model\Entity\UserProfile[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserProfilesTable extends Table
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

        $this->setTable('user_profiles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'UserManager.Users',
        ]);
        $this->belongsTo('Locations', [
            'foreignKey' => 'location_id',
            'joinType' => 'LEFT',
            'className' => 'Locations.Locations',
        ]);

        $this->belongsTo('GradingTypes', [
            'foreignKey' => 'grading_type_id',
            'joinType' => 'LEFT',
            'className' => 'Courses.GradingTypes',
        ]);

        $this->belongsTo('Occupations', [
            'foreignKey' => 'occupation_id',
            'className' => 'UserManager.Occupations',
        ]);
        $this->belongsTo('PrimarySubjects', [
            'foreignKey' => 'primary_subject_id',
            'className' => 'Courses.Subjects',
        ]);
        $this->belongsTo('SecondarySubjects', [
            'foreignKey' => 'secondary_subject_id',
            'className' => 'Courses.Subjects',
        ]);

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'resume' => [
                'fields' => [
                    // if these fields or their defaults exist
                    // the values will be set.
                    'dir' => 'resume_dir', // defaults to `dir`
                    'size' => 'resume_size', // defaults to `size`
                    'type' => 'resume_type', // defaults to `type`
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
            ->notEmptyString('mobile', 'Mobile number is required')
            ->add('mobile', [
                'maxLength' => [
                    'rule' => ['maxLength', 10],
                    'message' => 'Mobile number is too long. The limit is 14 characters.'
                ],
                'minLength' => [
                    'rule' => ['minLength', 10],
                    'message' => 'Mobile number is short. The min limit is 10 characters.'
                ],
                'custom' => [
                    'rule' => ['numeric'],
                    'on' => function($context) {
                    return !empty($context['data']['mobile']);
                },
                    'message' => 'Invalid mobile number! mobile number format: eg 10-14.'
                ]
        ]); 

        $validator
            ->scalar('alt_mobile')
            ->maxLength('alt_mobile', 20)
            ->allowEmptyString('alt_mobile');

        $validator
            ->date('dob')
            ->notEmptyDate('dob', 'Date of birth cannot be left empty');

        $validator
            ->scalar('address_line_1')
            ->maxLength('address_line_1', 150)
            ->allowEmptyString('address_line_1');

        $validator
            ->scalar('address_line_2')
            ->maxLength('address_line_2', 150)
            ->allowEmptyString('address_line_2');

        $validator
            ->scalar('postcode')
            ->maxLength('postcode', 8)
            ->allowEmptyString('postcode');

        $validator
            ->scalar('gender')
            ->maxLength('gender', 10)
            ->allowEmptyString('gender');

        $validator
            ->scalar('qualification')
            ->maxLength('qualification', 250)
            ->notEmptyString('qualification');

        $validator
            ->scalar('college_university')
            ->maxLength('college_university', 250)
            ->notEmptyString('college_university');

        $validator
            ->scalar('experience')
            ->maxLength('experience', 50)
            ->notEmptyString('experience');

        $validator
            ->scalar('hours_inweekdays')
            ->maxLength('hours_inweekdays', 255)
            ->notEmptyString('hours_inweekdays');

        $validator
            ->scalar('hours_inweekend')
            ->maxLength('hours_inweekend', 255)
            ->notEmptyString('hours_inweekend');

        $validator
            ->boolean('is_digital_pen_tablet')
            ->allowEmptyString('is_digital_pen_tablet');

        $validator
            ->boolean('is_internet_speed_mbps')
            ->allowEmptyString('is_internet_speed_mbps');

        $validator
            ->scalar('source_of_rudraa')
            ->maxLength('source_of_rudraa', 255)
            ->notEmptyString('source_of_rudraa');

        // $validator
        //    ->maxLength('resume', 255)
        //    ->notEmptyFile('resume', 'Resume document is required');

        $validator
        //->allowEmptyString('resume', 'update')
        ->add('resume', 'customName', [
            'rule' => 'isFileUpload',
            'message' => 'Resume document is required',
            'provider' => 'upload',
            'on' => function($context) {
                return $context['newRecord'];
                // return !empty($context['data']['resume']) && $context['data']['resume']->getError() == UPLOAD_ERR_OK;
            }
        ]);

        $validator->add('resume', 'file', [
                'rule' => ['mimeType', ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.oasis.opendocument.text']],
                'on' => function ($context) {
                    //dd($context['data']['resume']);
                    return !empty($context['data']['resume']) && $context['data']['resume']->getError() == UPLOAD_ERR_OK;
                },
                'message' => 'Resume document is not valid! please use valid format e.g PDF, DOC, DOCX',
                'last' => true,
            ]);


        $validator
            ->allowEmptyFile('profile_photo');

        $validator
            ->scalar('about_me')
            ->allowEmptyString('about_me');

        $validator
            ->scalar('achievement')
            ->maxLength('achievement', 255)
            ->allowEmptyString('achievement');

        $validator
            ->scalar('other_achievement')
            ->maxLength('other_achievement', 255)
            ->allowEmptyString('other_achievement');

        $validator
            ->scalar('digital_experience')
            ->maxLength('digital_experience', 255)
            ->allowEmptyString('digital_experience');

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
        //$rules->add($rules->existsIn(['location_id'], 'Locations'), ['errorField' => 'location_id']);
        $rules->add($rules->existsIn(['occupation_id'], 'Occupations'), ['errorField' => 'occupation_id']);
        $rules->add($rules->existsIn(['primary_subject_id'], 'PrimarySubjects'), ['errorField' => 'primary_subject_id']);
        $rules->add($rules->existsIn(['secondary_subject_id'], 'SecondarySubjects'), ['errorField' => 'secondary_subject_id']);
        $rules->add($rules->isUnique(['mobile']), '_isUnique', [
                'errorField' => 'mobile',
                'message' => __d('cake_d_c/users', 'Mobile already exists'),
            ]);
        return $rules;
    }

    /**
     * afterSave
     * 
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
     public function afterSave(EventInterface $event, EntityInterface $entity)
    {
        if($entity->isDirty('mobile') || $entity->is_mobile_verified == null) {
            $data = $entity->toArray();
            $uinfo = $data;
            $event = new Event('Users.User.afterChangeMobile', $this, ['user' => $data]);
            $this->getEventManager()->dispatch($event); 
        }

    }
}

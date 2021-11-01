<?php
declare(strict_types=1);

namespace UserManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use CakeDC\Users\Model\Table\UsersTable as CakeDCUsers; 
/**
 * Users Model 
 *
 * @property \UserManager\Model\Table\SocialAccountsTable&\Cake\ORM\Association\HasMany $SocialAccounts
 * @property \UserManager\Model\Table\UserTokensTable&\Cake\ORM\Association\HasMany $UserTokens
 *
 * @method \UserManager\Model\Entity\User newEmptyEntity()
 * @method \UserManager\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \UserManager\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \UserManager\Model\Entity\User get($primaryKey, $options = [])
 * @method \UserManager\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \UserManager\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \UserManager\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \UserManager\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \UserManager\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \UserManager\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \UserManager\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \UserManager\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \UserManager\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends CakeDCUsers
{

    /**
     * Role Constants
     */
    public const ROLE_USER = 'student';
    public const ROLE_ADMIN = 'admin'; 
     /**
     * Flag to set email check in buildRules or not
     *
     * @var bool
     */
    public $isValidateEmail = true;
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
        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Listable');

        $this->addBehavior('RandomString', [
            'field' => 'code',
            'case'=>'upper'
            ]
        );

        $this->hasMany('SocialAccounts', [
            'foreignKey' => 'user_id',
            'className' => 'UserManager.SocialAccounts',
        ]);
        $this->hasMany('UserTokens', [
            'foreignKey' => 'user_id',
            'className' => 'UserManager.UserTokens',
        ]);

        $this->hasMany('Transactions', [
            'foreignKey' => 'user_id',
            'className' => 'Transactions.Transactions',
        ]); 

        $this->hasOne('UserProfiles', [
            'foreignKey' => 'user_id',
            'joinType' => "LEFT",
            'className' => 'UserManager.UserProfiles',
        ]);

        $this->belongsToMany('Boards', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'board_id',
            'joinTable' => 'users_boards',
        ]);

        $this->belongsToMany('GradingTypes', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'grading_type_id',
            'joinTable' => 'users_grading_types',
        ]);
        $this->belongsToMany('TeacherSchedules', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'teacher_schedule_id',
            'joinTable' => 'users_teacher_schedules',
        ]);

        $this->belongsToMany('Languages', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'language_id',
            'joinTable' => 'users_languages',
        ]);

        $this->hasMany('SocialAccounts', [
            'foreignKey' => 'user_id',
            'className' => 'CakeDC/Users.SocialAccounts',
        ]);

        $this->hasMany('UserDocuments', [
            'foreignKey' => 'user_id',
            'className' => 'UserManager.UserDocuments',
        ]);

        $this->hasMany('Reviews', [
            'className' => 'Reviews.Reviews',
            'foreignKey' => 'user_id',
            'conditions' => ['Reviews.review_type' => 'user'],
        ]);

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'profile_photo' => [
                'fields' => [
                    // if these fields or their defaults exist
                    // the values will be set.
                    'dir' => 'photo_dir', // defaults to `dir`
                    'size' => 'photo_size', // defaults to `size`
                    'type' => 'photo_type', // defaults to `type`
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
        $validator
            ->allowEmptyString('id', null, 'create');

        $validator
            ->requirePresence('username', 'create')
            ->notEmptyString('username');

        $validator
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->allowEmptyString('first_name');

        $validator
            ->allowEmptyString('last_name');

        $validator
            ->allowEmptyString('token');

        $validator
            ->add('token_expires', 'valid', ['rule' => 'datetime'])
            ->allowEmptyDateTime('token_expires');

        $validator
            ->allowEmptyString('api_token');

        $validator
            ->add('activation_date', 'valid', ['rule' => 'datetime'])
            ->allowEmptyDateTime('activation_date');

        $validator
            ->add('tos_date', 'valid', ['rule' => 'datetime'])
            ->allowEmptyDateTime('tos_date');
		$validator
            ->email('zoom_email')
            ->allowEmptyString('zoom_email');
		 $validator
            ->email('email')
            ->notEmptyString('email');
        return $validator;
    }

    /**
     * Adds some rules for password confirm
     * @param \Cake\Validation\Validator $validator Cake validator object.
     * @return \Cake\Validation\Validator
     */
    public function validationPasswordConfirm(Validator $validator)
    {
        $validator
            ->requirePresence('password_confirm', 'create')
            ->notBlank('password_confirm');

       
        $validator
            ->requirePresence('password', 'create')
            ->notBlank('password')
            ->add('password', [
                    'minLength' => ['rule' => ['minLength', 6], 'message' => 'Your password must be at least 6 characters long'],
                    'maxLength' => ['rule' => ['maxLength', 15], 'message' => 'Password is too long. The limit is 15 characters..'],
                    // 'custom' => ['rule' => [$this, 'pregMatch'], 'message' => 'Password must contain at least one small & one capital alphabet and numeric digit.']
            ])
            ->add('password', [
                'password_confirm_check' => [
                    'last' => true,
                    'rule' => ['compareWith', 'password_confirm'],
                    'message' => __d(
                        'cake_d_c/users',
                        'Your password does not match your confirm password. Please try again'
                    ),
                    'allowEmpty' => false,

                ]]);

        return $validator; 
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationTeaching(Validator $validator): Validator
    {
        $validator
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('username')
            ->maxLength('username', 255)
            ->requirePresence('username', 'create')
            ->notEmptyString('username');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 50)
            ->notEmptyString('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 50)
            ->allowEmptyString('last_name');

        $validator
            ->email('email')
            ->notEmptyString('email');

        return $validator;
    }

    /**
     * Custom finder to filter active users
     *
     * @param \Cake\ORM\Query $query Query object to modify
     * @return \Cake\ORM\Query
     */
    public function findActive(Query $query)
    {
        $query->where(['Users.active' => 1]);
        $query->where(['Users.password IS NOT' => null]);

        return $query;
    }

    /**
     * Wrapper for all validation rules for register
     * @param \Cake\Validation\Validator $validator Cake validator object.
     *
     * @return \Cake\Validation\Validator
     */
    public function validationTeacherRegister(Validator $validator)
    {
        $validator = $this->validationTeaching($validator);
        return $validator;
    }

     /**
     * This auth function is a 'finder' to use check role is teacher
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @param type $options Options Array
     * @return \Cake\ORM\Query
     */

    public function findTeacher(\Cake\ORM\Query $query, array $options)
    {
        return $query->where(['Users.role' => 'teacher']);
    }

    /**
     * This auth function is a 'finder' to use check role is students
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @param type $options Options Array
     * @return \Cake\ORM\Query
     */

    public function findStudent(\Cake\ORM\Query $query, array $options)
    {
        return $query->where(['Users.role' => 'student']);
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
        $rules->add($rules->isUnique(['username']), '_isUnique', [
            'errorField' => 'username',
            'message' => __d('cake_d_c/users', 'Username already exists'),
        ]);
        if ($this->isValidateEmail) {
            $rules->add($rules->isUnique(['email']), '_isUnique', [
                'errorField' => 'email',
                'message' => __d('cake_d_c/users', 'Email already exists'),
            ]);
            $rules->add($rules->isUnique(['zoom_email']), '_isUnique', [
                'errorField' => 'zoom_email',
                'message' => __d('cake_d_c/users', 'Email already exists'),
            ]);
        }

        return $rules;
    }

    public function findBoard(Query $query, array $options)
    {
        if (isset($options['boards']) && !empty($options['boards'])) {
            $query->matching("Boards", function($query) use($options){
                    if(is_array($options['boards'])){
                        $query->where(function ($exp, $q) use($options){
                            return $exp->in('Boards.id', $options['boards']);
                            });
                    }else{
                        $query->where(['Boards.id' => $options['boards']]);
                    }
                return $query;
            });
        }
        return $query;
    }

    public function findGrad(Query $query, array $options)
    {
        if (isset($options['grads']) && !empty($options['grads'])) {
            $query->matching("GradingTypes", function($query) use($options){
                if(is_array($options['grads'])){
                    $query->where(function ($exp, $q) use($options){
                        return $exp->in('GradingTypes.id', $options['grads']);
                    });
                }else{
                    $query->where(['GradingTypes.id' => $options['grads']]);
                }
                return $query;
            });
        }
        return $query;
    }


    public function findSubject(Query $query, array $options)
    {
        if (isset($options['subjects']) && !empty($options['subjects'])) {
            if(is_array($options['subjects'])){
                
                $query->where(function ($exp, $q) use($options) {
                    return $exp->or([
                            'UserProfiles.primary_subject_id IN' => $options['subjects'],
                            'UserProfiles.secondary_subject_id IN' => $options['subjects'],
                        ]);
                });
                // ->where(function ($exp, $q) use($options){
                //     return $exp->in('UserProfiles.primary_subject_id', $options['subjects']);
                // });
            }else{
                $query->where(function ($exp, $q) use($options) {
                    return $exp->or([
                            'UserProfiles.primary_subject_id' => $options['subjects'],
                            'UserProfiles.secondary_subject_id' => $options['subjects'],
                        ]);
                });
                //$query->where(['UserProfiles.primary_subject_id' => $options['subjects']]);
            }
        }
        return $query;
    } 


    public function findBySchedule(Query $query, array $options)
    {
        if (isset($options['teacher_schedules']) && !empty($options['teacher_schedules'])) {
            $query->matching("TeacherSchedules", function($query) use($options){
                    if(is_array($options['teacher_schedules'])){
                        $query->where(function ($exp, $q) use($options){
                            return $exp->in('TeacherSchedules.id', $options['teacher_schedules']);
                            });
                    }else{
                        $query->where(['TeacherSchedules.id' => $options['teacher_schedules']]);
                    }
                return $query;
            });
        }
        return $query;
    }
 
   
}

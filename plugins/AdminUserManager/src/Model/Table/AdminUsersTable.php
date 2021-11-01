<?php
declare(strict_types=1);

namespace AdminUserManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\EventInterface;
use Cake\Datasource\EntityInterface;
use ArrayObject;
use Cake\ORM\TableRegistry;

/**
 * AdminUsers Model
 *
 * @property \AdminUserManager\Model\Table\ListingsTable&\Cake\ORM\Association\BelongsTo $Listings
 * @property \AdminUserManager\Model\Table\RolesTable&\Cake\ORM\Association\BelongsToMany $Roles
 *
 * @method \AdminUserManager\Model\Entity\AdminUser newEmptyEntity()
 * @method \AdminUserManager\Model\Entity\AdminUser newEntity(array $data, array $options = [])
 * @method \AdminUserManager\Model\Entity\AdminUser[] newEntities(array $data, array $options = [])
 * @method \AdminUserManager\Model\Entity\AdminUser get($primaryKey, $options = [])
 * @method \AdminUserManager\Model\Entity\AdminUser findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \AdminUserManager\Model\Entity\AdminUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminUserManager\Model\Entity\AdminUser[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \AdminUserManager\Model\Entity\AdminUser|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminUserManager\Model\Entity\AdminUser saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminUserManager\Model\Entity\AdminUser[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \AdminUserManager\Model\Entity\AdminUser[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \AdminUserManager\Model\Entity\AdminUser[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \AdminUserManager\Model\Entity\AdminUser[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AdminUsersTable extends Table
{

    public $_dir;

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
        $this->setTable('admin_users');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        //$this->addBehavior('Listable');

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
                'path' => $this->_dir.'{field-value:listing_id}{DS}{model}{DS}{field}{DS}',
                'keepFilesOnDelete' => false
            ],
        ]);

        $this->belongsTo('Listings', [
            'foreignKey' => 'listing_id',
            'joinType' => 'LEFT',
            'className' => 'AdminUserManager.Listings',
        ]);
        $this->belongsToMany('Roles', [
            'foreignKey' => 'admin_user_id',
            'targetForeignKey' => 'role_id',
            'joinTable' => 'admin_users_roles',
            'className' => 'AdminUserManager.Roles',
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 10)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 80)
            ->requirePresence('first_name', 'create')
            ->notEmptyString('first_name');

        $validator
            ->scalar('middle_name')
            ->maxLength('middle_name', 50)
            ->allowEmptyString('middle_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 100)
            ->requirePresence('last_name', 'create')
            ->notEmptyString('last_name');

        $validator
            ->notEmptyString('mobile', 'Mobile number is required')
            ->add('mobile', [
                'maxLength' => [
                    'rule' => ['maxLength', 14],
                    'message' => 'phone number is too long. The limit is 14 characters.'
                ],
                'minLength' => [
                    'rule' => ['minLength', 10],
                    'message' => 'Invalid phone number! phone number format: eg 10-14.'
                ],
                'custom' => [
                    'rule' => ['numeric'],
                    'on' => function($context) {
                    return !empty($context['data']['mobile']);
                },
                    'message' => 'Invalid phone number! phone number format: eg 10-14.'
                ]
        ]);

        $validator
            ->date('dob')
            ->requirePresence('dob', 'create')
            ->notEmptyDate('dob');

        // $validator
        //     ->email('email')
        //     ->requirePresence('email', 'create')
        //     ->notEmptyString('email')
        //     ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);


        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->add('email', [
                        'chkUnique' => [
                            'rule' => [$this, 'chkUnique'],
                            'message' => 'This Email already exists. please try to use another email.'
                ]]);



        $validator
            ->allowEmptyFile('profile_photo');

        $validator
            ->scalar('photo_dir')
            ->maxLength('photo_dir', 255)
            ->allowEmptyString('photo_dir');

        $validator
            ->integer('photo_size')
            ->allowEmptyString('photo_size');

        $validator
            ->scalar('photo_type')
            ->maxLength('photo_type', 255)
            ->allowEmptyString('photo_type');


        $validator
            ->boolean('is_supper_admin')
            ->allowEmptyString('is_supper_admin');

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        $validator
            ->boolean('is_verified')
            ->allowEmptyString('is_verified');

        $validator
            ->integer('login_count')
            ->allowEmptyString('login_count');

        return $validator;
    }

    /**
     * Resetpassword validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationResetpassword()
    {
        $obj = new \App\Model\Validation\PasswordValidator;
        return $obj->validations;
    }
    /**
     * password validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationPassword(Validator $validator) {
        $validatorObj = new \App\Model\Validation\PasswordValidator();
        $validator = $validatorObj->validations;
        $validator->add('old_password', 'custom', [ 'rule' => function($value, $context) {
                $user = $this->get($context['data']['id']);
                if ($user) {
                    if ((new \Cake\Auth\DefaultPasswordHasher)->check($value, $user->password)) {
                        return true;
                    }
                } return false;
            }, 'message' => 'The old password does not match the current password!']);

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
        //$rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(
                        ['email', 'listing_id'],
                        'This Email already exists. please try to use another email.'
                    ));
        $rules->add(function ($entity, $options) use($rules) {
            if (isset($entity->roles)) {
                $rule = $rules->validCount('roles', 1, '>=', 'You must have at least 1 role');
                return $rule($entity, $options);
            }
            return true;
        },'validCount');
        //$rules->add($rules->validCount('roles', 1, '>=', 'You must have at least 1 role'));

        return $rules;
    }


    public function chkUnique($value, $context) {
        if(empty(trim($value)))
            return true;
        if($context['newRecord'] != 1){
            $conditions['AdminUsers.id !='] = $context['data']['id'];
        }
        $conditions['email'] = $value;
        $conditions['listing_id'] = \Cake\Core\Configure::read('LISTING_ID');
        $chk = $this->find()->where($conditions)->count();
        if ($chk == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function beforeMarshal(\Cake\Event\Event $event, \ArrayObject $data)
    {
        if(\Cake\Core\Configure::read('LISTING_ID')){
            $data['listing_id'] = \Cake\Core\Configure::read('LISTING_ID');
        }
    }

    /**
     * This filters function is a 'finder' to use in the check status of user
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @param type $options Options Array
     * @return \Cake\ORM\Query
     */

    public function findActive(\Cake\ORM\Query $query, array $options)
    {
        return $query->where(['AdminUsers.status' => 1]);
    }

    /**
     * This filters function is a 'finder' to used for valid admin user according listing domain
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @param type $options Options Array
     * @return \Cake\ORM\Query
     */

    public function findSupperAuth(\Cake\ORM\Query $query, array $options)
    {
        //dd(\Cake\Core\Configure::read('Setting'));
        return $query->where(function ($exp, $q) use($options) {
                return $exp->or([
                        'AdminUsers.is_supper_admin' => 1,
                        'AdminUsers.listing_id' => \Cake\Core\Configure::read('LISTING_ID'),
                    ]);
            });
    }

    /**
     * This auth function is a 'finder' to use check auth requird data
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @param type $options Options Array
     * @return \Cake\ORM\Query
     */

    public function findAuth(\Cake\ORM\Query $query, array $options)
    {
        return $query->contain(['Listings' => function($q){
            return $q->select(['Listings.id', 'Listings.title', 'Listings.protocol', 'Listings.domain_name', 'Listings.listing_type_id']);
        }])
        ->contain(['Roles']);
    }

    /**
     * This pass function is a 'finder' to use check password is exist
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @param type $options Options Array
     * @return \Cake\ORM\Query
     */

    public function findPass(\Cake\ORM\Query $query, array $options)
    {
        return $query->where(['AdminUsers.password IS NOT' => null]);
    }

    /**
     * This filters function is a 'finder' to used for get roles according listing domain
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @param type $options Options Array
     * @return \Cake\ORM\Query
     */
    public function findDomain(Query $query, array $options)
    {
        return $query->where(['AdminUsers.listing_id' => \Cake\Core\Configure::read('LISTING_ID')]);
    }


     public function afterSave(EventInterface $event, EntityInterface $entity)
    {

        if ($entity->isNew() || ($entity->get('email') != $entity->getOriginal('email'))) {
                $uid = \Cake\Utility\Text::uuid();
                $data = $entity->toArray();
                $uinfo = $data;
                if($entity->get('listing_id')){
                    $uinfo['listing_id'] = $entity->get('listing_id');
                }else{
                    $uinfo['listing_id'] = \Cake\Core\Configure::read('LISTING_ID');
                }
                $uinfo['USER_NAME'] = $data['name'];
                $uinfo['USER_INFO'] = "";
                $uinfo['login_credential'] = ''; 
                $uinfo['verify_n_password'] = \Cake\Routing\Router::url(['controller' => 'AdminUsers', 'action' => 'createPassword','plugin'=>'AdminUserManager','prefix' => 'Admin',$uid], true);
                $user_type = "admin_users";
                $token_type = "create-password";
                $_usertoken = TableRegistry::getTableLocator()->get('UserTokens')->newEmptyEntity();
                $_usertoken->user_id = $entity->id;
                $_usertoken->user_type = $user_type;
                $_usertoken->token_type = $token_type;
                $_usertoken->token = $uid;
                TableRegistry::getTableLocator()->get('UserTokens')->save($_usertoken);
                //\EmailQueue\EmailQueue::enqueue([$entity->email], $uinfo, ['template'=>'welcome-email']);
                // $data = [
                //     'settings' => [
                //         'setTo' => $entity->get('email'),
                //     ],
                //     'hooks' => 'welcome-email',
                //     'hooksVars' => $uinfo,
                // ];
                $data = [
                    'settings' => [
                        'setTo' => $entity->get('email'), 
                    ],
                    'hooks' => 'welcome-email',
                    'hooksVars' => $uinfo,
                ];
                $queuedJobsTable = TableRegistry::getTableLocator()->get('Queue.QueuedJobs');
                unset($uinfo['base64img']);
                $queuedJobsTable->createJob('Email', $data, ['listing_id' => $uinfo['listing_id'], 'priority' => 1]);
         }

    }





}

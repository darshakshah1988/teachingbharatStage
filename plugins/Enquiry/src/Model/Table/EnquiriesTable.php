<?php
declare(strict_types=1);

namespace Enquiry\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Enquiries Model
 *
 * @property \Enquiry\Model\Table\ListingsTable&\Cake\ORM\Association\BelongsTo $Listings
 * @property \Enquiry\Model\Table\AdminUsersTable&\Cake\ORM\Association\BelongsTo $AdminUsers
 * @property \Enquiry\Model\Table\PriorityTypesTable&\Cake\ORM\Association\BelongsTo $PriorityTypes
 * @property \Enquiry\Model\Table\EnquiryStatusesTable&\Cake\ORM\Association\BelongsTo $EnquiryStatuses
 * @property \Enquiry\Model\Table\AssignedUsersTable&\Cake\ORM\Association\BelongsTo $AssignedUsers
 * @property \Enquiry\Model\Table\EnquiryCommentsTable&\Cake\ORM\Association\HasMany $EnquiryComments
 *
 * @method \Enquiry\Model\Entity\Enquiry newEmptyEntity()
 * @method \Enquiry\Model\Entity\Enquiry newEntity(array $data, array $options = [])
 * @method \Enquiry\Model\Entity\Enquiry[] newEntities(array $data, array $options = [])
 * @method \Enquiry\Model\Entity\Enquiry get($primaryKey, $options = [])
 * @method \Enquiry\Model\Entity\Enquiry findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Enquiry\Model\Entity\Enquiry patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Enquiry\Model\Entity\Enquiry[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Enquiry\Model\Entity\Enquiry|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Enquiry\Model\Entity\Enquiry saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Enquiry\Model\Entity\Enquiry[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Enquiry\Model\Entity\Enquiry[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Enquiry\Model\Entity\Enquiry[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Enquiry\Model\Entity\Enquiry[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EnquiriesTable extends Table
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

        $this->setTable('enquiries');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Listable');

        $this->belongsTo('Listings', [
            'foreignKey' => 'listing_id',
            'joinType' => 'INNER',
            'className' => 'Listings.Listings',
        ]);
        $this->belongsTo('AdminUsers', [
            'foreignKey' => 'admin_user_id',
            'className' => 'AdminUserManager.AdminUsers',
        ]);
        $this->belongsTo('PriorityTypes', [
            'foreignKey' => 'priority_type_id',
            'className' => 'Enquiry.PriorityTypes',
        ]);
        $this->belongsTo('EnquiryStatuses', [
            'foreignKey' => 'enquiry_status_id',
            'className' => 'Enquiry.EnquiryStatuses',
        ]);
        $this->belongsTo('AssignedUsers', [
            'foreignKey' => 'assigned_user_id',
            'className' => 'AdminUserManager.AdminUsers',
        ]);
        $this->hasMany('EnquiryComments', [
            'foreignKey' => 'enquiry_id',
            'className' => 'Enquiry.EnquiryComments',
        ]);

        $this->hasOne('LatestComment', [
            'foreignKey' => 'enquiry_id',
            'className' => 'Enquiry.EnquiryComments',
            //'strategy' => 'select',
            //'sort' => ['LatestComment.created' => 'ASC'],
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
            ->scalar('enquiry_type')
            ->maxLength('enquiry_type', 20)
            ->requirePresence('enquiry_type', 'create')
            ->allowEmptyString('enquiry_type');

        $validator
            ->scalar('referred_by')
            ->maxLength('referred_by', 200)
            ->allowEmptyString('referred_by');

        $validator
            ->scalar('subject')
            ->maxLength('subject', 250)
            ->requirePresence('subject', 'create')
            ->notEmptyString('subject');

        $validator
            ->scalar('full_name')
            ->maxLength('full_name', 250)
            ->allowEmptyString('full_name');

        $validator
            ->scalar('mobile')
            ->maxLength('mobile', 15)
            ->requirePresence('mobile', 'create')
            ->notEmptyString('mobile');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('address')
            ->maxLength('address', 255)
            ->allowEmptyString('address');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->date('end_date')
            ->allowEmptyDate('end_date');

        return $validator;
    }

    /**
     * Enquiry validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationEnquiry(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('subject')
            ->maxLength('subject', 250)
            ->requirePresence('subject', 'create')
            ->notEmptyString('subject');

        $validator
            ->scalar('full_name')
            ->maxLength('full_name', 250)
            ->notEmptyString('full_name');

        $validator
            ->scalar('mobile')
            ->maxLength('mobile', 15)
            ->requirePresence('mobile', 'create')
            ->notEmptyString('mobile');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');


        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        return $validator;
    }
    /**
     * To-Do validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationTodo(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('priority_type_id')
            ->requirePresence('priority_type_id', 'create')
            ->notEmptyString('priority_type_id');

        $validator
            ->integer('enquiry_status_id')
            ->requirePresence('enquiry_status_id', 'create')
            ->notEmptyString('enquiry_status_id');

        $validator
            ->integer('assigned_user_id')
            ->requirePresence('assigned_user_id', 'create')
            ->notEmptyString('assigned_user_id');

        $validator
            ->scalar('remark')
            ->maxLength('address', 1000)
            ->notEmptyString('remark');

        $validator
            ->date('end_date')
            ->notEmptyString('end_date');

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
        $rules->add($rules->existsIn(['listing_id'], 'Listings'));
        $rules->add($rules->existsIn(['admin_user_id'], 'AdminUsers'));
        $rules->add($rules->existsIn(['priority_type_id'], 'PriorityTypes'));
        $rules->add($rules->existsIn(['enquiry_status_id'], 'EnquiryStatuses'));
        $rules->add($rules->existsIn(['assigned_user_id'], 'AssignedUsers'));

        return $rules;
    }
}

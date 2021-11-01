<?php
declare(strict_types=1);

namespace Sessions\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SessionBookings Model
 *
 * @property \Sessions\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \Sessions\Model\Table\SubjectsTable&\Cake\ORM\Association\BelongsTo $Subjects
 * @property \Sessions\Model\Table\GradingTypesTable&\Cake\ORM\Association\BelongsTo $GradingTypes
 * @property \Sessions\Model\Table\BoardsTable&\Cake\ORM\Association\BelongsTo $Boards
 * @property \Sessions\Model\Table\TeacherSchedulesTable&\Cake\ORM\Association\BelongsTo $TeacherSchedules
 *
 * @method \Sessions\Model\Entity\SessionBooking newEmptyEntity()
 * @method \Sessions\Model\Entity\SessionBooking newEntity(array $data, array $options = [])
 * @method \Sessions\Model\Entity\SessionBooking[] newEntities(array $data, array $options = [])
 * @method \Sessions\Model\Entity\SessionBooking get($primaryKey, $options = [])
 * @method \Sessions\Model\Entity\SessionBooking findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Sessions\Model\Entity\SessionBooking patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Sessions\Model\Entity\SessionBooking[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Sessions\Model\Entity\SessionBooking|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Sessions\Model\Entity\SessionBooking saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Sessions\Model\Entity\SessionBooking[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Sessions\Model\Entity\SessionBooking[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Sessions\Model\Entity\SessionBooking[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Sessions\Model\Entity\SessionBooking[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SessionBookingsTable extends Table
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

        $this->setTable('session_bookings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'UserManager.Users',
        ]);
        $this->belongsTo('Teacher', [
            'foreignKey' => 'teacher_id',
            'joinType' => 'INNER',
            'className' => 'UserManager.Users',
        ]);
        $this->belongsTo('Subjects', [
            'foreignKey' => 'subject_id',
            'joinType' => 'INNER',
            'className' => 'Courses.Subjects',
        ]);
        $this->belongsTo('GradingTypes', [
            'foreignKey' => 'grading_type_id',
            'joinType' => 'INNER',
            'className' => 'Courses.GradingTypes',
        ]);
        $this->belongsTo('Boards', [
            'foreignKey' => 'board_id',
            'joinType' => 'INNER',
            'className' => 'Courses.Boards',
        ]);
        $this->belongsTo('TeacherSchedules', [
            'foreignKey' => 'teacher_schedule_id',
            'joinType' => 'INNER',
            'className' => 'UserManager.TeacherSchedules',
        ]);
		 $this->hasMany('Meetings', [
            'foreignKey' => 'session_booking_id',
            'joinType' => 'INNER',
            'className' => 'Sessions.Meetings',
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
            ->scalar('topic')
            ->maxLength('topic', 255)
            ->notEmptyString('topic', 'Session Topic is required field.');
    
        $validator
            ->datetime('start_date')
            ->notEmptyDate('start_date', 'Session Start Date is required field.');

        $validator
            ->datetime('end_date')
            ->notEmptyDate('end_date', 'Session End Date is required field.');

        
        $validator
            ->scalar('note')
            ->maxLength('note', 250, 'The comment may not be greater than 250 characters')
            ->allowEmptyString('note');

        $validator
            ->scalar('payment_method')
            ->maxLength('payment_method', 50)
            ->allowEmptyString('payment_method');

        $validator
            ->scalar('transaction_status')
            ->maxLength('transaction_status', 255)
            ->allowEmptyString('transaction_status');

        $validator
            ->scalar('transactionId')
            ->maxLength('transactionId', 255)
            ->allowEmptyString('transactionId');

        $validator
            ->scalar('signature')
            ->maxLength('signature', 255)
            ->allowEmptyString('signature');

        $validator
            ->scalar('transaction_responce')
            ->maxLength('transaction_responce', 255)
            ->allowEmptyString('transaction_responce');

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
        $rules->add($rules->existsIn(['subject_id'], 'Subjects'), ['errorField' => 'subject_id']);
        $rules->add($rules->existsIn(['grading_type_id'], 'GradingTypes'), ['errorField' => 'grading_type_id']);
        $rules->add($rules->existsIn(['board_id'], 'Boards'), ['errorField' => 'board_id']);
        $rules->add($rules->existsIn(['teacher_schedule_id'], 'TeacherSchedules'), ['errorField' => 'teacher_schedule_id']);

        return $rules;
    }


     /*
     * Finder Confirmed
     * get listing id according to domain url
     */
    public function findConfirmed(Query $query, array $options)
    {
        
        $query->where(['SessionBookings.session_status' => 1]);

        return $query;
    }

     /*
     * Finder Confirmed
     * get listing id according to domain url
     */
    public function findPending(Query $query, array $options)
    {
        
       return $query->where(function ($exp, $q) {
                return $exp->or_([
                        'SessionBookings.session_status IS' => null,
                        'SessionBookings.session_status' => 0,
                ]);
            });

    }

    /*
     * Finder Upcoming
     * get listing id according to domain url
     */
    public function findUpcoming(Query $query, array $options)
    {
        
        $query->where(['SessionBookings.booking_date >=' => date('Y-m-d H:i:s'), 'SessionBookings.session_status' => 1]);

        // $query->matching('TeacherSchedules', function($q){
        //     return $q->where(['DATE_ADD(NOW(),TeacherSchedules.start_at) >=' => '2021-01-30 07:02:07']);
        // });

        // $query->contain(['TeacherSchedules' => function($q){
        //             return $q->where(['DATE(TeacherSchedules.start_at)' => '2021-01-30 10:02:07']);
        //         }]);

        return $query;
    }
}

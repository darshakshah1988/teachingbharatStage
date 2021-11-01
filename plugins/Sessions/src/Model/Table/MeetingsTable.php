<?php
declare(strict_types=1);

namespace Sessions\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ZoomMeetings Model
 *
 * @property \Sessions\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \Sessions\Model\Table\SubjectsTable&\Cake\ORM\Association\BelongsTo $Subjects
 * @property \Sessions\Model\Table\GradingTypesTable&\Cake\ORM\Association\BelongsTo $GradingTypes
 * @property \Sessions\Model\Table\BoardsTable&\Cake\ORM\Association\BelongsTo $Boards
 * @property \Sessions\Model\Table\TeacherSchedulesTable&\Cake\ORM\Association\BelongsTo $TeacherSchedules
 *
 * @method \Sessions\Model\Entity\ZoomMeeting newEmptyEntity()
 * @method \Sessions\Model\Entity\ZoomMeeting newEntity(array $data, array $options = [])
 * @method \Sessions\Model\Entity\ZoomMeeting[] newEntities(array $data, array $options = [])
 * @method \Sessions\Model\Entity\ZoomMeeting get($primaryKey, $options = [])
 * @method \Sessions\Model\Entity\ZoomMeeting findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Sessions\Model\Entity\ZoomMeeting patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Sessions\Model\Entity\ZoomMeeting[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Sessions\Model\Entity\ZoomMeeting|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Sessions\Model\Entity\ZoomMeeting saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Sessions\Model\Entity\ZoomMeeting[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Sessions\Model\Entity\ZoomMeeting[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Sessions\Model\Entity\ZoomMeeting[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Sessions\Model\Entity\ZoomMeeting[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MeetingsTable extends Table
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

        $this->setTable('zoom_meetings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'UserManager.Users',
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


     /*
     * Finder Confirmed
     * get listing id according to domain url
     */
    public function findConfirmed(Query $query, array $options)
    {
        $query->where(['Meetings.status' => 'confirm']);

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
                        'Meetings.status IS' => null,
                        'Meetings.status' => 0,
                ]);
            });

    }

    /*
     * Finder Upcoming
     * get listing id according to domain url
     */
    public function findUpcoming(Query $query, array $options)
    {
        $query->where(['Meetings.start_time >=' => date('Y-m-d H:i:s'), 'Meetings.status' => 1]);

        return $query;
    }
}

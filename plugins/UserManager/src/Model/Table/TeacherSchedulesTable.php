<?php
declare(strict_types=1);

namespace UserManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TeacherSchedules Model
 *
 * @property \UserManager\Model\Table\UsersTable&\Cake\ORM\Association\BelongsToMany $Users
 *
 * @method \UserManager\Model\Entity\TeacherSchedule newEmptyEntity()
 * @method \UserManager\Model\Entity\TeacherSchedule newEntity(array $data, array $options = [])
 * @method \UserManager\Model\Entity\TeacherSchedule[] newEntities(array $data, array $options = [])
 * @method \UserManager\Model\Entity\TeacherSchedule get($primaryKey, $options = [])
 * @method \UserManager\Model\Entity\TeacherSchedule findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \UserManager\Model\Entity\TeacherSchedule patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \UserManager\Model\Entity\TeacherSchedule[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \UserManager\Model\Entity\TeacherSchedule|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \UserManager\Model\Entity\TeacherSchedule saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \UserManager\Model\Entity\TeacherSchedule[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \UserManager\Model\Entity\TeacherSchedule[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \UserManager\Model\Entity\TeacherSchedule[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \UserManager\Model\Entity\TeacherSchedule[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TeacherSchedulesTable extends Table
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

        $this->setTable('teacher_schedules');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Users', [
            'foreignKey' => 'teacher_schedule_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'users_teacher_schedules',
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

        $validator
            ->scalar('title')
            ->maxLength('title', 100)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->time('start_at')
            ->requirePresence('start_at', 'create')
            ->notEmptyTime('start_at');

        $validator
            ->time('end_at')
            ->requirePresence('end_at', 'create')
            ->notEmptyTime('end_at');

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        return $validator;
    }
}

<?php
declare(strict_types=1);

namespace Courses\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CourseWatchings Model
 *
 * @property \Courses\Model\Table\CoursesTable&\Cake\ORM\Association\BelongsTo $Courses
 * @property \Courses\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \Courses\Model\Entity\CourseWatching newEmptyEntity()
 * @method \Courses\Model\Entity\CourseWatching newEntity(array $data, array $options = [])
 * @method \Courses\Model\Entity\CourseWatching[] newEntities(array $data, array $options = [])
 * @method \Courses\Model\Entity\CourseWatching get($primaryKey, $options = [])
 * @method \Courses\Model\Entity\CourseWatching findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Courses\Model\Entity\CourseWatching patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Courses\Model\Entity\CourseWatching[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Courses\Model\Entity\CourseWatching|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Courses\Model\Entity\CourseWatching saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Courses\Model\Entity\CourseWatching[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Courses\Model\Entity\CourseWatching[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Courses\Model\Entity\CourseWatching[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Courses\Model\Entity\CourseWatching[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CourseWatchingsTable extends Table
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

        $this->setTable('course_watchings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Courses', [
            'foreignKey' => 'course_id',
            'joinType' => 'INNER',
            'className' => 'Courses.Courses',
        ]);
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

        $validator
            ->integer('views')
            ->allowEmptyString('views');

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
        $rules->add($rules->existsIn(['course_id'], 'Courses'), ['errorField' => 'course_id']);
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}

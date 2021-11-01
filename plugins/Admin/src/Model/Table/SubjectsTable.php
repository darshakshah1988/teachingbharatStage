<?php
declare(strict_types=1);

namespace Admin\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Subjects Model
 *
 * @property \Admin\Model\Table\CoursesTable&\Cake\ORM\Association\BelongsTo $Courses
 * @property \Admin\Model\Table\SubjectsTeachersTable&\Cake\ORM\Association\HasMany $SubjectsTeachers
 *
 * @method \Admin\Model\Entity\Subject newEmptyEntity()
 * @method \Admin\Model\Entity\Subject newEntity(array $data, array $options = [])
 * @method \Admin\Model\Entity\Subject[] newEntities(array $data, array $options = [])
 * @method \Admin\Model\Entity\Subject get($primaryKey, $options = [])
 * @method \Admin\Model\Entity\Subject findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Admin\Model\Entity\Subject patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Admin\Model\Entity\Subject[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Admin\Model\Entity\Subject|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Admin\Model\Entity\Subject saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Admin\Model\Entity\Subject[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Admin\Model\Entity\Subject[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Admin\Model\Entity\Subject[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Admin\Model\Entity\Subject[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SubjectsTable extends Table
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

        $this->setTable('subjects');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Courses', [
            'foreignKey' => 'course_id',
            'joinType' => 'INNER',
            'className' => 'Admin.Courses',
        ]);
        $this->hasMany('SubjectsTeachers', [
            'foreignKey' => 'subject_id',
            'className' => 'Admin.SubjectsTeachers',
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
            ->maxLength('title', 20)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->integer('max_weekly_classes')
            ->requirePresence('max_weekly_classes', 'create')
            ->notEmptyString('max_weekly_classes');

        $validator
            ->integer('credit_hours')
            ->requirePresence('credit_hours', 'create')
            ->notEmptyString('credit_hours');

        $validator
            ->boolean('is_activity')
            ->requirePresence('is_activity', 'create')
            ->notEmptyString('is_activity');

        $validator
            ->boolean('is_exam')
            ->requirePresence('is_exam', 'create')
            ->notEmptyString('is_exam');

        $validator
            ->integer('position')
            ->requirePresence('position', 'create')
            ->notEmptyString('position');

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
        $rules->add($rules->existsIn(['course_id'], 'Courses'));

        return $rules;
    }
}

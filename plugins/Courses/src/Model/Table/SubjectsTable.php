<?php
declare(strict_types=1);

namespace Courses\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Subjects Model
 *
 * @property \Courses\Model\Table\CoursesTable&\Cake\ORM\Association\BelongsTo $Courses
 * @property \Courses\Model\Table\SubjectsTeachersTable&\Cake\ORM\Association\HasMany $SubjectsTeachers
 *
 * @method \Courses\Model\Entity\Subject newEmptyEntity()
 * @method \Courses\Model\Entity\Subject newEntity(array $data, array $options = [])
 * @method \Courses\Model\Entity\Subject[] newEntities(array $data, array $options = [])
 * @method \Courses\Model\Entity\Subject get($primaryKey, $options = [])
 * @method \Courses\Model\Entity\Subject findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Courses\Model\Entity\Subject patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Courses\Model\Entity\Subject[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Courses\Model\Entity\Subject|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Courses\Model\Entity\Subject saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Courses\Model\Entity\Subject[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Courses\Model\Entity\Subject[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Courses\Model\Entity\Subject[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Courses\Model\Entity\Subject[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
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

        // $this->belongsTo('Courses', [
        //     'foreignKey' => 'course_id',
        //     'joinType' => 'LEFT',
        //     'className' => 'Courses.Courses',
        // ]);
        $this->hasMany('SubjectsTeachers', [
            'foreignKey' => 'subject_id',
            'className' => 'Courses.SubjectsTeachers',
        ]);
        $this->addBehavior('ADmad/Sequence.Sequence', [
            'startAt' => 1, // Initial value for sequence. Default 1.
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
            ->maxLength('title', 200)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->integer('max_weekly_classes')
            ->allowEmptyString('max_weekly_classes');

        $validator
            ->integer('credit_hours')
            ->allowEmptyString('credit_hours');

        $validator
            ->boolean('is_activity')
            ->allowEmptyString('is_activity');

        $validator
            ->boolean('is_exam')
            ->allowEmptyString('is_exam');

        $validator
            ->integer('position')
            ->requirePresence('position', 'create')
            ->notEmptyString('position');

        return $validator;
    }

    
}

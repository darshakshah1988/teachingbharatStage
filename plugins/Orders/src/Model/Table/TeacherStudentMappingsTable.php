<?php
declare(strict_types=1);

namespace Orders\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TeacherStudentMappings Model
 *
 * @property \Orders\Model\Table\StudentsTable&\Cake\ORM\Association\BelongsTo $Students
 * @property \Orders\Model\Table\PackagesTable&\Cake\ORM\Association\BelongsTo $Packages
 * @property \Orders\Model\Table\SubjectsTable&\Cake\ORM\Association\BelongsTo $Subjects
 * @property \Orders\Model\Table\MicroSessionsTable&\Cake\ORM\Association\BelongsTo $MicroSessions
 * @property \Orders\Model\Table\TeachersTable&\Cake\ORM\Association\BelongsTo $Teachers
 *
 * @method \Orders\Model\Entity\TeacherStudentMapping newEmptyEntity()
 * @method \Orders\Model\Entity\TeacherStudentMapping newEntity(array $data, array $options = [])
 * @method \Orders\Model\Entity\TeacherStudentMapping[] newEntities(array $data, array $options = [])
 * @method \Orders\Model\Entity\TeacherStudentMapping get($primaryKey, $options = [])
 * @method \Orders\Model\Entity\TeacherStudentMapping findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Orders\Model\Entity\TeacherStudentMapping patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Orders\Model\Entity\TeacherStudentMapping[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Orders\Model\Entity\TeacherStudentMapping|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Orders\Model\Entity\TeacherStudentMapping saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Orders\Model\Entity\TeacherStudentMapping[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Orders\Model\Entity\TeacherStudentMapping[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Orders\Model\Entity\TeacherStudentMapping[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Orders\Model\Entity\TeacherStudentMapping[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TeacherStudentMappingsTable extends Table
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

        $this->setTable('teacher_student_mappings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER',
            'className' => 'Orders.Students',
        ]);
        $this->belongsTo('Packages', [
            'foreignKey' => 'package_id',
            'joinType' => 'INNER',
            'className' => 'Orders.Packages',
        ]);
        $this->belongsTo('Subjects', [
            'foreignKey' => 'subject_id',
            'joinType' => 'INNER',
            'className' => 'Orders.Subjects',
        ]);
        $this->belongsTo('MicroSessions', [
            'foreignKey' => 'micro_session_id',
            'joinType' => 'INNER',
            'className' => 'Orders.MicroSessions',
        ]);
        $this->belongsTo('Teachers', [
            'foreignKey' => 'teacher_id',
            'joinType' => 'INNER',
            'className' => 'Orders.Teachers',
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
        $rules->add($rules->existsIn(['student_id'], 'Students'), ['errorField' => 'student_id']);
        $rules->add($rules->existsIn(['package_id'], 'Packages'), ['errorField' => 'package_id']);
        $rules->add($rules->existsIn(['subject_id'], 'Subjects'), ['errorField' => 'subject_id']);
        $rules->add($rules->existsIn(['micro_session_id'], 'MicroSessions'), ['errorField' => 'micro_session_id']);
        $rules->add($rules->existsIn(['teacher_id'], 'Teachers'), ['errorField' => 'teacher_id']);

        return $rules;
    }
}

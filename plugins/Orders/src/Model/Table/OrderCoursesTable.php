<?php
declare(strict_types=1);

namespace Orders\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderCourses Model
 *
 * @property \Orders\Model\Table\OrdersTable&\Cake\ORM\Association\BelongsTo $Orders
 * @property \Orders\Model\Table\CoursesTable&\Cake\ORM\Association\BelongsTo $Courses
 *
 * @method \Orders\Model\Entity\OrderCourse newEmptyEntity()
 * @method \Orders\Model\Entity\OrderCourse newEntity(array $data, array $options = [])
 * @method \Orders\Model\Entity\OrderCourse[] newEntities(array $data, array $options = [])
 * @method \Orders\Model\Entity\OrderCourse get($primaryKey, $options = [])
 * @method \Orders\Model\Entity\OrderCourse findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Orders\Model\Entity\OrderCourse patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Orders\Model\Entity\OrderCourse[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Orders\Model\Entity\OrderCourse|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Orders\Model\Entity\OrderCourse saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Orders\Model\Entity\OrderCourse[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Orders\Model\Entity\OrderCourse[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Orders\Model\Entity\OrderCourse[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Orders\Model\Entity\OrderCourse[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrderCoursesTable extends Table
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

        $this->setTable('order_courses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Orders', [
            'foreignKey' => 'order_id',
            'joinType' => 'INNER',
            'className' => 'Orders.Orders',
        ]);
        $this->belongsTo('Courses', [
            'foreignKey' => 'course_id',
            'joinType' => 'LEFT',
            'className' => 'Courses.Courses',
        ]);
        $this->belongsTo('MicroSessions', [
            'foreignKey' => 'micro_session_id',
            'joinType' => 'LEFT',
            'className' => 'MicroSessions.MicroSessions',
        ]);
        $this->belongsTo('Packages', [
            'foreignKey' => 'package_id',
            'joinType' => 'LEFT',
            'className' => 'Packages.Packages',
        ]);
        $this->belongsTo('Plans', [
            'foreignKey' => 'plan_id',
            'joinType' => 'LEFT',
            'className' => 'Packages.Plans',
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
            ->decimal('amount')
            ->allowEmptyString('amount');

        $validator
            ->decimal('discount')
            ->allowEmptyString('discount');

        $validator
            ->decimal('total_amount')
            ->allowEmptyString('total_amount');

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
        $rules->add($rules->existsIn(['order_id'], 'Orders'), ['errorField' => 'order_id']);
        $rules->add($rules->existsIn(['course_id'], 'Courses'), ['errorField' => 'course_id']);
        $rules->add($rules->existsIn(['micro_session_id'], 'MicroSessions'), ['errorField' => 'micro_session_id']);


        return $rules;
    }
}

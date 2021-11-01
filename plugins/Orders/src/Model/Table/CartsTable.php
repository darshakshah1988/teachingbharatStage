<?php
declare(strict_types=1);

namespace Orders\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Carts Model
 *
 * @property \Orders\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \Orders\Model\Table\CoursesTable&\Cake\ORM\Association\BelongsTo $Courses
 *
 * @method \Orders\Model\Entity\Cart newEmptyEntity()
 * @method \Orders\Model\Entity\Cart newEntity(array $data, array $options = [])
 * @method \Orders\Model\Entity\Cart[] newEntities(array $data, array $options = [])
 * @method \Orders\Model\Entity\Cart get($primaryKey, $options = [])
 * @method \Orders\Model\Entity\Cart findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Orders\Model\Entity\Cart patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Orders\Model\Entity\Cart[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Orders\Model\Entity\Cart|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Orders\Model\Entity\Cart saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Orders\Model\Entity\Cart[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Orders\Model\Entity\Cart[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Orders\Model\Entity\Cart[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Orders\Model\Entity\Cart[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CartsTable extends Table
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

        $this->setTable('carts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'UserManager.Users',
        ]);
        $this->belongsTo('Courses', [
            'foreignKey' => 'course_id',
            'joinType' => 'INNER',
            'className' => 'Courses.Courses',
        ]);
        $this->belongsTo('MicroSessions', [
            'foreignKey' => 'micro_session_id',
            'joinType' => 'INNER',
            'className' => 'MicroSessions.MicroSessions',
        ]);
        $this->belongsTo('Packages', [
            'foreignKey' => 'package_id',
            'joinType' => 'INNER',
            'className' => 'Packages.Packages',
        ]);
        $this->belongsTo('Plans', [
            'foreignKey' => 'plan_id',
            'joinType' => 'INNER',
            'className' => 'Plans.Plans',
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
            ->scalar('sessionId')
            ->maxLength('sessionId', 255)
            ->allowEmptyString('sessionId');

        $validator
            ->requirePresence('quantity', 'create')
            ->notEmptyString('quantity');

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
        $rules->add($rules->existsIn(['course_id'], 'Courses'), ['errorField' => 'course_id']);

        return $rules;
    }

    /**
     * This filters function is a 'MyCart' to used for get cart record by user
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @param type $options Options Array
     * @return \Cake\ORM\Query
     */
    public function findMyCart(Query $query, array $options)
    {
        return $query->where(['Carts.user_id' => $options['user_id']]);
    }
}

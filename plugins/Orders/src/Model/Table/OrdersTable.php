<?php
declare(strict_types=1);

namespace Orders\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Orders Model
 *
 * @property \Orders\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \Orders\Model\Table\OrderCoursesTable&\Cake\ORM\Association\HasMany $OrderCourses
 * @property \Orders\Model\Table\PhinxlogTable&\Cake\ORM\Association\BelongsToMany $Phinxlog
 *
 * @method \Orders\Model\Entity\Order newEmptyEntity()
 * @method \Orders\Model\Entity\Order newEntity(array $data, array $options = [])
 * @method \Orders\Model\Entity\Order[] newEntities(array $data, array $options = [])
 * @method \Orders\Model\Entity\Order get($primaryKey, $options = [])
 * @method \Orders\Model\Entity\Order findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Orders\Model\Entity\Order patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Orders\Model\Entity\Order[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Orders\Model\Entity\Order|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Orders\Model\Entity\Order saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Orders\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Orders\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Orders\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Orders\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrdersTable extends Table
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

        $this->setTable('orders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'UserManager.Users',
        ]);
        $this->hasMany('OrderCourses', [
            'foreignKey' => 'order_id',
            'className' => 'Orders.OrderCourses',
        ]);
         $this->hasMany('MicroSessions', [
            'foreignKey' => 'id',
            'className' => 'MicroSessions.MicroSessions',
        ]);

          $this->hasMany('Packages', [
            'foreignKey' => 'id',
            'className' => 'Orders.Packages',
        ]);

        $this->hasMany('OrderCoupons', [
            'foreignKey' => 'order_id',
            'className' => 'Orders.OrderCoupons',
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
            ->scalar('invoice_no')
            ->maxLength('invoice_no', 150)
            ->allowEmptyString('invoice_no');

        $validator
            ->decimal('amount')
            ->allowEmptyString('amount');

        $validator
            ->decimal('discount')
            ->allowEmptyString('discount');

        $validator
            ->decimal('total_amount')
            ->allowEmptyString('total_amount');

        $validator
            ->dateTime('order_date')
            ->allowEmptyDateTime('order_date');

        $validator
            ->scalar('razorpay_order')
            ->maxLength('razorpay_order', 255)
            ->allowEmptyString('razorpay_order');

        $validator
            ->scalar('note')
            ->allowEmptyString('note');

        $validator
            ->scalar('invoice_file')
            ->maxLength('invoice_file', 255)
            ->allowEmptyFile('invoice_file');

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
}

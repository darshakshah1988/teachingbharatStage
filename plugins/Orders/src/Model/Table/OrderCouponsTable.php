<?php
declare(strict_types=1);

namespace Orders\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderCoupons Model
 *
 * @property \Orders\Model\Table\OrdersTable&\Cake\ORM\Association\BelongsTo $Orders
 * @property \Orders\Model\Table\CouponsTable&\Cake\ORM\Association\BelongsTo $Coupons
 * @property \Orders\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \Orders\Model\Entity\OrderCoupon newEmptyEntity()
 * @method \Orders\Model\Entity\OrderCoupon newEntity(array $data, array $options = [])
 * @method \Orders\Model\Entity\OrderCoupon[] newEntities(array $data, array $options = [])
 * @method \Orders\Model\Entity\OrderCoupon get($primaryKey, $options = [])
 * @method \Orders\Model\Entity\OrderCoupon findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Orders\Model\Entity\OrderCoupon patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Orders\Model\Entity\OrderCoupon[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Orders\Model\Entity\OrderCoupon|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Orders\Model\Entity\OrderCoupon saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Orders\Model\Entity\OrderCoupon[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Orders\Model\Entity\OrderCoupon[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Orders\Model\Entity\OrderCoupon[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Orders\Model\Entity\OrderCoupon[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrderCouponsTable extends Table
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

        $this->setTable('order_coupons');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Orders', [
            'foreignKey' => 'order_id',
            'joinType' => 'INNER',
            'className' => 'Orders.Orders',
        ]);
        $this->belongsTo('Coupons', [
            'foreignKey' => 'coupon_id',
            'joinType' => 'INNER',
            'className' => 'Orders.Coupons',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Orders.Users',
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
        $rules->add($rules->existsIn(['coupon_id'], 'Coupons'), ['errorField' => 'coupon_id']);
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}

<?php
declare(strict_types=1);

namespace Promotions\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Coupons Model
 *
 * @method \Promotions\Model\Entity\Coupon newEmptyEntity()
 * @method \Promotions\Model\Entity\Coupon newEntity(array $data, array $options = [])
 * @method \Promotions\Model\Entity\Coupon[] newEntities(array $data, array $options = [])
 * @method \Promotions\Model\Entity\Coupon get($primaryKey, $options = [])
 * @method \Promotions\Model\Entity\Coupon findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Promotions\Model\Entity\Coupon patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Promotions\Model\Entity\Coupon[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Promotions\Model\Entity\Coupon|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Promotions\Model\Entity\Coupon saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Promotions\Model\Entity\Coupon[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Promotions\Model\Entity\Coupon[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Promotions\Model\Entity\Coupon[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Promotions\Model\Entity\Coupon[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CouponsTable extends Table
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

        $this->setTable('coupons');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('OrderCoupons', [
            'foreignKey' => 'coupon_id',
            'dependent' => true,
            'cascadeCallbacks' => true
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
            ->scalar('name')
            ->maxLength('name', 250)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('code')
            ->maxLength('code', 250)
            ->requirePresence('code', 'create')
            ->notEmptyString('code');

        $validator
            ->scalar('coupon_type')
            ->maxLength('coupon_type', 25)
            ->requirePresence('coupon_type', 'create')
            ->notEmptyString('coupon_type');

        $validator
            ->decimal('discount')
            ->requirePresence('discount', 'create')
            ->notEmptyString('discount');

        $validator
            ->decimal('total')
            ->allowEmptyString('total');

        $validator
            ->date('date_start')
            ->notEmptyDate('date_start');

        $validator
            ->date('date_end')
            ->notEmptyDate('date_end');

        $validator
            ->integer('uses_total')
            ->allowEmptyString('uses_total');

        $validator
            ->integer('uses_customer')
            ->allowEmptyString('uses_customer');

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        return $validator;
    }


    public function findActive(\Cake\ORM\Query $query, array $options) {
            $query->where(function ($exp) {
                    $orConditions = $exp->or_(['Coupons.date_start IS' => NULL, 'Coupons.date_start <=' => date('Y-m-d')]);
                    $orConditions2 = $exp->or_(['Coupons.date_end IS' => NULL, 'Coupons.date_end >=' => date('Y-m-d')]);
                        return $exp
                            ->add($orConditions)
                            ->add($orConditions2);
                 });
                 if(isset($options['code'])){
                    $query->where(['Coupons.code' => $options['code']]);
                 }
            return $query->where(['Coupons.status'=>1]);
       }

    public function getCoupon($couponData){
        $status = true;
        $coupQuery = $this->find()->find('active',$couponData)->first();
        if(!empty($coupQuery)){
            $total_used = $this->OrderCoupons->find()->where(['OrderCoupons.coupon_id' => $coupQuery->id])->count();
            
            if($coupQuery->uses_total > 0 && ($total_used >= $coupQuery->uses_total)){
                $status = false;
            }
            
            if($couponData['user_id']){
                $total_used = $this->OrderCoupons->find()->where(['OrderCoupons.coupon_id' => $coupQuery->id, 'OrderCoupons.user_id' => $couponData['user_id']])->count();
                if($coupQuery->per_user_usage > 0 && ($total_used >= $coupQuery->uses_total)){
                    $status = false;
                }
            }
        }else{
            $status = false;
        }
        if($status){
            return $coupQuery->toArray(); 
        }
        
       }
}

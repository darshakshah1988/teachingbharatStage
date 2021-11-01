<?php
declare(strict_types=1);

namespace Transactions\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Transactions Model
 *
 * @property \Transactions\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \Transactions\Model\Table\PhinxlogTable&\Cake\ORM\Association\BelongsToMany $Phinxlog
 *
 * @method \Transactions\Model\Entity\Transaction newEmptyEntity()
 * @method \Transactions\Model\Entity\Transaction newEntity(array $data, array $options = [])
 * @method \Transactions\Model\Entity\Transaction[] newEntities(array $data, array $options = [])
 * @method \Transactions\Model\Entity\Transaction get($primaryKey, $options = [])
 * @method \Transactions\Model\Entity\Transaction findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Transactions\Model\Entity\Transaction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Transactions\Model\Entity\Transaction[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Transactions\Model\Entity\Transaction|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Transactions\Model\Entity\Transaction saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Transactions\Model\Entity\Transaction[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Transactions\Model\Entity\Transaction[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Transactions\Model\Entity\Transaction[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Transactions\Model\Entity\Transaction[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TransactionsTable extends Table
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

        $this->setTable('transactions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

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
            ->scalar('payment_method')
            ->maxLength('payment_method', 50)
            ->requirePresence('payment_method', 'create')
            ->notEmptyString('payment_method');

        $validator
            ->scalar('transaction_type')
            ->maxLength('transaction_type', 255)
            ->requirePresence('transaction_type', 'create')
            ->notEmptyString('transaction_type');

        $validator
            ->scalar('transaction_status')
            ->maxLength('transaction_status', 255)
            ->requirePresence('transaction_status', 'create')
            ->notEmptyString('transaction_status');

        $validator
            ->decimal('amount')
            ->allowEmptyString('amount');

        $validator
            ->scalar('transactionId')
            ->maxLength('transactionId', 150)
            ->allowEmptyString('transactionId');

        $validator
            ->scalar('transaction_responce')
            ->allowEmptyString('transaction_responce');

        $validator
            ->scalar('note')
            ->allowEmptyString('note');

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


    public function availableFund($user_id = null){
        $query = $this->find();
        $query->where(['Transactions.transaction_status' => 1]);
        if($user_id){
            $query->where(['Transactions.user_id' => $user_id]);
        }
        $query->select(['total_amount' => $query->func()->sum('Transactions.amount'), 'Transactions.transaction_type']);
        $query->group('Transactions.transaction_type');
        $transections = $query->all();
        $diposit = 0;
        $withdraw = 0;
        foreach($transections as $transection){
            if($transection->transaction_type == 1){
                $diposit += $transection->total_amount;
            }else{
                $withdraw += $transection->total_amount;
            }
        }
        $availableCredits = $diposit - $withdraw;
        return $availableCredits > 0 ? $availableCredits : 0;
    }

    public function WithDrawAllAndDeposit($user_id, $deposit){

        $this->updateAll(
            [  // fields
                'transaction_type' => 2,
            ],
            [  // conditions
                'transaction_type' => 1,
                'user_id' => $user_id
            ]
        );
        $transection = $this->newEmptyEntity();
        $transection->user_id = $user_id;
        $transection->payment_method = 'referral';
        $transection->transaction_type = 1;
        $transection->transaction_status = 1;
        $transection->amount = $deposit;
        $transection->note = 'rest amount deposit';
        $this->save($transection);

    }

}

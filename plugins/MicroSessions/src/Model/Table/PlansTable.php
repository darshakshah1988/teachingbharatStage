<?php
declare(strict_types=1);

namespace MicroSessions\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Plans Model
 *
 * @property \MicroSessions\Model\Table\PlansTable&\Cake\ORM\Association\BelongsTo $Plans
 * @property \MicroSessions\Model\Table\ListingsTable&\Cake\ORM\Association\BelongsTo $Listings
 * @property \MicroSessions\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \MicroSessions\Model\Table\PlansTable&\Cake\ORM\Association\HasMany $Plans
 *
 * @method \MicroSessions\Model\Entity\Plan newEmptyEntity()
 * @method \MicroSessions\Model\Entity\Plan newEntity(array $data, array $options = [])
 * @method \MicroSessions\Model\Entity\Plan[] newEntities(array $data, array $options = [])
 * @method \MicroSessions\Model\Entity\Plan get($primaryKey, $options = [])
 * @method \MicroSessions\Model\Entity\Plan findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \MicroSessions\Model\Entity\Plan patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \MicroSessions\Model\Entity\Plan[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \MicroSessions\Model\Entity\Plan|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MicroSessions\Model\Entity\Plan saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MicroSessions\Model\Entity\Plan[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \MicroSessions\Model\Entity\Plan[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \MicroSessions\Model\Entity\Plan[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \MicroSessions\Model\Entity\Plan[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PlansTable extends Table
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

        $this->setTable('plans');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Plans', [
            'foreignKey' => 'plan_id',
            'joinType' => 'INNER',
            'className' => 'MicroSessions.Plans',
        ]);
        $this->belongsTo('Listings', [
            'foreignKey' => 'listing_id',
            'joinType' => 'INNER',
            'className' => 'MicroSessions.Listings',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'MicroSessions.Users',
        ]);
        $this->hasMany('Plans', [
            'foreignKey' => 'plan_id',
            'className' => 'MicroSessions.Plans',
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
            ->scalar('plan_name')
            ->maxLength('plan_name', 256)
            ->requirePresence('plan_name', 'create')
            ->notEmptyString('plan_name');

		$validator
            ->integer('price')
            ->notEmptyString('price');
		$validator
            ->integer('discount_price')
            ->notEmptyString('discount_price');

        $validator
            ->integer('duration')
            ->maxLength('duration', 255)
            ->notEmptyString('duration');
       

        // $validator
        //     ->scalar('features')
        //     ->maxLength('features', 400)
        //     ->allowEmptyString('features');

        $validator
            ->scalar('other_details')
            ->allowEmptyString('other_details');       

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

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
       // $rules->add($rules->existsIn(['plan_id'], 'Plans'), ['errorField' => 'plan_id']);
        $rules->add($rules->existsIn(['listing_id'], 'Listings'), ['errorField' => 'listing_id']);
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}

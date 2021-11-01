<?php
declare(strict_types=1);

namespace Enquiry\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PriorityTypes Model
 *
 * @property \Enquiry\Model\Table\ListingsTable&\Cake\ORM\Association\BelongsTo $Listings
 * @property \Enquiry\Model\Table\EnquiriesTable&\Cake\ORM\Association\HasMany $Enquiries
 *
 * @method \Enquiry\Model\Entity\PriorityType newEmptyEntity()
 * @method \Enquiry\Model\Entity\PriorityType newEntity(array $data, array $options = [])
 * @method \Enquiry\Model\Entity\PriorityType[] newEntities(array $data, array $options = [])
 * @method \Enquiry\Model\Entity\PriorityType get($primaryKey, $options = [])
 * @method \Enquiry\Model\Entity\PriorityType findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Enquiry\Model\Entity\PriorityType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Enquiry\Model\Entity\PriorityType[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Enquiry\Model\Entity\PriorityType|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Enquiry\Model\Entity\PriorityType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Enquiry\Model\Entity\PriorityType[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Enquiry\Model\Entity\PriorityType[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Enquiry\Model\Entity\PriorityType[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Enquiry\Model\Entity\PriorityType[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PriorityTypesTable extends Table
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

        $this->setTable('priority_types');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Listable');

        // $this->addBehavior('ADmad/Sequence.Sequence', [
        //     'startAt' => 1, // Initial value for sequence. Default 1.
        //     'scope' => ['listing_id']
        // ]);

        $this->belongsTo('Listings', [
            'foreignKey' => 'listing_id',
            'joinType' => 'INNER',
            'className' => 'Listings.Listings',
        ]);
        $this->hasMany('Enquiries', [
            'foreignKey' => 'priority_type_id',
            'className' => 'Enquiry.Enquiries',
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
            ->maxLength('title', 80)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

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
        $rules->add($rules->existsIn(['listing_id'], 'Listings'));

        return $rules;
    }
}

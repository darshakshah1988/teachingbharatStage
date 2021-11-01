<?php
declare(strict_types=1);

namespace Enquiry\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EnquiryStatuses Model
 *
 * @property \Enquiry\Model\Table\ListingsTable&\Cake\ORM\Association\BelongsTo $Listings
 * @property \Enquiry\Model\Table\EnquiriesTable&\Cake\ORM\Association\HasMany $Enquiries
 * @property \Enquiry\Model\Table\EnquiryCommentsTable&\Cake\ORM\Association\HasMany $EnquiryComments
 *
 * @method \Enquiry\Model\Entity\EnquiryStatus newEmptyEntity()
 * @method \Enquiry\Model\Entity\EnquiryStatus newEntity(array $data, array $options = [])
 * @method \Enquiry\Model\Entity\EnquiryStatus[] newEntities(array $data, array $options = [])
 * @method \Enquiry\Model\Entity\EnquiryStatus get($primaryKey, $options = [])
 * @method \Enquiry\Model\Entity\EnquiryStatus findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Enquiry\Model\Entity\EnquiryStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Enquiry\Model\Entity\EnquiryStatus[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Enquiry\Model\Entity\EnquiryStatus|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Enquiry\Model\Entity\EnquiryStatus saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Enquiry\Model\Entity\EnquiryStatus[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Enquiry\Model\Entity\EnquiryStatus[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Enquiry\Model\Entity\EnquiryStatus[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Enquiry\Model\Entity\EnquiryStatus[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EnquiryStatusesTable extends Table
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

        $this->setTable('enquiry_statuses');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Listable');

        $this->belongsTo('Listings', [
            'foreignKey' => 'listing_id',
            'joinType' => 'INNER',
            'className' => 'Listings.Listings',
        ]);
        $this->hasMany('Enquiries', [
            'foreignKey' => 'enquiry_status_id',
            'className' => 'Enquiry.Enquiries',
        ]);
        $this->hasMany('EnquiryComments', [
            'foreignKey' => 'enquiry_status_id',
            'className' => 'Enquiry.EnquiryComments',
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
            ->scalar('color')
            ->maxLength('color', 50)
            ->requirePresence('color', 'create')
            ->notEmptyString('color');

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

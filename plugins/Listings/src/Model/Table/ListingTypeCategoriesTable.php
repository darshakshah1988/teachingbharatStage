<?php
declare(strict_types=1);

namespace Listings\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ListingTypeCategories Model
 *
 * @property \Listings\Model\Table\ListingTypesTable&\Cake\ORM\Association\BelongsTo $ListingTypes
 * @property \Listings\Model\Table\ListingDetailsTable&\Cake\ORM\Association\HasMany $ListingDetails
 *
 * @method \Listings\Model\Entity\ListingTypeCategory newEmptyEntity()
 * @method \Listings\Model\Entity\ListingTypeCategory newEntity(array $data, array $options = [])
 * @method \Listings\Model\Entity\ListingTypeCategory[] newEntities(array $data, array $options = [])
 * @method \Listings\Model\Entity\ListingTypeCategory get($primaryKey, $options = [])
 * @method \Listings\Model\Entity\ListingTypeCategory findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Listings\Model\Entity\ListingTypeCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Listings\Model\Entity\ListingTypeCategory[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Listings\Model\Entity\ListingTypeCategory|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Listings\Model\Entity\ListingTypeCategory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Listings\Model\Entity\ListingTypeCategory[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Listings\Model\Entity\ListingTypeCategory[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Listings\Model\Entity\ListingTypeCategory[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Listings\Model\Entity\ListingTypeCategory[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ListingTypeCategoriesTable extends Table
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

        $this->setTable('listing_type_categories');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ListingTypes', [
            'foreignKey' => 'listing_type_id',
            'joinType' => 'INNER',
            'className' => 'Listings.ListingTypes',
        ]);
        $this->hasMany('ListingDetails', [
            'foreignKey' => 'listing_type_category_id',
            'className' => 'Listings.ListingDetails',
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
            ->maxLength('title', 100)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->integer('sort_order')
            ->requirePresence('sort_order', 'create')
            ->notEmptyString('sort_order');

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
        $rules->add($rules->existsIn(['listing_type_id'], 'ListingTypes'));

        return $rules;
    }
}

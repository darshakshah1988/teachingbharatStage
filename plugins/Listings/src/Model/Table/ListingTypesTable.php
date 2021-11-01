<?php
declare(strict_types=1);

namespace Listings\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ListingTypes Model
 *
 * @property \Listings\Model\Table\ListingTypeCategoriesTable&\Cake\ORM\Association\HasMany $ListingTypeCategories
 * @property \Listings\Model\Table\ListingsTable&\Cake\ORM\Association\HasMany $Listings
 *
 * @method \Listings\Model\Entity\ListingType newEmptyEntity()
 * @method \Listings\Model\Entity\ListingType newEntity(array $data, array $options = [])
 * @method \Listings\Model\Entity\ListingType[] newEntities(array $data, array $options = [])
 * @method \Listings\Model\Entity\ListingType get($primaryKey, $options = [])
 * @method \Listings\Model\Entity\ListingType findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Listings\Model\Entity\ListingType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Listings\Model\Entity\ListingType[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Listings\Model\Entity\ListingType|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Listings\Model\Entity\ListingType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Listings\Model\Entity\ListingType[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Listings\Model\Entity\ListingType[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Listings\Model\Entity\ListingType[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Listings\Model\Entity\ListingType[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ListingTypesTable extends Table
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

        $this->setTable('listing_types');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ListingTypeCategories', [
            'foreignKey' => 'listing_type_id',
            'className' => 'Listings.ListingTypeCategories',
        ]);
        $this->hasMany('Listings', [
            'foreignKey' => 'listing_type_id',
            'className' => 'Listings.Listings',
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
            ->scalar('slug')
            ->maxLength('slug', 180)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
        $rules->add($rules->isUnique(['slug']));

        return $rules;
    }
}

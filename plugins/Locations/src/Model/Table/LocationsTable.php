<?php
declare(strict_types=1);

namespace Locations\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Locations Model
 *
 * @property \Locations\Model\Table\LocationsTable&\Cake\ORM\Association\BelongsTo $ParentLocations
 * @property \Locations\Model\Table\ListingsTable&\Cake\ORM\Association\HasMany $Listings
 * @property \Locations\Model\Table\LocationsTable&\Cake\ORM\Association\HasMany $ChildLocations
 * @property \Locations\Model\Table\UserProfilesTable&\Cake\ORM\Association\HasMany $UserProfiles
 * @property \Locations\Model\Table\PhinxlogTable&\Cake\ORM\Association\BelongsToMany $Phinxlog
 *
 * @method \Locations\Model\Entity\Location newEmptyEntity()
 * @method \Locations\Model\Entity\Location newEntity(array $data, array $options = [])
 * @method \Locations\Model\Entity\Location[] newEntities(array $data, array $options = [])
 * @method \Locations\Model\Entity\Location get($primaryKey, $options = [])
 * @method \Locations\Model\Entity\Location findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Locations\Model\Entity\Location patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Locations\Model\Entity\Location[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Locations\Model\Entity\Location|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Locations\Model\Entity\Location saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Locations\Model\Entity\Location[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Locations\Model\Entity\Location[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Locations\Model\Entity\Location[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Locations\Model\Entity\Location[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class LocationsTable extends Table
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

        $this->setTable('locations');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree');

        $this->addBehavior('Muffin/Slug.Slug', [
            'unique' => true,
            'onUpdate' => true,
            'onDirty' => true
        ]);

        $this->belongsTo('ParentLocations', [
            'className' => 'Locations.Locations',
            'foreignKey' => 'parent_id',
        ]);
        // $this->hasMany('Listings', [
        //     'foreignKey' => 'location_id',
        //     'className' => 'Listings.Listings',
        // ]);
        $this->hasMany('ChildLocations', [
            'className' => 'Locations.Locations',
            'foreignKey' => 'parent_id',
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
            ->maxLength('title', 250)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 150)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('latitude')
            ->maxLength('latitude', 150)
            ->allowEmptyString('latitude');

        $validator
            ->scalar('longitude')
            ->maxLength('longitude', 150)
            ->allowEmptyString('longitude');

        $validator
            ->scalar('iso_alpha2_code')
            ->maxLength('iso_alpha2_code', 10)
            ->allowEmptyString('iso_alpha2_code');

        $validator
            ->scalar('iso_alpha3_code')
            ->maxLength('iso_alpha3_code', 10)
            ->allowEmptyString('iso_alpha3_code');

        $validator
            ->integer('iso_numeric_code')
            ->allowEmptyString('iso_numeric_code');

        $validator
            ->scalar('formatted_address')
            ->allowEmptyString('formatted_address');

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
        $rules->add($rules->isUnique(['slug']), ['errorField' => 'slug']);
        $rules->add($rules->existsIn(['parent_id'], 'ParentLocations'), ['errorField' => 'parent_id']);

        return $rules;
    }

    /** getParentMenuList method
     * 
     *
     * @param $id|int
     * @return all parent ids with title
     */
    public function getParentLocationList($id = null)
    {
        $records = [];
        if (!empty($id)) {
            $parents = $this->find('path', ['for' => $id])
                ->select(['id', 'title'])
                //->where(['id != ' => $id])
                ->toArray();
            foreach ($parents as $parent) {
                $records[$parent->id] = $parent->title;
            }
        }
        return $records;
    }
}

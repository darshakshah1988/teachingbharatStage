<?php
declare(strict_types=1);

namespace Listings\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Listings Model
 *
 * @property \Listings\Model\Table\AdminUsersTable&\Cake\ORM\Association\BelongsTo $AdminUsers
 * @property \Listings\Model\Table\ListingTypesTable&\Cake\ORM\Association\BelongsTo $ListingTypes
 * @property \Listings\Model\Table\ListingsTable&\Cake\ORM\Association\BelongsTo $ParentListings
 * @property \Listings\Model\Table\LocationsTable&\Cake\ORM\Association\BelongsTo $Locations
 * @property \Listings\Model\Table\AcademicYearsTable&\Cake\ORM\Association\HasMany $AcademicYears
 * @property \Listings\Model\Table\AdminUsersTable&\Cake\ORM\Association\HasMany $AdminUsers
 * @property \Listings\Model\Table\InstitutionTypesTable&\Cake\ORM\Association\HasMany $InstitutionTypes
 * @property \Listings\Model\Table\ListingDetailsTable&\Cake\ORM\Association\HasMany $ListingDetails
 * @property \Listings\Model\Table\ListingsTable&\Cake\ORM\Association\HasMany $ChildListings
 * @property \Listings\Model\Table\RolesTable&\Cake\ORM\Association\HasMany $Roles
 *
 * @method \Listings\Model\Entity\Listing newEmptyEntity()
 * @method \Listings\Model\Entity\Listing newEntity(array $data, array $options = [])
 * @method \Listings\Model\Entity\Listing[] newEntities(array $data, array $options = [])
 * @method \Listings\Model\Entity\Listing get($primaryKey, $options = [])
 * @method \Listings\Model\Entity\Listing findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Listings\Model\Entity\Listing patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Listings\Model\Entity\Listing[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Listings\Model\Entity\Listing|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Listings\Model\Entity\Listing saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Listings\Model\Entity\Listing[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Listings\Model\Entity\Listing[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Listings\Model\Entity\Listing[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Listings\Model\Entity\Listing[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ListingsTable extends Table
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

        $this->setTable('listings');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior('Muffin/Slug.Slug', [
        'unique' => true,
        'onUpdate' => true
        ]);

        $this->addBehavior('ADmad/Sequence.Sequence', [
            'sequenceField' => 'sort_order', // Field to use to store integer sequence. Default "position".
            'startAt' => 1, // Initial value for sequence. Default 1.
        ]);
        $this->addBehavior('RandomString', [
            'field' => 'code',
            'case'=>'upper'
            ]
        );

        $this->addBehavior('AuditStash.AuditLog');

        $this->behaviors()->get('AuditLog')->persister()->setConfig([
                'extractMetaFields' => [
                    'user.id' => 'admin_user_id',
                ]
            ]);

        $this->belongsTo('AdminUsers', [
            'foreignKey' => 'admin_user_id',
            'joinType' => 'INNER',
            'className' => 'Listings.AdminUsers',
        ]);
        $this->belongsTo('ListingTypes', [
            'foreignKey' => 'listing_type_id',
            'joinType' => 'INNER',
            'className' => 'Listings.ListingTypes',
        ]);
        $this->belongsTo('ParentListings', [
            'className' => 'Listings.Listings',
            'foreignKey' => 'parent_id',
        ]);
        $this->belongsTo('Locations', [
            'foreignKey' => 'location_id',
            'joinType' => 'LEFT',
            'className' => 'Listings.Locations',
        ]);
        $this->hasMany('AcademicYears', [
            'foreignKey' => 'listing_id',
            'className' => 'Listings.AcademicYears',
        ]);
        $this->hasMany('AdminUsers', [
            'foreignKey' => 'listing_id',
            'className' => 'Listings.AdminUsers',
        ]);
        $this->hasMany('InstitutionTypes', [
            'foreignKey' => 'listing_id',
            'className' => 'Listings.InstitutionTypes',
        ]);
        $this->hasMany('ListingDetails', [
            'foreignKey' => 'listing_id',
            'className' => 'Listings.ListingDetails',
        ]);
        $this->hasMany('ChildListings', [
            'className' => 'Listings.Listings',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('Roles', [
            'foreignKey' => 'listing_id',
            'className' => 'Listings.Roles',
        ]);

        $this->hasMany('Settings', [
            'foreignKey' => 'listing_id',
            'className' => 'Settings.Settings',
        ]);
    }

    /**
     * Quick Add listing validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationQuickAdd(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('listing_type_id')
            ->requirePresence('listing_type_id', 'create')
            ->notEmptyString('listing_type_id');

        $validator
            ->scalar('code')
            ->maxLength('code', 180)
            ->notEmptyString('code');

        $validator
            ->scalar('title')
            ->maxLength('title', 250)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 250)
            ->allowEmptyString('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('tag_line')
            ->maxLength('tag_line', 250)
            ->allowEmptyString('tag_line');

        $validator
            ->scalar('protocol')
            ->requirePresence('protocol', 'create')
            ->notEmptyString('protocol');

        $validator
            ->scalar('domain_name')
            ->maxLength('domain_name', 100)
            ->allowEmptyString('domain_name');

        $validator
            ->boolean('is_visible')
            ->allowEmptyString('is_visible');

        $validator
            ->boolean('status')
            ->allowEmptyString('status');

        $validator
            ->integer('sort_order')
            ->requirePresence('sort_order', 'create')
            ->notEmptyString('sort_order');

        return $validator;
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
            ->scalar('code')
            ->maxLength('code', 180)
            ->requirePresence('code', 'create')
            ->notEmptyString('code')
            ->add('code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('title')
            ->maxLength('title', 250)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 250)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('tag_line')
            ->maxLength('tag_line', 250)
            ->allowEmptyString('tag_line');

        $validator
            ->scalar('protocol')
            ->requirePresence('protocol', 'create')
            ->notEmptyString('protocol');

        $validator
            ->scalar('domain_name')
            ->maxLength('domain_name', 100)
            ->allowEmptyString('domain_name');

        $validator
            ->scalar('registration_no')
            ->maxLength('registration_no', 100)
            ->allowEmptyString('registration_no');

        $validator
            ->date('registration_date')
            ->allowEmptyDate('registration_date');

        $validator
            ->scalar('logo')
            ->maxLength('logo', 255)
            ->allowEmptyString('logo');

        $validator
            ->scalar('logo_dir')
            ->maxLength('logo_dir', 255)
            ->allowEmptyString('logo_dir');

        $validator
            ->integer('logo_size')
            ->allowEmptyString('logo_size');

        $validator
            ->scalar('logo_type')
            ->maxLength('logo_type', 50)
            ->allowEmptyString('logo_type');

        $validator
            ->scalar('banner')
            ->maxLength('banner', 255)
            ->allowEmptyString('banner');

        $validator
            ->scalar('banner_dir')
            ->maxLength('banner_dir', 255)
            ->allowEmptyString('banner_dir');

        $validator
            ->integer('banner_size')
            ->allowEmptyString('banner_size');

        $validator
            ->scalar('banner_type')
            ->maxLength('banner_type', 50)
            ->allowEmptyString('banner_type');

        $validator
            ->scalar('thumb_image')
            ->maxLength('thumb_image', 255)
            ->allowEmptyFile('thumb_image');

        $validator
            ->scalar('thumb_image_dir')
            ->maxLength('thumb_image_dir', 255)
            ->allowEmptyFile('thumb_image_dir');

        $validator
            ->integer('thumb_image_size')
            ->allowEmptyFile('thumb_image_size');

        $validator
            ->scalar('thumb_image_type')
            ->maxLength('thumb_image_type', 50)
            ->allowEmptyFile('thumb_image_type');

        $validator
            ->scalar('address_line_1')
            ->maxLength('address_line_1', 150)
            ->requirePresence('address_line_1', 'create')
            ->notEmptyString('address_line_1');

        $validator
            ->scalar('address_line_2')
            ->maxLength('address_line_2', 150)
            ->allowEmptyString('address_line_2');

        $validator
            ->scalar('postcode')
            ->maxLength('postcode', 8)
            ->requirePresence('postcode', 'create')
            ->notEmptyString('postcode');

        $validator
            ->scalar('latitude')
            ->maxLength('latitude', 80)
            ->allowEmptyString('latitude');

        $validator
            ->scalar('longitude')
            ->maxLength('longitude', 80)
            ->allowEmptyString('longitude');

        $validator
            ->scalar('short_description')
            ->maxLength('short_description', 255)
            ->requirePresence('short_description', 'create')
            ->notEmptyString('short_description');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->scalar('meta_title')
            ->maxLength('meta_title', 200)
            ->requirePresence('meta_title', 'create')
            ->notEmptyString('meta_title');

        $validator
            ->scalar('meta_keyword')
            ->maxLength('meta_keyword', 255)
            ->requirePresence('meta_keyword', 'create')
            ->notEmptyString('meta_keyword');

        $validator
            ->scalar('meta_description')
            ->maxLength('meta_description', 255)
            ->requirePresence('meta_description', 'create')
            ->notEmptyString('meta_description');

        $validator
            ->boolean('is_visible')
            ->allowEmptyString('is_visible');

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

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
        $rules->add($rules->isUnique(['code']));
        $rules->add($rules->isUnique(['slug']));
        $rules->add($rules->existsIn(['admin_user_id'], 'AdminUsers'));
        $rules->add($rules->existsIn(['listing_type_id'], 'ListingTypes'));
        $rules->add($rules->existsIn(['parent_id'], 'ParentListings'));
        $rules->add($rules->existsIn(['location_id'], 'Locations'));

        return $rules;
    }



    public function beforeSave(\Cake\Event\Event $event, \Cake\Datasource\EntityInterface $entity, \ArrayObject $options){
            if ($entity->isNew()) {
                $entity->set('status', 1);
            }
    }


    /*
     * Finder listId
     * get listing id according to domain url
     */

    public function findListId(Query $query, array $options)
    {
        return $query->where(['Listings.domain_name' => $options['domain']])->select(['Listings.id','Listings.listing_type_id']);
    }
}

<?php
declare(strict_types=1);

namespace AdminUserManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Roles Model
 *
 * @property \AdminUserManager\Model\Table\AdminUsersTable&\Cake\ORM\Association\BelongsToMany $AdminUsers
 *
 * @method \AdminUserManager\Model\Entity\Role newEmptyEntity()
 * @method \AdminUserManager\Model\Entity\Role newEntity(array $data, array $options = [])
 * @method \AdminUserManager\Model\Entity\Role[] newEntities(array $data, array $options = [])
 * @method \AdminUserManager\Model\Entity\Role get($primaryKey, $options = [])
 * @method \AdminUserManager\Model\Entity\Role findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \AdminUserManager\Model\Entity\Role patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AdminUserManager\Model\Entity\Role[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \AdminUserManager\Model\Entity\Role|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminUserManager\Model\Entity\Role saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AdminUserManager\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \AdminUserManager\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \AdminUserManager\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \AdminUserManager\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RolesTable extends Table
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
        $this->setTable('roles');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior('ADmad/Sequence.Sequence', [
            'sequenceField' => 'sort_order', // Field to use to store integer sequence. Default "position".
            'scope' => ['listing_type_id'],
            'startAt' => 1, // Initial value for sequence. Default 1.
        ]);

        $this->belongsTo('ListingTypes', [
            'foreignKey' => 'listing_type_id',
            'joinType' => 'INNER',
            'className' => 'Listings.ListingTypes',
            'sort' => ['ListingTypes.sort_order' => 'ASC']
        ]);

        $this->belongsToMany('AdminUsers', [
            'foreignKey' => 'role_id',
            'targetForeignKey' => 'admin_user_id',
            'joinTable' => 'admin_users_roles',
            'className' => 'AdminUserManager.AdminUsers',
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

       // $validator
       //      ->integer('listing_type_id')
       //      ->requirePresence('listing_type_id', 'create')
       //      ->notEmptyString('listing_type_id');

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

    // public function beforeMarshal(\Cake\Event\Event $event, \ArrayObject $data)
    // {
    //     if(defined('LISTING_ID')){
    //         $data['listing_id'] = LISTING_ID;
    //     }
    // }

    /**
     * This filters function is a 'finder' to used for get roles according listing domain
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @param type $options Options Array
     * @return \Cake\ORM\Query
     */
    public function findDomain(Query $query, array $options)
    {
        return $query;
        return $query->where(['Roles.listing_type_id' => \Cake\Core\Configure::read('Tech.listing_type_id')]);
    }

}

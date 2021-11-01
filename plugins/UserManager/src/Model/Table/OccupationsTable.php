<?php
declare(strict_types=1);

namespace UserManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Occupations Model
 *
 * @property \UserManager\Model\Table\UserProfilesTable&\Cake\ORM\Association\HasMany $UserProfiles
 *
 * @method \UserManager\Model\Entity\Occupation newEmptyEntity()
 * @method \UserManager\Model\Entity\Occupation newEntity(array $data, array $options = [])
 * @method \UserManager\Model\Entity\Occupation[] newEntities(array $data, array $options = [])
 * @method \UserManager\Model\Entity\Occupation get($primaryKey, $options = [])
 * @method \UserManager\Model\Entity\Occupation findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \UserManager\Model\Entity\Occupation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \UserManager\Model\Entity\Occupation[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \UserManager\Model\Entity\Occupation|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \UserManager\Model\Entity\Occupation saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \UserManager\Model\Entity\Occupation[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \UserManager\Model\Entity\Occupation[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \UserManager\Model\Entity\Occupation[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \UserManager\Model\Entity\Occupation[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OccupationsTable extends Table
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

        $this->setTable('occupations');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('UserProfiles', [
            'foreignKey' => 'occupation_id',
            'className' => 'UserManager.UserProfiles',
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
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        return $validator;
    }
}

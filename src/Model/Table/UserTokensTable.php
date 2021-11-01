<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserTokens Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\UserToken newEmptyEntity()
 * @method \App\Model\Entity\UserToken newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\UserToken[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserToken get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserToken findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\UserToken patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserToken[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserToken|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserToken saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserToken[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\UserToken[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\UserToken[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\UserToken[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserTokensTable extends Table
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

        $this->setTable('user_tokens');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'conditions' => ['Users.user_type' => "users"]
        ]);
        $this->belongsTo('AdminUsers', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'conditions' => ['AdminUsers.user_type' => "admin_users"]
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
            ->scalar('user_type')
            ->maxLength('user_type', 20)
            ->requirePresence('user_type', 'create')
            ->notEmptyString('user_type');

        $validator
            ->scalar('token_type')
            ->maxLength('token_type', 100)
            ->requirePresence('token_type', 'create')
            ->notEmptyString('token_type');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->scalar('token')
            ->maxLength('token', 255)
            ->requirePresence('token', 'create')
            ->notEmptyString('token');

        return $validator;
    }

    /**
     * This token function is a 'finder' to get user token info
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @param type $options Options Array
     * @return \Cake\ORM\Query
     */
    public function findToken(\Cake\ORM\Query $query, $options)
    {
        $query
           ->where(['UserTokens.token' => $options['token'], 'UserTokens.user_type' => $options['user_type'], 'UserTokens.token_type' => $options['token_type']]);
        return $query;
    }

}

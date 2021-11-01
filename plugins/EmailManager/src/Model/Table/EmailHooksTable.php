<?php
declare(strict_types=1);

namespace EmailManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmailHooks Model
 *
 * @property \EmailManager\Model\Table\EmailTemplatesTable|\Cake\ORM\Association\HasMany $EmailTemplates
 *
 * @method \EmailManager\Model\Entity\EmailHook get($primaryKey, $options = [])
 * @method \EmailManager\Model\Entity\EmailHook newEntity($data = null, array $options = [])
 * @method \EmailManager\Model\Entity\EmailHook[] newEntities(array $data, array $options = [])
 * @method \EmailManager\Model\Entity\EmailHook|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EmailManager\Model\Entity\EmailHook patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EmailManager\Model\Entity\EmailHook[] patchEntities($entities, array $data, array $options = [])
 * @method \EmailManager\Model\Entity\EmailHook findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmailHooksTable extends Table
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

        $this->setTable('email_hooks');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('EmailTemplates', [
            'foreignKey' => 'email_hook_id',
            'className' => 'EmailManager.EmailTemplates',
            'dependent' => true,
			'cascadeCallbacks' => true
        ]);

        $this->addBehavior('Muffin/Slug.Slug', [
        'unique' => true,
        'displayField' => 'title',
        'onUpdate' => true,
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
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('title')
            ->requirePresence('title', 'create')
            ->notEmptyString('title', 'Title is required field.');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 255)
            ->requirePresence('slug', 'create')
            ->add('slug', [
                'chkUnique' => [
                    'rule' => [$this, 'chkUnique'],
                    'message' => 'Email Hook must be unique.'
        ]]);

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description', 'Description is required field.');

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        return $validator;
    }



    public function chkUnique($value, $context) {
        if(empty(trim($value)))
            return true;
        if($context['newRecord'] != 1){
            $conditions['id !='] = $context['data']['id'];
        }
        $conditions['slug'] = $value;
        $conditions['listing_id'] = $context['data']['listing_id'] ?? \Cake\Core\Configure::read('LISTING_ID');
        $chk = $this->find()->where($conditions)->count();
        if ($chk == 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * before marshal used for trim whitspace for all form element
     *
     * @param Cake\Event\Event; $event .
     * @param type $data Options Array
     * @return \Cake\ORM\Query
     */
    public function beforeMarshal(\Cake\Event\Event $event, \ArrayObject $data) {
        if(\Cake\Core\Configure::read('LISTING_ID')){
            $data['listing_id'] = \Cake\Core\Configure::read('LISTING_ID');
        }
    }

    /*
     * Finder domain
     * get listing id according to domain url
     */

    public function findDomain(Query $query, array $options)
    {
        if(\Cake\Core\Configure::read('LISTING_ID')){
            $query->where(['EmailHooks.listing_id' => \Cake\Core\Configure::read('LISTING_ID')]);
        }
        return $query;
    }

}

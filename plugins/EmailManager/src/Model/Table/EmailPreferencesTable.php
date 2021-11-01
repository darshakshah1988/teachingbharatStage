<?php
declare(strict_types=1);

namespace EmailManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmailPreferences Model
 *
 * @property \EmailManager\Model\Table\EmailTemplatesTable|\Cake\ORM\Association\HasMany $EmailTemplates
 *
 * @method \EmailManager\Model\Entity\EmailPreference get($primaryKey, $options = [])
 * @method \EmailManager\Model\Entity\EmailPreference newEntity($data = null, array $options = [])
 * @method \EmailManager\Model\Entity\EmailPreference[] newEntities(array $data, array $options = [])
 * @method \EmailManager\Model\Entity\EmailPreference|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EmailManager\Model\Entity\EmailPreference patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EmailManager\Model\Entity\EmailPreference[] patchEntities($entities, array $data, array $options = [])
 * @method \EmailManager\Model\Entity\EmailPreference findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmailPreferencesTable extends Table
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

        $this->setTable('email_preferences');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        //$this->addBehavior('Listable');

        $this->hasMany('EmailTemplates', [
            'foreignKey' => 'email_preference_id',
            'className' => 'EmailManager.EmailTemplates'
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
            ->notEmptyString('title');

        $validator
            ->scalar('layout_html')
            ->requirePresence('layout_html', 'create')
            ->notEmptyString('layout_html');

        return $validator;
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
     * Finder listId
     * get listing id according to domain url
     */

    public function findDomain(Query $query, array $options)
    {
        if(\Cake\Core\Configure::read('LISTING_ID')){
            $query->where(['EmailPreferences.listing_id' => \Cake\Core\Configure::read('LISTING_ID')]);
        }
        return $query;
    }
}

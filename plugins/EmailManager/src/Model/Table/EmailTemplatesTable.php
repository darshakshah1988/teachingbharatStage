<?php
declare(strict_types=1);

namespace EmailManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmailTemplates Model
 *
 * @property \EmailManager\Model\Table\EmailHooksTable|\Cake\ORM\Association\BelongsTo $EmailHooks
 * @property \EmailManager\Model\Table\EmailPreferencesTable|\Cake\ORM\Association\BelongsTo $EmailPreferences
 *
 * @method \EmailManager\Model\Entity\EmailTemplate get($primaryKey, $options = [])
 * @method \EmailManager\Model\Entity\EmailTemplate newEntity($data = null, array $options = [])
 * @method \EmailManager\Model\Entity\EmailTemplate[] newEntities(array $data, array $options = [])
 * @method \EmailManager\Model\Entity\EmailTemplate|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EmailManager\Model\Entity\EmailTemplate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EmailManager\Model\Entity\EmailTemplate[] patchEntities($entities, array $data, array $options = [])
 * @method \EmailManager\Model\Entity\EmailTemplate findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmailTemplatesTable extends Table
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

        $this->setTable('email_templates');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('EmailHooks', [
            'foreignKey' => 'email_hook_id',
            'joinType' => 'INNER',
            'className' => 'EmailManager.EmailHooks'
        ]);
        $this->belongsTo('EmailPreferences', [
            'foreignKey' => 'email_preference_id',
            'joinType' => 'INNER',
            'className' => 'EmailManager.EmailPreferences'
        ]);

        $this->belongsTo('Listings', [
            'foreignKey' => 'listing_id',
            'joinType' => 'INNER',
            'className' => 'Listings.Listings'
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
            ->notEmptyString('email_hook_id','Email Hook is required field.')
            ->add('email_hook_id', [
                'chkUnique' => [
                    'rule' => [$this, 'chkUnique'],
                    'message' => 'This email hook already used please try another hook.'
        ]]);


        $validator
            ->scalar('subject')
            ->requirePresence('subject', 'create')
            ->notEmptyString('subject','Subject is required field.');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description','Description is required field.');

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
        $rules->add($rules->existsIn(['email_hook_id'], 'EmailHooks'));
        $rules->add($rules->existsIn(['email_preference_id'], 'EmailPreferences'));

        return $rules;
    }

    public function chkUnique($value, $context) {
        if(empty(trim($value)))
            return true;
        if($context['newRecord'] != 1){
            $conditions['id !='] = $context['data']['id'];
        }
        if(!empty($context['data']['template_type'])){
            $conditions['template_type'] = $context['data']['template_type'];
        }
        $conditions['email_hook_id'] = $value;
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
        if(!isset($data['listing_id'])){
            if(\Cake\Core\Configure::read('LISTING_ID')){
                $data['listing_id'] = \Cake\Core\Configure::read('LISTING_ID');
            }
        }
    }


	/**
     * This hook function is a 'finder' to use for get email template
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @param type $options Options Array
     * @return \Cake\ORM\Query
     */
  public function findHook(\Cake\ORM\Query $query, $options)
    {
	    $query
            ->contain(['EmailHooks' => function($q) use($options){
				if(isset($options['listing_id']) && !empty($options['listing_id'])){
					$q->where(['EmailHooks.listing_id' => $options['listing_id']]);
				}else if(\Cake\Core\Configure::read('LISTING_ID')){
					$q->where(['EmailHooks.listing_id' => \Cake\Core\Configure::read('LISTING_ID')]);
				}

				return $q->where(['EmailHooks.slug' => trim($options['slug']),'EmailHooks.status' => 1]);
			},'EmailPreferences' => function($q) use($options){
                if(isset($options['listing_id']) && !empty($options['listing_id'])){
                    $q->where(['EmailPreferences.listing_id' => $options['listing_id']]);
                }else if(\Cake\Core\Configure::read('LISTING_ID')){
                    $q->where(['EmailPreferences.listing_id' => \Cake\Core\Configure::read('LISTING_ID')]);
                }
                return $q;
            }]);

			if(isset($options['listing_id']) && !empty($options['listing_id'])){
				$query->where(['EmailTemplates.listing_id' => $options['listing_id']]);
			}

			$query->contain(['Listings' => function($q){
				return $q->select(['Listings.id', 'Listings.title', 'Listings.slug','Listings.domain_name'])->contain(['Settings' => function($q){
                    // return $q->find('list',['keyField' => 'slug', 'valueField' => 'config_value']);
                    return $q;
                }]); 
			}]);
          return $query;
    }

    /*
     * Finder listId
     * get listing id according to domain url
     */

    public function findDomain(Query $query, array $options)
    {
        if(\Cake\Core\Configure::read('LISTING_ID')){
            $query->where(['EmailTemplates.listing_id' => \Cake\Core\Configure::read('LISTING_ID')]);
        }
        return $query;
    }

}

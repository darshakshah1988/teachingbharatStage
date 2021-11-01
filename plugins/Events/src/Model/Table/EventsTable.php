<?php
declare(strict_types=1);

namespace Events\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Events Model
 *
 * @property \Events\Model\Table\AdminUsersTable&\Cake\ORM\Association\BelongsTo $AdminUsers
 * @property \Events\Model\Table\ListingsTable&\Cake\ORM\Association\BelongsTo $Listings
 * @property \Events\Model\Table\EventDocumentsTable&\Cake\ORM\Association\HasMany $EventDocuments
 * @property \Events\Model\Table\EventSocialLinksTable&\Cake\ORM\Association\HasMany $EventSocialLinks
 * @property \Events\Model\Table\PhinxlogTable&\Cake\ORM\Association\BelongsToMany $Phinxlog
 *
 * @method \Events\Model\Entity\Event newEmptyEntity()
 * @method \Events\Model\Entity\Event newEntity(array $data, array $options = [])
 * @method \Events\Model\Entity\Event[] newEntities(array $data, array $options = [])
 * @method \Events\Model\Entity\Event get($primaryKey, $options = [])
 * @method \Events\Model\Entity\Event findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Events\Model\Entity\Event patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Events\Model\Entity\Event[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Events\Model\Entity\Event|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Events\Model\Entity\Event saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Events\Model\Entity\Event[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Events\Model\Entity\Event[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Events\Model\Entity\Event[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Events\Model\Entity\Event[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EventsTable extends Table
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
        $this->_dir = 'webroot' . DS . 'img' . DS . 'uploads' . DS;
        $this->setTable('events');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Listable');

        $this->belongsTo('AdminUsers', [
            'foreignKey' => 'admin_user_id',
            'joinType' => 'INNER',
            'className' => 'AdminUserManager.AdminUsers',
        ]);
        $this->belongsTo('Listings', [
            'foreignKey' => 'listing_id',
            'joinType' => 'INNER',
            'className' => 'Listings.Listings',
        ]);
        $this->hasMany('EventDocuments', [
            'foreignKey' => 'event_id',
            'className' => 'Events.EventDocuments',
        ]);
        $this->hasMany('EventSocialLinks', [
            'foreignKey' => 'event_id',
            'className' => 'Events.EventSocialLinks',
        ]);

        $this->hasMany('EventImages', [
            'foreignKey' => 'event_id',
            'className' => 'Events.EventDocuments',
            'conditions' => ['EventImages.file_type' => 1]
        ]);

        $this->hasMany('EventVideos', [
            'foreignKey' => 'event_id',
            'className' => 'Events.EventDocuments',
            'conditions' => ['EventVideos.file_type' => 2]
        ]);

        $this->addBehavior('Muffin/Slug.Slug', [
            'unique' => true,
            'onUpdate' => true,
            'onDirty' => true
        ]);

        $this->addBehavior('ADmad/Sequence.Sequence', [
            'startAt' => 1, // Initial value for sequence. Default 1.
        ]);

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'banner' => [
                'fields' => [
                    // if these fields or their defaults exist
                    // the values will be set.
                    'dir' => 'banner_dir', // defaults to `dir`
                    'size' => 'banner_size', // defaults to `size`
                    'type' => 'banner_type', // defaults to `type`
                ],
                'nameCallback' => function ($table, $entity, $data, $field, $settings) {
                        $ext = pathinfo($data->getClientFilename(), PATHINFO_EXTENSION);
                        return rand(100000,999999).time().rand(10000 , 99999).".".$ext;
                        //return strtolower(str_replace(" ","",$data['name']));
                },
                'path' => $this->_dir.'{field-value:listing_id}{DS}{model}{DS}{field}{DS}',
                'keepFilesOnDelete' => false
            ],
           
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
            ->maxLength('slug', 255)
            ->allowEmptyString('slug')
            ->add('slug', [
                'chkUnique' => [
                    'rule' => [$this, 'chkUnique'],
                    'message' => 'Event slug must be unique.'
            ]]);

        $validator
            ->scalar('sub_title')
            ->maxLength('sub_title', 250)
            ->allowEmptyString('sub_title');

        $validator
            ->scalar('short_description')
            ->maxLength('short_description', 400)
            ->requirePresence('short_description', 'create')
            ->notEmptyString('short_description');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->scalar('location')
            ->maxLength('location', 255)
            ->allowEmptyString('location');

        $validator
            ->scalar('organizar_name')
            ->maxLength('organizar_name', 255)
            ->allowEmptyString('organizar_name');

        $validator
            ->scalar('organizer_email')
            ->maxLength('organizer_email', 255)
            ->allowEmptyString('organizer_email');

        $validator
            ->scalar('organizer_contact_number')
            ->maxLength('organizer_contact_number', 20)
            ->allowEmptyString('organizer_contact_number');

        $validator
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
            ->date('start_date')
            ->requirePresence('start_date', 'create')
            ->notEmptyDate('start_date');

        $validator
            ->date('end_date')
            ->requirePresence('end_date', 'create')
            ->notEmptyDate('end_date');

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
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        $validator
            ->integer('position')
            ->requirePresence('position', 'create')
            ->notEmptyString('position');

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
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['admin_user_id'], 'AdminUsers'));
        $rules->add($rules->existsIn(['listing_id'], 'Listings'));

        return $rules;
    }
}

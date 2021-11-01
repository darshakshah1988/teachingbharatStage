<?php
declare(strict_types=1);

namespace Announcement\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Announcements Model
 *
 * @property \Announcement\Model\Table\ListingsTable&\Cake\ORM\Association\BelongsTo $Listings
 * @property \Announcement\Model\Table\AdminUsersTable&\Cake\ORM\Association\BelongsTo $AdminUsers
 *
 * @method \Announcement\Model\Entity\Announcement newEmptyEntity()
 * @method \Announcement\Model\Entity\Announcement newEntity(array $data, array $options = [])
 * @method \Announcement\Model\Entity\Announcement[] newEntities(array $data, array $options = [])
 * @method \Announcement\Model\Entity\Announcement get($primaryKey, $options = [])
 * @method \Announcement\Model\Entity\Announcement findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Announcement\Model\Entity\Announcement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Announcement\Model\Entity\Announcement[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Announcement\Model\Entity\Announcement|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Announcement\Model\Entity\Announcement saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Announcement\Model\Entity\Announcement[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Announcement\Model\Entity\Announcement[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Announcement\Model\Entity\Announcement[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Announcement\Model\Entity\Announcement[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AnnouncementsTable extends Table
{
    public $_dir;
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
        $this->setTable('announcements');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Listable');
        $this->belongsTo('Listings', [
            'foreignKey' => 'listing_id',
            'joinType' => 'INNER',
            'className' => 'Announcement.Listings',
        ]);
        $this->belongsTo('AdminUsers', [
            'foreignKey' => 'admin_user_id',
            'joinType' => 'INNER',
            'className' => 'AdminUserManager.AdminUsers',
        ]);

        $this->addBehavior('Muffin/Slug.Slug', [
            'unique' => true,
            'onUpdate' => false,
            'onDirty' => true
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
                    'message' => 'Email Hook must be unique.'
        ]]);

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->allowEmptyString('is_popup');

        $validator
            ->allowEmptyString('banner');

        $validator
            ->boolean('status')
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
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['listing_id'], 'Listings'));
        $rules->add($rules->existsIn(['admin_user_id'], 'AdminUsers'));

        return $rules;
    }
}

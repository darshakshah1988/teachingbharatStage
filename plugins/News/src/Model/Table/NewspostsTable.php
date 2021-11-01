<?php
declare(strict_types=1);

namespace News\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Newsposts Model
 *
 * @property \News\Model\Table\ListingsTable&\Cake\ORM\Association\BelongsTo $Listings
 * @property \News\Model\Table\AdminUsersTable&\Cake\ORM\Association\BelongsTo $AdminUsers
 *
 * @method \News\Model\Entity\Newspost newEmptyEntity()
 * @method \News\Model\Entity\Newspost newEntity(array $data, array $options = [])
 * @method \News\Model\Entity\Newspost[] newEntities(array $data, array $options = [])
 * @method \News\Model\Entity\Newspost get($primaryKey, $options = [])
 * @method \News\Model\Entity\Newspost findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \News\Model\Entity\Newspost patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \News\Model\Entity\Newspost[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \News\Model\Entity\Newspost|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \News\Model\Entity\Newspost saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \News\Model\Entity\Newspost[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \News\Model\Entity\Newspost[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \News\Model\Entity\Newspost[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \News\Model\Entity\Newspost[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class NewspostsTable extends Table
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
        $this->setTable('newsposts');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Listable');

        $this->belongsTo('Listings', [
            'foreignKey' => 'listing_id',
            'joinType' => 'INNER',
            'className' => 'Listings.Listings',
        ]);
        $this->belongsTo('AdminUsers', [
            'foreignKey' => 'admin_user_id',
            'joinType' => 'INNER',
            'className' => 'AdminUserManager.AdminUsers',
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
            'banner_image' => [
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
            'header_image' => [
                'fields' => [
                    // if these fields or their defaults exist
                    // the values will be set.
                    'dir' => 'header_dir', // defaults to `dir`
                    'size' => 'header_size', // defaults to `size`
                    'type' => 'header_type', // defaults to `type`
                ],
                'nameCallback' => function ($table, $entity, $data, $field, $settings) {
                    $ext = pathinfo($data->getClientFilename(), PATHINFO_EXTENSION);
                    return rand(100000, 999999) . time() . rand(10000, 99999) . "." . $ext;
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
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 255)
            ->allowEmptyString('slug')
            ->add('slug', [
                'chkUnique' => [
                    'rule' => [$this, 'chkUnique'],
                    'message' => 'News slug must be unique.'
        ]]);

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
            ->maxLength('meta_title', 255)
            ->requirePresence('meta_title', 'create')
            ->notEmptyString('meta_title');

        $validator
            ->scalar('meta_keyword')
            ->maxLength('meta_keyword', 255)
            ->requirePresence('meta_keyword', 'create')
            ->notEmptyString('meta_keyword');

        $validator
            ->scalar('meta_description')
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
        $rules->add($rules->existsIn(['listing_id'], 'Listings'));
        $rules->add($rules->existsIn(['admin_user_id'], 'AdminUsers'));

        return $rules;
    }
}

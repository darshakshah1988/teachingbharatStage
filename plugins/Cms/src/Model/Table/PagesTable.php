<?php
declare(strict_types=1);

namespace Cms\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Filesystem\File;

/**
 * Pages Model
 *
 * @property \Cms\Model\Table\ListingsTable&\Cake\ORM\Association\BelongsTo $Listings
 *
 * @method \Cms\Model\Entity\Page newEmptyEntity()
 * @method \Cms\Model\Entity\Page newEntity(array $data, array $options = [])
 * @method \Cms\Model\Entity\Page[] newEntities(array $data, array $options = [])
 * @method \Cms\Model\Entity\Page get($primaryKey, $options = [])
 * @method \Cms\Model\Entity\Page findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Cms\Model\Entity\Page patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Cms\Model\Entity\Page[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Cms\Model\Entity\Page|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Cms\Model\Entity\Page saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Cms\Model\Entity\Page[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Cms\Model\Entity\Page[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Cms\Model\Entity\Page[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Cms\Model\Entity\Page[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PagesTable extends Table
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
        $this->setTable('pages');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior('Listable');

        $this->belongsTo('Listings', [
            'foreignKey' => 'listing_id',
            'joinType' => 'INNER',
            'className' => 'Cms.Listings',
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
            ->maxLength('title', 150)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('sub_title')
            ->maxLength('sub_title', 250)
            ->allowEmptyString('sub_title');

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
            ->scalar('short_description')
            ->maxLength('short_description', 700)
            ->requirePresence('short_description', 'create')
            ->notEmptyString('short_description');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->allowEmptyString('banner');


        $validator
            ->maxLength('meta_title', 255)
            ->requirePresence('meta_title', 'create')
            ->notEmptyString('meta_title');

        $validator
            ->scalar('meta_keyword')
            ->maxLength('meta_keyword', 300)
            ->requirePresence('meta_keyword', 'create')
            ->notEmptyString('meta_keyword');

        $validator
            ->scalar('meta_description')
            ->requirePresence('meta_description', 'create')
            ->notEmptyString('meta_description');


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
        $rules->add($rules->isUnique(['slug']));
        $rules->add($rules->existsIn(['listing_id'], 'Listings'));

        return $rules;
    }


    public function deleteImage($image = '', $record = null)
    {
        if (!empty($image)) {
            $file = new File($this->_dir . $image, false);
            if ($file->exists()) {
                $file->delete();
            }
        }
        if (!empty($record)) {
            $record->banner = '';
            return $this->save($record);
        }
        return true;
    }
}

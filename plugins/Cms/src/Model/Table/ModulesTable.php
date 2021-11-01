<?php
declare(strict_types=1);

namespace Cms\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Modules Model
 *
 * @property \Cms\Model\Table\ListingsTable&\Cake\ORM\Association\BelongsTo $Listings
 *
 * @method \Cms\Model\Entity\Module newEmptyEntity()
 * @method \Cms\Model\Entity\Module newEntity(array $data, array $options = [])
 * @method \Cms\Model\Entity\Module[] newEntities(array $data, array $options = [])
 * @method \Cms\Model\Entity\Module get($primaryKey, $options = [])
 * @method \Cms\Model\Entity\Module findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Cms\Model\Entity\Module patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Cms\Model\Entity\Module[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Cms\Model\Entity\Module|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Cms\Model\Entity\Module saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Cms\Model\Entity\Module[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Cms\Model\Entity\Module[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Cms\Model\Entity\Module[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Cms\Model\Entity\Module[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ModulesTable extends Table
{

    /**
     * Page Module root directory
     *
     */

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
        $this->setTable('modules');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Listable');
        $this->belongsTo('Listings', [
            'foreignKey' => 'listing_id',
            'joinType' => 'INNER',
            'className' => 'Cms.Listings',
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
            ->scalar('plugin')
            ->maxLength('plugin', 120)
            ->allowEmptyString('plugin');

        $validator
            ->scalar('controller')
            ->maxLength('controller', 120)
            ->requirePresence('controller', 'create')
            ->notEmptyString('controller');

        $validator
            ->scalar('action')
            ->maxLength('action', 100)
            ->requirePresence('action', 'create')
            ->notEmptyString('action');

        $validator
            ->scalar('json_path')
            ->maxLength('json_path', 700)
            ->allowEmptyString('json_path');

        $validator
            ->scalar('query_string')
            ->maxLength('query_string', 250)
            ->allowEmptyString('query_string');

        $validator
            ->allowEmptyString('banner');

        $validator
            ->scalar('meta_title')
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

        return $rules;
    }

    /**
     * before marshal used for trim whitspace for all form element
     *
     * @param Cake\Event\Event; $event .
     * @param type $data Options Array
     * @return \Cake\ORM\Query
     */
    public function beforeMarshal(\Cake\Event\Event $event, \ArrayObject $data)
    {

        $data['plugin'] = $data['plugin'] ? $data['plugin'] : NULL;
        $path = ['plugin' => $data['plugin'], 'controller' => $data['controller'], 'action' => $data['action']];
        if(!empty($data['query_string'])){
            $path['?'] = json_decode($data['query_string']);
        }
        $data['json_path'] = json_encode($path);
    }

    /**
     * This metas function is a 'finder' to use for get Meta data for every moduled pages
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @return \Cake\ORM\Query
     */
    public function findMetas(Query $query, array $options)
    {
        $conditions = [];
        if(isset($options['controller'])){
            $conditions['Modules.controller'] = $options['controller'];
        }
        if(isset($options['action'])){
            $conditions['Modules.action'] = $options['action'];
        }
        if(isset($options['plugin'])){
            $conditions['Modules.plugin'] = $options['plugin'];
        }
        $query->where($conditions);
        return $query;
    }

    public function deleteImage($image = '', $record = null)
    {
        if (!empty($image)) {
            $file = new \Cake\Filesystem\File($this->_dir . $image, false);
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

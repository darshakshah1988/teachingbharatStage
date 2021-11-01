<?php
declare(strict_types=1);

namespace Cms\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Navigations Model
 *
 * @property \Cms\Model\Table\ListingsTable&\Cake\ORM\Association\BelongsTo $Listings
 * @property \Cms\Model\Table\NavigationsTable&\Cake\ORM\Association\BelongsTo $ParentNavigations
 * @property \Cms\Model\Table\NavigationsTable&\Cake\ORM\Association\HasMany $ChildNavigations
 *
 * @method \Cms\Model\Entity\Navigation newEmptyEntity()
 * @method \Cms\Model\Entity\Navigation newEntity(array $data, array $options = [])
 * @method \Cms\Model\Entity\Navigation[] newEntities(array $data, array $options = [])
 * @method \Cms\Model\Entity\Navigation get($primaryKey, $options = [])
 * @method \Cms\Model\Entity\Navigation findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Cms\Model\Entity\Navigation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Cms\Model\Entity\Navigation[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Cms\Model\Entity\Navigation|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Cms\Model\Entity\Navigation saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Cms\Model\Entity\Navigation[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Cms\Model\Entity\Navigation[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Cms\Model\Entity\Navigation[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Cms\Model\Entity\Navigation[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class NavigationsTable extends Table
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

        $this->setTable('navigations');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree');
        $this->addBehavior('Listable');

        $this->addBehavior('Muffin/Slug.Slug', [
            'unique' => true,
            'onUpdate' => true,
            'onDirty' => true
        ]);

        // $this->addBehavior('ADmad/Sequence.Sequence', [
        //     'startAt' => 1, // Initial value for sequence. Default 1.
        // ]);

        $this->belongsTo('Listings', [
            'foreignKey' => 'listing_id',
            'joinType' => 'INNER',
            'className' => 'Cms.Listings',
        ]); 
        $this->belongsTo('ParentNavigations', [
            'className' => 'Cms.Navigations',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('ChildNavigations', [
            'className' => 'Cms.Navigations',
            'foreignKey' => 'parent_id',
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
            ->scalar('slug')
            ->maxLength('slug', 250)
            ->allowEmptyString('slug')
            ->add('slug', [
                        'chkUnique' => [
                            'rule' => [$this, 'chkUnique'], 
                            'message' => 'This Slug already exists. please try to use another slug.'
                ]]);

        $validator
            ->scalar('menu_link')
            ->maxLength('menu_link', 255)
            ->requirePresence('menu_link', 'create')
            ->notEmptyString('menu_link');

        $validator->add('is_bottom', 'manuRule', [
            'rule' => function ($data, $provider) {
                if (($data == 0) && ($provider['data']['is_top'] == 0 && $provider['data']['is_bottom'] == 0)) {
                    return FALSE;
                } else {
                    return TRUE;
                }
            },
            'message' => __('Please choose position for this navigation.'),
        ]);

        // $validator
        //     ->integer('position')
        //     ->requirePresence('position', 'create')
        //     ->notEmptyString('position');

        return $validator;
    }

    /**chkUnique method check unique value according to listing
     * Returns boolean value
     */
    public function chkUnique($value, $context) {
        if(empty(trim($value)))
            return true;
        if($context['newRecord'] != 1){
            $conditions['id !='] = $context['data']['id'];
        }
        $conditions['slug'] = $value;
        $conditions['listing_id'] = \Cake\Core\Configure::read('LISTING_ID');
        //dd($conditions);die;
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
        $rules->add($rules->existsIn(['parent_id'], 'ParentNavigations'));

        return $rules;
    }

    /** getParentMenuList method
     * 
     *
     * @param $id|int
     * @return all parent ids with title
     */
    public function getParentMenuList($id = null)
    {
        $records = [];
        if (!empty($id)) {
            $parents = $this->find('path', ['for' => $id])
                ->select(['id', 'title'])
                //->where(['id != ' => $id])
                ->toArray();
            foreach ($parents as $parent) {
                $records[$parent->id] = $parent->title;
            }
        }
        return $records;
    }

    /**
     * This metas function is a 'finder' to use for get Meta data for every moduled pages
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @return \Cake\ORM\Query
     */
    public function findPosition(Query $query, array $options)
    {
        $conditions = [];
        if(isset($options['is_bottom']) && !empty($options['is_bottom'])){
            $conditions['Navigations.is_bottom'] = $options['is_bottom'];
        }
        if(isset($options['is_top']) && !empty($options['is_top'])){
            $conditions['Navigations.is_top'] = $options['is_top'];
        }
        
        $query->where($conditions);
        return $query;
    }
    

    /*
     * Finder listId
     * get listing id according to domain url
     */
    public function findParentdomain(Query $query, array $options)
    {
        return $query->where(['ParentNavigations.listing_id' => \Cake\Core\Configure::read('LISTING_ID')]);
    }

    /*
     * Finder Domain
     * get listing id according to domain url
     */
    public function findDomain(Query $query, array $options)
    {
        return $query->where(['Navigations.listing_id' => \Cake\Core\Configure::read('LISTING_ID')]);
    }
}

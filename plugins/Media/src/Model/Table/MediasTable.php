<?php
declare(strict_types=1);

namespace Media\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Core\Configure;

/**
 * Medias Model
 *
 * @property \Media\Model\Table\ListingsTable&\Cake\ORM\Association\BelongsTo $Listings
 * @property \Media\Model\Table\MediaFilesTable&\Cake\ORM\Association\HasMany $MediaFiles
 *
 * @method \Media\Model\Entity\Media newEmptyEntity()
 * @method \Media\Model\Entity\Media newEntity(array $data, array $options = [])
 * @method \Media\Model\Entity\Media[] newEntities(array $data, array $options = [])
 * @method \Media\Model\Entity\Media get($primaryKey, $options = [])
 * @method \Media\Model\Entity\Media findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Media\Model\Entity\Media patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Media\Model\Entity\Media[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Media\Model\Entity\Media|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Media\Model\Entity\Media saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Media\Model\Entity\Media[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Media\Model\Entity\Media[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Media\Model\Entity\Media[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Media\Model\Entity\Media[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MediasTable extends Table
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

        $this->setTable('medias');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Listable');

        $this->belongsTo('Listings', [
            'foreignKey' => 'listing_id',
            'joinType' => 'INNER',
            'className' => 'Media.Listings',
        ]);
        $this->hasMany('MediaFiles', [
            'foreignKey' => 'media_id',
            'className' => 'Media.MediaFiles',
            'sort' => ['position' => 'ASC'],
            'dependent' => true,
            'cascadeCallbacks' => true
        ]);

        $this->addBehavior('ADmad/Sequence.Sequence', [
            'startAt' => 1, // Initial value for sequence. Default 1.
            'scope' => ['media_type']
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
            ->scalar('media_type')
            ->requirePresence('media_type', 'create')
            ->notEmptyString('media_type');

        $validator
            ->scalar('title')
            ->maxLength('title', 250)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

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
     * This default function is a 'finder' to use for call by default banner those define in setting
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @return \Cake\ORM\Query
     */
    public function findDefault(Query $query)
    {
        if(Configure::read('Setting.DEFAULT_BANNER')){
            $conditions['Medias.id'] = trim(Configure::read('Setting.DEFAULT_BANNER'));
        }
        $conditions['Medias.status'] = 1;
        $query->where($conditions);
        $query->contain(['MediaFiles' => function($q){
            return $q->order(['MediaFiles.position' => 'ASC']);
        }]);

        return $query;
    }

    /**
     * This default gallery function is a 'finder' to use for call by default gallery those define in setting
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @return \Cake\ORM\Query
     */
    public function findDefaultGallery(Query $query)
    {
        if(Configure::read('Setting.DEFAULT_GALLERY')){
            $conditions['Medias.id'] = trim(Configure::read('Setting.DEFAULT_GALLERY'));
        }
        $conditions['Medias.status'] = 1;
        $query->where($conditions);
        $query->contain(['MediaFiles' => function($q){
            return $q->order(['MediaFiles.position' => 'ASC']);
        }]);

        return $query;
    }

    /**
     * This banner function is a 'finder' to get banner listing
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @return \Cake\ORM\Query
     */
    public function findBanner(Query $query)
    {
        
        return $query->where(['media_type' => 'banner']);

    }

    /**
     * This download function is a 'finder' to get banner listing
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @return \Cake\ORM\Query
     */
    public function findDownload(Query $query)
    {
        
        return $query->where(['media_type' => 'download']);

    }

    /**
     * This gallery function is a 'finder' to get gallery listing
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @return \Cake\ORM\Query
     */
    public function findGallery(Query $query)
    {
        
        return $query->where(['media_type' => 'gallery']);

    }
   

}

<?php
declare(strict_types=1);

namespace Media\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MediaFiles Model
 *
 * @property \Media\Model\Table\MediaTable&\Cake\ORM\Association\BelongsTo $Media
 *
 * @method \Media\Model\Entity\MediaFile newEmptyEntity()
 * @method \Media\Model\Entity\MediaFile newEntity(array $data, array $options = [])
 * @method \Media\Model\Entity\MediaFile[] newEntities(array $data, array $options = [])
 * @method \Media\Model\Entity\MediaFile get($primaryKey, $options = [])
 * @method \Media\Model\Entity\MediaFile findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Media\Model\Entity\MediaFile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Media\Model\Entity\MediaFile[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Media\Model\Entity\MediaFile|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Media\Model\Entity\MediaFile saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Media\Model\Entity\MediaFile[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Media\Model\Entity\MediaFile[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Media\Model\Entity\MediaFile[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Media\Model\Entity\MediaFile[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MediaFilesTable extends Table
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

        $this->setTable('media_files');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Medias', [
            'foreignKey' => 'media_id',
            'joinType' => 'INNER',
            'className' => 'Media.Media',
        ]);

        $this->addBehavior('ADmad/Sequence.Sequence', [
            'startAt' => 1, // Initial value for sequence. Default 1.
            'scope' => ['media_id']
        ]);
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'media_image' => [
                'fields' => [
                    'dir' => 'media_image_dir', // defaults to `dir`
                    'size' => 'media_image_size', // defaults to `size`
                    'type' => 'media_image_type', // defaults to `type`
                ],
                'nameCallback' => function ($table, $entity, $data, $field, $settings) {
                    $ext = pathinfo($data->getClientFilename(), PATHINFO_EXTENSION);
                    return rand(100000,999999).time().rand(10000 , 99999).".".$ext;
                    //return strtolower(str_replace(" ","",$data['name']));
                },
                'path' => 'webroot' . DS . 'img' . DS . 'uploads' . DS .'{field-value:listing_id}{DS}{model}{DS}{field}{DS}',
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
            ->scalar('description')
            ->maxLength('description', 255)
            ->requirePresence('description', 'create')
            ->allowEmptyString('description');

        $validator
            ->scalar('external_link')
            ->allowEmptyString('external_link');

        $validator
            ->allowEmptyFile('media_image');

        $validator
            ->integer('position')
            ->requirePresence('position', 'create')
            ->notEmptyString('position');

        $validator
            ->boolean('status')
            ->allowEmptyString('status');

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
        $rules->add($rules->existsIn(['media_id'], 'Medias'));

        return $rules;
    }

    public function beforeMarshal(\Cake\Event\Event $event, \ArrayObject $data)
    {
        if(\Cake\Core\Configure::read('LISTING_ID')){
            $data['listing_id'] = \Cake\Core\Configure::read('LISTING_ID');
        }
    }
}

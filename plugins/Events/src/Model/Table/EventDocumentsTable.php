<?php
declare(strict_types=1);

namespace Events\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\EventInterface;
use Cake\Datasource\EntityInterface;
use ArrayObject;
use Cake\Filesystem\File;
use Cake\Filesystem\Folder;

/**
 * EventDocuments Model
 *
 * @property \Events\Model\Table\EventsTable&\Cake\ORM\Association\BelongsTo $Events
 *
 * @method \Events\Model\Entity\EventDocument newEmptyEntity()
 * @method \Events\Model\Entity\EventDocument newEntity(array $data, array $options = [])
 * @method \Events\Model\Entity\EventDocument[] newEntities(array $data, array $options = [])
 * @method \Events\Model\Entity\EventDocument get($primaryKey, $options = [])
 * @method \Events\Model\Entity\EventDocument findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Events\Model\Entity\EventDocument patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Events\Model\Entity\EventDocument[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Events\Model\Entity\EventDocument|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Events\Model\Entity\EventDocument saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Events\Model\Entity\EventDocument[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Events\Model\Entity\EventDocument[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Events\Model\Entity\EventDocument[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Events\Model\Entity\EventDocument[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EventDocumentsTable extends Table
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
        $this->_dir = 'webroot' . DS . 'img' . DS . 'uploads' . DS . \Cake\Core\Configure::read('LISTING_ID') . DS . 'Events' . DS . 'gallery' . DS;
        $this->setTable('event_documents');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Events', [
            'foreignKey' => 'event_id',
            'joinType' => 'INNER',
            'className' => 'Events.Events',
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
            ->requirePresence('file_type', 'create')
            ->notEmptyFile('file_type');

        $validator
            ->scalar('title')
            ->maxLength('title', 150)
            ->allowEmptyString('title');

        $validator
            ->scalar('caption')
            ->maxLength('caption', 400)
            ->allowEmptyString('caption');

        $validator
            ->scalar('banner')
            ->maxLength('banner', 250)
            ->notEmptyString('banner');

       
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
        $rules->add($rules->existsIn(['event_id'], 'Events'));

        return $rules;
    }

    public function beforeMarshal(\Cake\Event\Event $event, \ArrayObject $data)
    {
        if(!empty($data['banner'])){
            $data['banner_dir'] = $this->_dir;
        }
    }

    public function afterSave(\Cake\Event\EventInterface $event, \Cake\Datasource\EntityInterface $entity, \ArrayObject $options) {
        if ($entity->get('banner')) {
            $folder = new Folder(WWW_ROOT);
             $uploadPath = str_replace("\\", "/", str_replace("webroot\\","", str_replace("webroot/","",$this->_dir . $entity->event_id)));
            $folder->create(WWW_ROOT . $uploadPath);
            $file = new File(WWW_ROOT . "img" . DS . "tmp" . DS . $entity->get('banner'), false, 0755);
            if ($file->exists()) {
                $file->copy($folder->path . $uploadPath . DS . $file->name, true);
                $file->delete();
            }
        } 
    }
    
    public function afterDelete(\Cake\Event\EventInterface $event, \Cake\Datasource\EntityInterface $entity, \ArrayObject $options) {
        if ($entity->get('banner')) {
            //$uploadPath = $this->_dir . $entity->event_id;
            $uploadPath = str_replace("\\", "/", str_replace("webroot\\","", str_replace("webroot/","",$this->_dir . $entity->event_id)));
            $file = new File($uploadPath . DS . $entity->get('banner'), false, 0755);
            if ($file->exists()) {
                $file->delete();
            }
        } 
    }
}

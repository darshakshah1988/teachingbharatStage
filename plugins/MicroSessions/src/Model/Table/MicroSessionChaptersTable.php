<?php
declare(strict_types=1);

namespace MicroSessions\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MicroSessionChapters Model
 *
 * @property \MicroSessions\Model\Table\MicroSessionsTable&\Cake\ORM\Association\BelongsTo $MicroSessions
 *
 * @method \MicroSessions\Model\Entity\MicroSessionChapter newEmptyEntity()
 * @method \MicroSessions\Model\Entity\MicroSessionChapter newEntity(array $data, array $options = [])
 * @method \MicroSessions\Model\Entity\MicroSessionChapter[] newEntities(array $data, array $options = [])
 * @method \MicroSessions\Model\Entity\MicroSessionChapter get($primaryKey, $options = [])
 * @method \MicroSessions\Model\Entity\MicroSessionChapter findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \MicroSessions\Model\Entity\MicroSessionChapter patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \MicroSessions\Model\Entity\MicroSessionChapter[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \MicroSessions\Model\Entity\MicroSessionChapter|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MicroSessions\Model\Entity\MicroSessionChapter saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MicroSessions\Model\Entity\MicroSessionChapter[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \MicroSessions\Model\Entity\MicroSessionChapter[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \MicroSessions\Model\Entity\MicroSessionChapter[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \MicroSessions\Model\Entity\MicroSessionChapter[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MicroSessionChaptersTable extends Table
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

        $this->setTable('micro_session_chapters');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MicroSessions', [
            'foreignKey' => 'micro_session_id',
            'joinType' => 'INNER',
            'className' => 'MicroSessions.MicroSessions',
        ]);

        $this->addBehavior('ADmad/Sequence.Sequence', [
            'startAt' => 1, // Initial value for sequence. Default 1.
        ]);
         $this->addBehavior('Josegonzalez/Upload.Upload', [
             'chapter_file' => [
                 'fields' => [
                     'dir' => 'chapter_file_dir', // defaults to `dir`
                     'size' => 'chapter_file_size', // defaults to `size`
                     'type' => 'chapter_file_type', // defaults to `type`
                 ],
                 'nameCallback' => function ($table, $entity, $data, $field, $settings) {
                     $ext = pathinfo($data->getClientFilename(), PATHINFO_EXTENSION);
                     return rand(100000,999999).time().rand(10000 , 99999).".".$ext;
                     //return strtolower(str_replace(" ","",$data['name']));
                 },
                 'path' => 'webroot' . DS . 'img' . DS . 'uploads' . DS .'{model}{DS}{field}{DS}',
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
            ->scalar('start_date')
            ->maxLength('start_date', 80)
            ->requirePresence('start_date', 'create')
            ->notEmptyString('start_date');
        $validator
            ->scalar('start_time')
            ->maxLength('start_time', 80)
            ->requirePresence('start_time', 'create')
            ->notEmptyString('start_time');

        $validator
            ->scalar('end_date')
            ->maxLength('end_date', 80)
            ->requirePresence('end_date', 'create')
            ->notEmptyString('end_date');
        $validator
            ->scalar('end_time')
            ->maxLength('end_time', 80)
            ->requirePresence('end_time', 'create')
            ->notEmptyString('end_time');    

        $validator
            ->scalar('title')
            ->maxLength('title', 80)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        // $validator
        //     ->scalar('video_url')
        //     ->maxLength('video_url', 250)
        //     ->requirePresence('video_url', 'create')
        //     ->notEmptyString('video_url');

        // $validator->add('chapter_file', 'file', [
        //     'rule' => ['mimeType', ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.oasis.opendocument.text']],
        //     'on' => function ($context) {
        //        // dd($context['data']['chapter_file']);
        //         return !empty($context['data']['chapter_file']) && $context['data']['chapter_file']->getError() == UPLOAD_ERR_OK;
        //     },
        //     'message' => 'File is not valid! please use valid format e.g PDF, DOC, DOCX',
        //     'last' => true,
        // ]);

        // $validator
        //     ->scalar('chapter_file_dir')
        //     ->maxLength('chapter_file_dir', 255)
        //     ->allowEmptyFile('chapter_file_dir');

        // $validator
        //     ->integer('chapter_file_size')
        //     ->allowEmptyFile('chapter_file_size');

        // $validator
        //     ->scalar('chapter_file_type')
        //     ->maxLength('chapter_file_type', 50)
        //     ->allowEmptyFile('chapter_file_type');

        // $validator
        //     ->scalar('short_description')
        //     ->maxLength('short_description', 400)
        //     ->allowEmptyString('short_description');

        // $validator
        //     ->scalar('description')
        //     ->allowEmptyString('description');

        // $validator
        //     ->integer('position')
        //     ->requirePresence('position', 'create')
        //     ->notEmptyString('position');

       // $validator
       //     ->boolean('is_free')
       //     ->requirePresence('is_free', 'create')
       //     ->notEmptyString('is_free');

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
        $rules->add($rules->existsIn(['micro_session_id'], 'MicroSessions'), ['errorField' => 'micro_session_id']);

        return $rules;
    }
}

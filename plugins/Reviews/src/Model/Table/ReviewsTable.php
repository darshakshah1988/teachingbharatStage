<?php
declare(strict_types=1);

namespace Reviews\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Reviews Model
 *
 * @property \UserManager\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \Courses\Model\Table\CoursesTable&\Cake\ORM\Association\BelongsTo $Courses
 *
 * @method \Reviews\Model\Entity\Review newEmptyEntity()
 * @method \Reviews\Model\Entity\Review newEntity(array $data, array $options = [])
 * @method \Reviews\Model\Entity\Review[] newEntities(array $data, array $options = [])
 * @method \Reviews\Model\Entity\Review get($primaryKey, $options = [])
 * @method \Reviews\Model\Entity\Review findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Reviews\Model\Entity\Review patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Reviews\Model\Entity\Review[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Reviews\Model\Entity\Review|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Reviews\Model\Entity\Review saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Reviews\Model\Entity\Review[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Reviews\Model\Entity\Review[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Reviews\Model\Entity\Review[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Reviews\Model\Entity\Review[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReviewsTable extends Table
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

        $this->setTable('reviews');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT',
            'className' => 'UserManager.Users',
        ]);
        $this->belongsTo('Courses', [
            'foreignKey' => 'course_id',
            'joinType' => 'LEFT',
            'className' => 'Courses.Courses',
        ]);

        $this->belongsTo('Courses', [
            'foreignKey' => 'course_id',
            'joinType' => 'LEFT',
            'className' => 'Courses.Courses',
        ]);

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'photo' => [
                'fields' => [
                    'dir' => 'photo_dir', // defaults to `dir`
                    'size' => 'photo_size', // defaults to `size`
                    'type' => 'photo_type', // defaults to `type`
                ],
                'nameCallback' => function ($table, $entity, $data, $field, $settings) {
                    $ext = pathinfo($data->getClientFilename(), PATHINFO_EXTENSION);
                    return rand(100000,999999).time().rand(10000 , 99999).".".$ext;
                    //return strtolower(str_replace(" ","",$data['name']));
                },
                'path' => 'webroot' . DS . 'img' . DS . 'uploads' . DS .'{DS}{model}{DS}{field}{DS}',
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('rating')
            ->requirePresence('rating', 'create')
            ->notEmptyString('rating');

        $validator
            ->scalar('description')
            ->maxLength('description', 500)
            ->notEmptyString('description');


        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

         $validator
         ->add('photo', 'file', [
            'rule' => ['uploadedFile', ['optional' => true]],
        ])
         ->add('photo', 'file', [
                'rule' => ['mimeType', ['image/jpeg', 'image/png', 'image/gif']],
                'on' => function ($context) {
                    //dd($context['data']['photo']);
                    return !empty($context['data']['photo']) && $context['data']['photo']->getError() == UPLOAD_ERR_OK;
                },
                'message' => 'Photo is not valid! please use valid format e.g JPG, PNG',
                'last' => true,
            ]);

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
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['course_id'], 'Courses'), ['errorField' => 'course_id']);

        return $rules;
    }

    /**
     * This filters function is a 'finder' to used for get roles according listing domain
     *
     * @param \Cake\ORM\Query; $query The rules object to be modified.
     * @param type $options Options Array
     * @return \Cake\ORM\Query
     */
    public function findType(Query $query, array $options)
    {
        return $query->where(['Reviews.review_type' => $options['type']]);
    }
}

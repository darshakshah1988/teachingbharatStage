<?php
declare(strict_types=1);

namespace MicroSessions\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MicroSessions Model
 *
 * @property \MicroSessions\Model\Table\ListingsTable&\Cake\ORM\Association\BelongsTo $Listings
 * @property \MicroSessions\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \MicroSessions\Model\Table\MicroSessionsTable&\Cake\ORM\Association\BelongsTo $ParentMicroSessions
 * @property \MicroSessions\Model\Table\GradingTypesTable&\Cake\ORM\Association\BelongsTo $GradingTypes
 * @property \MicroSessions\Model\Table\AcademicYearsTable&\Cake\ORM\Association\BelongsTo $AcademicYears
 * @property \MicroSessions\Model\Table\BoardsTable&\Cake\ORM\Association\BelongsTo $Boards
 * @property \MicroSessions\Model\Table\SubjectsTable&\Cake\ORM\Association\BelongsTo $Subjects
 * @property \MicroSessions\Model\Table\MicroSessionsTable&\Cake\ORM\Association\HasMany $ChildMicroSessions
 * @property \MicroSessions\Model\Table\PhinxlogTable&\Cake\ORM\Association\BelongsToMany $Phinxlog
 *
 * @method \MicroSessions\Model\Entity\MicroSession newEmptyEntity()
 * @method \MicroSessions\Model\Entity\MicroSession newEntity(array $data, array $options = [])
 * @method \MicroSessions\Model\Entity\MicroSession[] newEntities(array $data, array $options = [])
 * @method \MicroSessions\Model\Entity\MicroSession get($primaryKey, $options = [])
 * @method \MicroSessions\Model\Entity\MicroSession findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \MicroSessions\Model\Entity\MicroSession patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \MicroSessions\Model\Entity\MicroSession[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \MicroSessions\Model\Entity\MicroSession|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MicroSessions\Model\Entity\MicroSession saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MicroSessions\Model\Entity\MicroSession[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \MicroSessions\Model\Entity\MicroSession[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \MicroSessions\Model\Entity\MicroSession[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \MicroSessions\Model\Entity\MicroSession[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class MicroSessionsTable extends Table
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

        $this->setTable('micro_sessions');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree');

        $this->belongsTo('Listings', [
            'foreignKey' => 'listing_id',
            'joinType' => 'INNER',
            'className' => 'MicroSessions.Listings',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'MicroSessions.Users',
        ]);
         $this->hasOne('UserProfiles', [
            'foreignKey' => 'user_id',
            'joinType' => "LEFT",
            'className' => 'UserManager.UserProfiles',
        ]);
        $this->hasMany('MicroSessionChapters', [
            'foreignKey' => 'micro_session_id',
            'className' => 'MicroSessions.MicroSessionChapters',
        ]);
        $this->belongsTo('ParentMicroSessions', [
            'className' => 'MicroSessions.MicroSessions',
            'foreignKey' => 'parent_id',
        ]);
        $this->belongsTo('GradingTypes', [
            'foreignKey' => 'grading_type_id',
            'joinType' => 'LEFT',
            'className' => 'MicroSessions.GradingTypes',
        ]);
        $this->belongsTo('AcademicYears', [
            'foreignKey' => 'academic_year_id',
            'joinType' => 'INNER',
            'className' => 'MicroSessions.AcademicYears',
        ]);
        $this->belongsTo('Boards', [
            'foreignKey' => 'board_id',
            'joinType' => 'LEFT',
            'className' => 'MicroSessions.Boards',
        ]);
        $this->belongsTo('Subjects', [
            'foreignKey' => 'subject_id',
            'joinType' => 'LEFT',
            'className' => 'MicroSessions.Subjects',
        ]);

         $this->hasOne('Reviews', [
            'foreignKey' => 'user_id',
            'joinType' => "LEFT",
            'className' => 'Reviews.Reviews',
        ]);

        // $this->hasMany('Reviews', [
        //     'className' => 'Reviews.Reviews',
        //     'foreignKey' => 'course_id',
        //     'conditions' => ['Reviews.review_type' => 'course'],
        // ]);

// added satendra
        $this->belongsTo('Packages', [
            'foreignKey' => 'package_id',
            'joinType' => 'LEFT',
            'className' => 'MicroSessions.Packages',
        ]);

        $this->belongsTo('Plans', [
            'foreignKey' => 'plan_id',
            'joinType' => 'LEFT',
            'className' => 'MicroSessions.Plans',
        ]);

        $this->hasMany('Carts', [
            'className' => 'Orders.Carts',
            'foreignKey' => 'micro_session_id',
        ]);

        $this->hasMany('OrderCourses', [
            'className' => 'MicroSessions.OrderCourses',
            'foreignKey' => 'micro_session_id',
        ]);

        $this->hasMany('Carts', [
            'className' => 'MicroSessions.Carts',
            'foreignKey' => 'course_id',
        ]);
// end

        $this->hasMany('ChildMicroSessions', [
            'className' => 'MicroSessions.MicroSessions',
            'foreignKey' => 'parent_id',
        ]);
        // $this->belongsToMany('Phinxlog', [
        //     'foreignKey' => 'micro_session_id',
        //     'targetForeignKey' => 'phinxlog_id',
        //     'joinTable' => 'micro_sessions_phinxlog',
        //     'className' => 'MicroSessions.Phinxlog',
        // ]);
		 $this->addBehavior('Muffin/Slug.Slug', [
            'unique' => true,
            'onUpdate' => false,
            'onDirty' => true
        ]);

         $this->addBehavior('Josegonzalez/Upload.Upload', [
            'microsession_file' => [
                'fields' => [
                    'dir' => 'microsession_file_dir', // defaults to `dir`
                    'size' => 'microsession_file_size', // defaults to `size`
                    'type' => 'microsession_file_type', // defaults to `type`
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

        /*$validator
            ->scalar('slug')
            ->maxLength('slug', 250)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug');*/

        $validator
            ->scalar('title')
            ->maxLength('title', 250)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('board_id')
            ->requirePresence('board_id', 'create')
            ->notEmptyString('board_id');
        $validator
            ->scalar('grading_type_id')
            ->requirePresence('grading_type_id', 'create')
            ->notEmptyString('grading_type_id');
        $validator
            ->scalar('subject_id')
            ->requirePresence('subject_id', 'create')
            ->notEmptyString('subject_id');


        $validator
            ->scalar('duration')
            ->requirePresence('duration', 'create')
            ->notEmptyString('duration');

        $validator
            ->decimal('price')
            ->notEmptyString('price');

        $validator
            ->decimal('discount_price')
            ->allowEmptyString('discount_price');

        $validator
            ->scalar('short_description')
//maxLength('short_description', 400)
            ->notEmptyString('short_description');

         $validator
             ->scalar('description')
             //->maxLength('description', 255)
             ->notEmptyString('description');



        // $validator
        //     ->date('start_date')
        //     ->requirePresence('start_date', 'create')
        //     ->notEmptyDate('start_date');

        // $validator
        //     ->date('end_date')
        //     ->requirePresence('end_date', 'create')
        //     ->notEmptyDate('end_date');

         $validator
            ->boolean('monday')
            ->requirePresence('monday', 'create')
            ->notEmptyString('monday');
         $validator
            ->boolean('tuesday')
            ->requirePresence('tuesday', 'create')
            ->notEmptyString('tuesday');
        $validator
            ->boolean('wednesday')
            ->requirePresence('wednesday', 'create')
            ->notEmptyString('wednesday');
            $validator
            ->boolean('thursday')
            ->requirePresence('thursday', 'create')
            ->notEmptyString('thursday');
            $validator
            ->boolean('friday')
            ->requirePresence('friday', 'create')
            ->notEmptyString('friday');

            $validator
            ->boolean('saturday')
            ->requirePresence('saturday', 'create')
            ->notEmptyString('saturday');
        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status');



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
    $rules->add($rules->existsIn(['listing_id'], 'Listings'), ['errorField' => 'listing_id']);
    $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
    $rules->add($rules->existsIn(['grading_type_id'], 'GradingTypes'), ['errorField' => 'grading_type_id']);
    $rules->add($rules->existsIn(['board_id'], 'Boards'), ['errorField' => 'board_id']);
    $rules->add($rules->existsIn(['subject_id'], 'Subjects'), ['errorField' => 'subject_id']);
   // $rules->add($rules->existsIn(['package_id'], 'Packages'), ['errorField' => 'package_id']);
  //  $rules->add($rules->existsIn(['plan_id'], 'Plans'), ['errorField' => 'plan_id']);
    return $rules;
    }


	// Added this method by satendra


	public function findBoard(Query $query, array $options)
    {
        if (isset($options['boards']) && !empty($options['boards'])) {
            if(is_array($options['boards'])){
                $query->where(function ($exp, $q) use($options){
                    return $exp->in('MicroSessions.board_id', $options['boards']);
                });
            }else{
                $query->where(['MicroSessions.board_id' => $options['boards']]);
            }
        }
        return $query;
    }

    public function findGrad(Query $query, array $options)
    {
        if (isset($options['grads']) && !empty($options['grads'])) {
            if(is_array($options['grads'])){
                $query->where(function ($exp, $q) use($options){
                    return $exp->in('MicroSessions.grading_type_id', $options['grads']);
                });
            }else{
                $query->where(['MicroSessions.grading_type_id' => $options['grads']]);
            }
        }
        return $query;
    }


    public function findSubject(Query $query, array $options)
    {
        if (isset($options['subjects']) && !empty($options['subjects'])) {
            if(is_array($options['subjects'])){
                $query->where(function ($exp, $q) use($options){
                    return $exp->in('MicroSessions.subject_id', $options['subjects']);
                });
            }else{
                $query->where(['MicroSessions.subject_id' => $options['subjects']]);
            }
        }
        return $query;
    }


    // added satendra for display plan

    public function findPackage(Query $query, array $options)
    {
        if (isset($options['packages']) && !empty($options['packages'])) {
            if(is_array($options['packages'])){
                $query->where(function ($exp, $q) use($options){
                    return $exp->in('MicroSessions.package_id', $options['packages']);
                });
            }else{
                $query->where(['MicroSessions.package_id' => $options['packages']]);
            }
        }
        return $query;
    }

    public function findPlan(Query $query, array $options)
    {
        if (isset($options['plans']) && !empty($options['plans'])) {
            if(is_array($options['plans'])){
                $query->where(function ($exp, $q) use($options){
                    return $exp->in('MicroSessions.plan_id', $options['plans']);
                });
            }else{
                $query->where(['MicroSessions.plan_id' => $options['plans']]);
            }
        }


        return $query;
    }

}

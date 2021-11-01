<?php
declare(strict_types=1);

namespace Courses\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Courses Model
 *
 * @property \Courses\Model\Table\ListingsTable&\Cake\ORM\Association\BelongsTo $Listings
 * @property \Courses\Model\Table\CoursesTable&\Cake\ORM\Association\BelongsTo $ParentCourses
 * @property \Courses\Model\Table\GradingTypesTable&\Cake\ORM\Association\BelongsTo $GradingTypes
 * @property \Courses\Model\Table\BoardsTable&\Cake\ORM\Association\BelongsTo $Boards
 * @property \Courses\Model\Table\SubjectsTable&\Cake\ORM\Association\BelongsTo $Subjects
 * @property \Courses\Model\Table\CourseChaptersTable&\Cake\ORM\Association\HasMany $CourseChapters
 * @property \Courses\Model\Table\CoursesTable&\Cake\ORM\Association\HasMany $ChildCourses
 * @property \Courses\Model\Table\SubjectsTable&\Cake\ORM\Association\HasMany $Subjects
 * @property \Courses\Model\Table\PhinxlogTable&\Cake\ORM\Association\BelongsToMany $Phinxlog
 *
 * @method \Courses\Model\Entity\Course newEmptyEntity()
 * @method \Courses\Model\Entity\Course newEntity(array $data, array $options = [])
 * @method \Courses\Model\Entity\Course[] newEntities(array $data, array $options = [])
 * @method \Courses\Model\Entity\Course get($primaryKey, $options = [])
 * @method \Courses\Model\Entity\Course findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Courses\Model\Entity\Course patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Courses\Model\Entity\Course[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Courses\Model\Entity\Course|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Courses\Model\Entity\Course saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Courses\Model\Entity\Course[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Courses\Model\Entity\Course[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Courses\Model\Entity\Course[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Courses\Model\Entity\Course[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class CoursesTable extends Table
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

        $this->setTable('courses');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree');
        $this->addBehavior('Listable');


       $this->belongsTo('Listings', [
            'foreignKey' => 'listing_id',
            'joinType' => 'LEFT',
            'className' => 'Listings.Listings',
        ]);
        $this->belongsTo('ParentCourses', [
            'className' => 'Courses.Courses',
            'foreignKey' => 'parent_id',
        ]);

        $this->belongsTo('Users', [
            'className' => 'UserManager.Users',
            'foreignKey' => 'user_id',
        ]);

        $this->belongsTo('GradingTypes', [
            'foreignKey' => 'grading_type_id',
            'joinType' => 'LEFT',
            'className' => 'Courses.GradingTypes',
        ]);
        $this->belongsTo('Boards', [
            'foreignKey' => 'board_id',
            'joinType' => 'LEFT',
            'className' => 'Courses.Boards',
        ]);
        $this->belongsTo('Subjects', [
            'foreignKey' => 'subject_id',
            'joinType' => 'LEFT',
            'className' => 'Courses.Subjects',
        ]);
        $this->hasMany('CourseChapters', [
            'foreignKey' => 'course_id',
            'className' => 'Courses.CourseChapters',
        ]);
        $this->hasMany('ChildCourses', [
            'className' => 'Courses.Courses',
            'foreignKey' => 'parent_id',
        ]);

        $this->hasMany('CourseWatchings', [
            'className' => 'Courses.CourseWatchings',
            'foreignKey' => 'course_id',
        ]);

        $this->hasMany('OrderCourses', [
            'className' => 'Courses.OrderCourses',
            'foreignKey' => 'course_id',
        ]);

        $this->hasMany('Carts', [
            'className' => 'Orders.Carts',
            'foreignKey' => 'course_id',
        ]);

        $this->hasMany('Reviews', [
            'className' => 'Reviews.Reviews',
            'foreignKey' => 'course_id',
            'conditions' => ['Reviews.review_type' => 'course'],
        ]);

        $this->hasMany('SessionReviews', [
            'className' => 'Reviews.Reviews',
            'foreignKey' => 'course_id',
            'conditions' => ['SessionReviews.review_type' => 'session'],
        ]);
		$this->hasMany('Meetings', [
            'foreignKey' => 'course_id',
            'joinType' => 'INNER',
            'className' => 'Sessions.Meetings' ,
        ]);

        // $this->hasMany('Subjects', [
        //     'foreignKey' => 'course_id',
        //     'className' => 'Courses.Subjects',
        // ]);

        $this->addBehavior('Muffin/Slug.Slug', [
            'unique' => true,
            'onUpdate' => false,
            'onDirty' => true
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
            ->maxLength('title', 250)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->requirePresence('grading_type_id', 'create')
            ->notEmptyString('grading_type_id');

        $validator
            ->requirePresence('board_id', 'create')
            ->notEmptyString('board_id');
            
        $validator
            ->requirePresence('subject_id', 'create')
            ->notEmptyString('subject_id');            

        $validator
            ->boolean('status')
            ->allowEmptyString('status');

        $validator
            ->scalar('duration')
            ->maxLength('duration', 255)
            ->notEmptyString('duration');

        $validator
            ->decimal('price')
            ->notEmptyString('price');

        $validator
            ->decimal('discount_price')
            ->allowEmptyString('discount_price');

        $validator
            ->boolean('is_free')
            ->requirePresence('is_free', 'create')
            ->notEmptyString('is_free');

        $validator
            ->scalar('sample_video')
            ->maxLength('sample_video', 250)
            ->allowEmptyString('sample_video');

        $validator
            ->scalar('short_description')
            ->maxLength('short_description', 400)
            ->allowEmptyString('short_description');

        $validator
            ->scalar('description')
            ->notEmptyString('description');
			
		$validator
            ->integer('no_of_seats')
            ->notEmptyString('no_of_seats');
        return $validator;
    } 

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationSession(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 250)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->requirePresence('grading_type_id', 'create')
            ->notEmptyString('grading_type_id');

        $validator
            ->requirePresence('board_id', 'create')
            ->notEmptyString('board_id');
            
        $validator
            ->requirePresence('subject_id', 'create')
            ->notEmptyString('subject_id');   

        $validator
            ->notEmptyDateTime('start_date', 'Session Date cannot be left empty');                

        $validator
            ->boolean('status')
            ->allowEmptyString('status');


        $validator
            ->scalar('short_description')
            ->maxLength('short_description', 400)
            ->allowEmptyString('short_description');

        $validator
            ->scalar('description')
            ->notEmptyString('description');
		$validator
            ->integer('no_of_seats')
            ->notEmptyString('no_of_seats');
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
        $rules->add($rules->existsIn(['parent_id'], 'ParentCourses'), ['errorField' => 'parent_id']);
        $rules->add($rules->existsIn(['grading_type_id'], 'GradingTypes'), ['errorField' => 'grading_type_id']);
        $rules->add($rules->existsIn(['board_id'], 'Boards'), ['errorField' => 'board_id']);
        $rules->add($rules->existsIn(['subject_id'], 'Subjects'), ['errorField' => 'subject_id']);

        return $rules;
    }

    /*
     * Finder listId
     * get listing id according to domain url
     */
    public function findParentdomain(Query $query, array $options)
    {
        return $query->where(['ParentCourses.listing_id' => \Cake\Core\Configure::read('LISTING_ID')]);
    }

    /*
     * Finder listId
     * get listing id according to domain url
     */
    public function findSession(Query $query, array $options)
    {
        return $query->where(['Courses.course_type' => 1]);
    }


    /*
     * Finder Duration
     * get listing id according to domain url
     */
    public function findDuration(Query $query, array $options)
    {
        if(isset($options['type']) && $options['type'] == "live"){

            $query->where([
                        'Courses.start_date <=' => date('Y-m-d H:i:s'),
                        'Courses.end_date >=' => date('Y-m-d H:i:s'),
                ]);

        }else if(isset($options['type']) && $options['type'] == "upcoming"){
            //dd(date('Y-m-d H:i:s'));
            $query->where(['Courses.start_date >' => date('Y-m-d H:i:s')]);
            
        }else if(isset($options['type']) && $options['type'] == "past"){

            $query->where(['Courses.end_date <' => date('Y-m-d H:i:s')]);
            
        }
        return $query;
    }

    /*
     * Finder listId
     * get listing id according to domain url
     */
    public function findCourse(Query $query, array $options)
    {
        return $query->where(function ($exp, $q) {
                return $exp->or_([
                        'Courses.course_type IS' => null,
                        'Courses.course_type' => 0,
                ]);
            });
    }

    /*
     * Finder Domain
     * get listing id according to domain url
     */
    public function findDomain(Query $query, array $options)
    {
        return $query->where(['Courses.listing_id' => \Cake\Core\Configure::read('LISTING_ID')]);
    }

    public function findFilter(Query $query, array $options)
    {
        if (isset($options['keyword']) && !empty($options['keyword'])) {
            $query->where(function ($exp, $q) use($options) {
                return $exp->or_([
                        'Courses.title LIKE' => '%' . trim($options['keyword']) . '%',
                        'Courses.section_name LIKE' => '%' . trim($options['keyword']) . '%',
                        'Courses.code LIKE' => '%' . trim($options['keyword']) . '%',
                       // 'UsersProfile.mobile LIKE' => '%' . trim($options['keyword']) . '%',
                       // 'UsersProfile.alt_mobile LIKE' => '%' . trim($options['keyword']) . '%',
                ]);
            });
        }
       
        return $query;
    }

    public function findBoard(Query $query, array $options)
    {
        if (isset($options['boards']) && !empty($options['boards'])) {
            if(is_array($options['boards'])){
                $query->where(function ($exp, $q) use($options){
                    return $exp->in('Courses.board_id', $options['boards']);
                });
            }else{
                $query->where(['Courses.board_id' => $options['boards']]);
            }
        }
        return $query;
    }

    public function findGrad(Query $query, array $options)
    {
        if (isset($options['grads']) && !empty($options['grads'])) {
            if(is_array($options['grads'])){
                $query->where(function ($exp, $q) use($options){
                    return $exp->in('Courses.grading_type_id', $options['grads']);
                });
            }else{
                $query->where(['Courses.grading_type_id' => $options['grads']]);
            }
        }
        return $query;
    }


    public function findSubject(Query $query, array $options)
    {
        if (isset($options['subjects']) && !empty($options['subjects'])) {
            if(is_array($options['subjects'])){
                $query->where(function ($exp, $q) use($options){
                    return $exp->in('Courses.subject_id', $options['subjects']);
                });
            }else{
                $query->where(['Courses.subject_id' => $options['subjects']]);
            }
        }
        return $query;
    }
}

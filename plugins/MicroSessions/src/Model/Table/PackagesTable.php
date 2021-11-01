<?php
declare(strict_types=1);

namespace MicroSessions\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Packages Model
 *
 * @property \MicroSessions\Model\Table\PackagesTable&\Cake\ORM\Association\BelongsTo $Packages
 * @property \MicroSessions\Model\Table\ListingsTable&\Cake\ORM\Association\BelongsTo $Listings
 * @property \MicroSessions\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \MicroSessions\Model\Table\GradingTypesTable&\Cake\ORM\Association\BelongsTo $GradingTypes
 * @property \MicroSessions\Model\Table\BoardsTable&\Cake\ORM\Association\BelongsTo $Boards
 * @property \MicroSessions\Model\Table\SubjectsTable&\Cake\ORM\Association\BelongsTo $Subjects
 * @property \MicroSessions\Model\Table\PackagesTable&\Cake\ORM\Association\HasMany $Packages
 *
 * @method \MicroSessions\Model\Entity\Package newEmptyEntity()
 * @method \MicroSessions\Model\Entity\Package newEntity(array $data, array $options = [])
 * @method \MicroSessions\Model\Entity\Package[] newEntities(array $data, array $options = [])
 * @method \MicroSessions\Model\Entity\Package get($primaryKey, $options = [])
 * @method \MicroSessions\Model\Entity\Package findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \MicroSessions\Model\Entity\Package patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \MicroSessions\Model\Entity\Package[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \MicroSessions\Model\Entity\Package|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MicroSessions\Model\Entity\Package saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MicroSessions\Model\Entity\Package[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \MicroSessions\Model\Entity\Package[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \MicroSessions\Model\Entity\Package[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \MicroSessions\Model\Entity\Package[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PackagesTable extends Table
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

        $this->setTable('packages');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        

        $this->belongsTo('Packages', [
            'foreignKey' => 'package_id',
            'joinType' => 'INNER',
            'className' => 'MicroSessions.Packages',
        ]);
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
        $this->belongsTo('GradingTypes', [
            'foreignKey' => 'grading_type_id',
            'joinType' => 'INNER',
            'className' => 'MicroSessions.GradingTypes',
        ]);
        $this->belongsTo('Boards', [
            'foreignKey' => 'board_id',
            'joinType' => 'INNER',
            'className' => 'MicroSessions.Boards',
        ]);
        $this->belongsTo('Subjects', [
            'foreignKey' => 'subject_id',
            'joinType' => 'INNER',
            'className' => 'MicroSessions.Subjects',
        ]);
        $this->hasMany('Packages', [
            'foreignKey' => 'package_id',
            'className' => 'MicroSessions.Packages',
        ]);

// package background image code
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'package_file' => [
                'fields' => [
                    'dir' => 'package_file_dir', // defaults to `dir`
                    'size' => 'package_file_size', // defaults to `size`
                    'type' => 'package_file_type', // defaults to `type`
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
            ->scalar('package_name')
            ->maxLength('package_name', 256)
            ->requirePresence('package_name', 'create')
            ->notEmptyString('package_name');

        // $validator
        //     ->scalar('package_title')
        //     ->maxLength('package_title', 256)
        //     ->requirePresence('package_title', 'create')
        //     ->notEmptyString('package_title');
			 
			
			
        // $validator
        //     ->scalar('short_description')
        //     ->maxLength('short_description', 400)
        //     ->allowEmptyString('short_description');

        // $validator
        //     ->scalar('description')
        //     ->maxLength('description', 5055)
        //     ->allowEmptyString('description');

        $validator
            ->scalar('about')
            //->maxLength('about', 5055)
            ->allowEmptyString('about');
        $validator
            ->scalar('what_included')
            //->maxLength('what_included', 5055)
            ->allowEmptyString('what_included');       
        
        $validator
            ->scalar('what_best')
            //->maxLength('what_best', 5055)
            ->allowEmptyString('what_best');   

        $validator
            ->scalar('faq')
            //->maxLength('faq', 5055)
            ->allowEmptyString('faq');   

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
        //$rules->add($rules->existsIn(['package_id'], 'Packages'), ['errorField' => 'package_id']);
        $rules->add($rules->existsIn(['listing_id'], 'Listings'), ['errorField' => 'listing_id']);
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['grading_type_id'], 'GradingTypes'), ['errorField' => 'grading_type_id']);
        $rules->add($rules->existsIn(['board_id'], 'Boards'), ['errorField' => 'board_id']);
       // $rules->add($rules->existsIn(['subject_id'], 'Subjects'), ['errorField' => 'subject_id']);

        return $rules;
    }
}

<?php
declare(strict_types=1);

namespace Testimonials\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Testimonials Model
 *
 * @property \Testimonials\Model\Table\ListingsTable&\Cake\ORM\Association\BelongsTo $Listings
 * @property \Testimonials\Model\Table\PhinxlogTable&\Cake\ORM\Association\BelongsToMany $Phinxlog
 *
 * @method \Testimonials\Model\Entity\Testimonial newEmptyEntity()
 * @method \Testimonials\Model\Entity\Testimonial newEntity(array $data, array $options = [])
 * @method \Testimonials\Model\Entity\Testimonial[] newEntities(array $data, array $options = [])
 * @method \Testimonials\Model\Entity\Testimonial get($primaryKey, $options = [])
 * @method \Testimonials\Model\Entity\Testimonial findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Testimonials\Model\Entity\Testimonial patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Testimonials\Model\Entity\Testimonial[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Testimonials\Model\Entity\Testimonial|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Testimonials\Model\Entity\Testimonial saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Testimonials\Model\Entity\Testimonial[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Testimonials\Model\Entity\Testimonial[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Testimonials\Model\Entity\Testimonial[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Testimonials\Model\Entity\Testimonial[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TestimonialsTable extends Table
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

        $this->setTable('testimonials');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Listable');

        $this->belongsTo('Listings', [
            'foreignKey' => 'listing_id',
            'joinType' => 'INNER',
            'className' => 'Testimonials.Listings',
        ]);
        $this->belongsToMany('Phinxlog', [
            'foreignKey' => 'testimonial_id',
            'targetForeignKey' => 'phinxlog_id',
            'joinTable' => 'testimonials_phinxlog',
            'className' => 'Testimonials.Phinxlog',
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
            ->maxLength('name', 200)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('designation')
            ->maxLength('designation', 200)
            ->allowEmptyString('designation');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

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
        $rules->add($rules->existsIn(['listing_id'], 'Listings'));

        return $rules;
    }
}

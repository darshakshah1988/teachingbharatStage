<?php
declare(strict_types=1);

namespace Courses\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Boards Model
 *
 * @property \Courses\Model\Table\ListingsTable&\Cake\ORM\Association\BelongsTo $Listings
 *
 * @method \Courses\Model\Entity\Board newEmptyEntity()
 * @method \Courses\Model\Entity\Board newEntity(array $data, array $options = [])
 * @method \Courses\Model\Entity\Board[] newEntities(array $data, array $options = [])
 * @method \Courses\Model\Entity\Board get($primaryKey, $options = [])
 * @method \Courses\Model\Entity\Board findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Courses\Model\Entity\Board patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Courses\Model\Entity\Board[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Courses\Model\Entity\Board|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Courses\Model\Entity\Board saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Courses\Model\Entity\Board[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Courses\Model\Entity\Board[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Courses\Model\Entity\Board[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Courses\Model\Entity\Board[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BoardsTable extends Table
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

        $this->setTable('boards');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Listable');

        $this->belongsTo('Listings', [
            'foreignKey' => 'listing_id',
            'joinType' => 'INNER',
            'className' => 'Courses.Listings',
        ]);

        $this->addBehavior('ADmad/Sequence.Sequence', [
            'startAt' => 1, // Initial value for sequence. Default 1.
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
        $rules->add($rules->existsIn(['listing_id'], 'Listings'), ['errorField' => 'listing_id']);

        return $rules;
    }

    /*
     * Finder Domain
     * get listing id according to domain url
     */
    public function findDomain(Query $query)
    {
        return $query->where(['Boards.listing_id' => \Cake\Core\Configure::read('LISTING_ID')]);
    }
}

<?php
declare(strict_types=1);

namespace Events\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EventSocialLinks Model
 *
 * @property \Events\Model\Table\EventsTable&\Cake\ORM\Association\BelongsTo $Events
 *
 * @method \Events\Model\Entity\EventSocialLink newEmptyEntity()
 * @method \Events\Model\Entity\EventSocialLink newEntity(array $data, array $options = [])
 * @method \Events\Model\Entity\EventSocialLink[] newEntities(array $data, array $options = [])
 * @method \Events\Model\Entity\EventSocialLink get($primaryKey, $options = [])
 * @method \Events\Model\Entity\EventSocialLink findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Events\Model\Entity\EventSocialLink patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Events\Model\Entity\EventSocialLink[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Events\Model\Entity\EventSocialLink|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Events\Model\Entity\EventSocialLink saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Events\Model\Entity\EventSocialLink[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Events\Model\Entity\EventSocialLink[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Events\Model\Entity\EventSocialLink[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Events\Model\Entity\EventSocialLink[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EventSocialLinksTable extends Table
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

        $this->setTable('event_social_links');
        $this->setDisplayField('id');
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
            ->scalar('social_type')
            ->maxLength('social_type', 255)
            ->requirePresence('social_type', 'create')
            ->notEmptyString('social_type');

        $validator
            ->scalar('social_url')
            ->maxLength('social_url', 255)
            ->requirePresence('social_url', 'create')
            ->notEmptyString('social_url');

        $validator
            ->integer('position')
            ->allowEmptyString('position');

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
}

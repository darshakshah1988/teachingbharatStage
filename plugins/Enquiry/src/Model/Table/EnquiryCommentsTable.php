<?php
declare(strict_types=1);

namespace Enquiry\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EnquiryComments Model
 *
 * @property \Enquiry\Model\Table\EnquiriesTable&\Cake\ORM\Association\BelongsTo $Enquiries
 * @property \Enquiry\Model\Table\EnquiryStatusesTable&\Cake\ORM\Association\BelongsTo $EnquiryStatuses
 *
 * @method \Enquiry\Model\Entity\EnquiryComment newEmptyEntity()
 * @method \Enquiry\Model\Entity\EnquiryComment newEntity(array $data, array $options = [])
 * @method \Enquiry\Model\Entity\EnquiryComment[] newEntities(array $data, array $options = [])
 * @method \Enquiry\Model\Entity\EnquiryComment get($primaryKey, $options = [])
 * @method \Enquiry\Model\Entity\EnquiryComment findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Enquiry\Model\Entity\EnquiryComment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Enquiry\Model\Entity\EnquiryComment[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Enquiry\Model\Entity\EnquiryComment|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Enquiry\Model\Entity\EnquiryComment saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Enquiry\Model\Entity\EnquiryComment[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Enquiry\Model\Entity\EnquiryComment[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Enquiry\Model\Entity\EnquiryComment[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Enquiry\Model\Entity\EnquiryComment[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EnquiryCommentsTable extends Table
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

        $this->setTable('enquiry_comments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Enquiries', [
            'foreignKey' => 'enquiry_id',
            'joinType' => 'INNER',
            'className' => 'Enquiry.Enquiries',
        ]);
        $this->belongsTo('EnquiryStatuses', [
            'foreignKey' => 'enquiry_status_id',
            'joinType' => 'INNER',
            'className' => 'Enquiry.EnquiryStatuses',
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
            ->scalar('comment')
            ->requirePresence('comment', 'create')
            ->notEmptyString('comment');
        $validator
                ->add('comment', [
                    'minLength' => [
                        'rule' => ['minLength', 10],
                        'last' => true,
                        'message' => 'Comments must have minimum 10 characters.'
                    ],
                ]);


        $validator
            ->integer('enquiry_status_id')
            ->requirePresence('enquiry_status_id', 'create')
            ->notEmptyString('enquiry_status_id');

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
        $rules->add($rules->existsIn(['enquiry_id'], 'Enquiries'));
        $rules->add($rules->existsIn(['enquiry_status_id'], 'EnquiryStatuses'));

        return $rules;
    }


}

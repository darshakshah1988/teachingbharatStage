<?php
declare(strict_types=1);

namespace Language\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Languages Model
 *
 * @method \Language\Model\Entity\Language newEmptyEntity()
 * @method \Language\Model\Entity\Language newEntity(array $data, array $options = [])
 * @method \Language\Model\Entity\Language[] newEntities(array $data, array $options = [])
 * @method \Language\Model\Entity\Language get($primaryKey, $options = [])
 * @method \Language\Model\Entity\Language findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Language\Model\Entity\Language patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Language\Model\Entity\Language[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Language\Model\Entity\Language|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Language\Model\Entity\Language saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Language\Model\Entity\Language[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Language\Model\Entity\Language[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Language\Model\Entity\Language[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Language\Model\Entity\Language[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LanguagesTable extends Table
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
        $this->_dir = 'webroot' . DS . 'img' . DS . 'uploads' . DS;
        $this->setTable('languages');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior('ADmad/Sequence.Sequence', [
            'startAt' => 1, // Initial value for sequence. Default 1.
        ]);

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'image' => [
                'fields' => [
                    // if these fields or their defaults exist
                    // the values will be set.
                    'dir' => 'image_dir', // defaults to `dir`
                    'size' => 'image_size', // defaults to `size`
                    'type' => 'image_type', // defaults to `type`
                ],
                'nameCallback' => function ($table, $entity, $data, $field, $settings) {
                        $ext = pathinfo($data->getClientFilename(), PATHINFO_EXTENSION);
                        return rand(100000,999999).time().rand(10000 , 99999).".".$ext;
                        //return strtolower(str_replace(" ","",$data['name']));
                },
                'path' => $this->_dir.'{model}{DS}{field}{DS}',
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
            ->scalar('title')
            ->maxLength('title', 50)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('code')
            ->maxLength('code', 5)
            ->allowEmptyString('code');

        $validator
            ->scalar('locale')
            ->maxLength('locale', 100)
            ->allowEmptyString('locale');

        $validator
            ->allowEmptyFile('image');

        $validator
            ->integer('position')
            ->allowEmptyString('position');

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        return $validator;
    }
}

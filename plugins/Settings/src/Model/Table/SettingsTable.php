<?php
declare(strict_types=1);

namespace Settings\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Filesystem\File;
use Cake\Filesystem\Folder;
use Symfony\Component\Yaml\Yaml;
use Cake\Core\Configure;

/**
 * Settings Model
 *
 * @property \Settings\Model\Table\ListingsTable&\Cake\ORM\Association\BelongsTo $Listings
 * @property \Settings\Model\Table\PhinxlogTable&\Cake\ORM\Association\BelongsToMany $Phinxlog
 *
 * @method \Settings\Model\Entity\Setting newEmptyEntity()
 * @method \Settings\Model\Entity\Setting newEntity(array $data, array $options = [])
 * @method \Settings\Model\Entity\Setting[] newEntities(array $data, array $options = [])
 * @method \Settings\Model\Entity\Setting get($primaryKey, $options = [])
 * @method \Settings\Model\Entity\Setting findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Settings\Model\Entity\Setting patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Settings\Model\Entity\Setting[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Settings\Model\Entity\Setting|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Settings\Model\Entity\Setting saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Settings\Model\Entity\Setting[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Settings\Model\Entity\Setting[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Settings\Model\Entity\Setting[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Settings\Model\Entity\Setting[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SettingsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */

    public $_dir;

    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->_dir = 'img' . DS . 'uploads' . DS . \Cake\Core\Configure::read('LISTING_ID') . DS . 'settings' . DS;
        $this->setTable('settings');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        //$this->addBehavior('Listable');

        $this->belongsTo('Listings', [
            'foreignKey' => 'listing_id',
            'joinType' => 'INNER',
            'className' => 'Listings.Listings',
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
            ->maxLength('title', 150)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 255)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug')
            ->add('slug', [
                'chkUnique' => [
                    'rule' => [$this, 'chkUnique'],
                    'message' => 'This Constant/Slug already exists. please try to use another slug.'
        ]]);

        $validator
            ->scalar('config_value')
            ->requirePresence('config_value', 'create')
            ->notEmptyString('config_value');

        $validator
            ->scalar('manager')
            ->maxLength('manager', 50)
            ->requirePresence('manager', 'create')
            ->notEmptyString('manager');

        $validator
            ->scalar('field_type')
            ->maxLength('field_type', 150)
            ->requirePresence('field_type', 'create')
            ->notEmptyString('field_type');

        return $validator;
    }

    /**
     * validation rules for logo & fav icons.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationLogo(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 150)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->maxLength('slug', 255)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug')
            ->add('slug', [
                'chkUnique' => [
                    'rule' => [$this, 'chkUnique'],
                    'message' => 'This Constant/Slug already exists. please try to use another slug.'
        ]]);

        // $validator
        //     ->scalar('config_value')
        //     ->requirePresence('config_value', 'create')
        //     ->notEmptyString('config_value');


        // $validator->add('config_value', 'file', [
        //         'rule' => ['mimeType', ['image/jpeg', 'image/png']],
        //     ]);


        $validator
            ->scalar('manager')
            ->maxLength('manager', 50)
            ->requirePresence('manager', 'create')
            ->notEmptyString('manager');

        $validator
            ->scalar('field_type')
            ->maxLength('field_type', 150)
            ->requirePresence('field_type', 'create')
            ->notEmptyString('field_type');

        return $validator;
    }

    /**
     * Check unique validation for slug
     *
     * @param $value, $context.
     * @return  boolean
     */
    public function chkUnique($value, $context) {
        if(empty(trim($value)))
            return true;
        if($context['newRecord'] != 1){
            $conditions['id !='] = $context['data']['id'];
        }
        $conditions['slug'] = $value;
        $conditions['listing_id'] = $context['data']['listing_id'] ?? \Cake\Core\Configure::read('LISTING_ID'); 
        $chk = $this->find()->where($conditions)->count();
        if ($chk == 0) {
            return true;
        } else {
            return false;
        }
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

    /**
     * before marshal used for trim whitspace for all form element
     *
     * @param Cake\Event\Event; $event .
     * @param type $data Options Array
     * @return \Cake\ORM\Query
     */
    public function beforeMarshal(\Cake\Event\Event $event, \ArrayObject $data) {
        foreach ($data as $key => $value) {
            if (!is_array($value) && $data['manager'] != "logos") {
                $data[$key] = trim($value);
            }
        } 
        if(\Cake\Core\Configure::read('LISTING_ID')){
            $data['listing_id'] = \Cake\Core\Configure::read('LISTING_ID');
        }

    }

     /**
     * beforeSave used for upload images
     *
     * @param Cake\Event\Event; $event .
     * @param type $data Options Array
     * @return \Cake\ORM\Query
     */
    public function beforeSave(\Cake\Event\EventInterface $event, \Cake\Datasource\EntityInterface $entity, \ArrayObject $options) {
        // if ($entity->get('manager') == "logos" && $entity->isDirty('config_value')) {
        //    $value = $entity;
        //    dd($value);
        //    dd($value->getClientFilename());
        // }

    }
    /**
     * afterSave used for setting image uplod on base dir
     *
     * @param Cake\Event\Event; $event .
     * @param type $data Options Array
     * @return \Cake\ORM\Query
     */
    public function afterSave(\Cake\Event\EventInterface $event, \Cake\Datasource\EntityInterface $entity, \ArrayObject $options) {
        if ($entity->manager == "logos") {
            $folder = new Folder(WWW_ROOT, true, 0755);
            $uploadPath = trim($this->_dir, DS);
            $folder->create(WWW_ROOT . $uploadPath, 0777);
            $folder->chmod(WWW_ROOT . $uploadPath, 0777, true);
            $file = new File(WWW_ROOT . "img" . DS . "tmp" . DS . $entity->get('config_value'), false, 0755);
            if ($file->exists()) {
                $file->copy($folder->path . $uploadPath . DS . $file->name, true);
                $file->delete();
                if (!$entity->isNew() && $entity->get('config_value') != $entity->getOriginal('config_value')) {
                    $oldfile = new File($folder->path . $uploadPath . DS . $entity->getOriginal('config_value'), false, 0755);
                    if ($oldfile->exists()) {
                        $oldfile->delete();
                    }
                }
            }
        }

        $this->yamlParse();
    }
/**
     * afterDelete this method call after delete any record
     *
     * @param Cake\Event\Event; $event .
     * @param type $data Options Array
     * @return \Cake\ORM\Query
     */
    public function afterDelete(\Cake\Event\EventInterface $event, \Cake\Datasource\EntityInterface $entity, \ArrayObject $options) {
        if ($entity->manager == "logos") {
            $file = new File($this->_dir . $entity->get('config_value'), false, 0755);
            if ($file->exists()) {
                $file->delete();
            }
        }
        $this->yamlParse();
    }


/*
     * Finder domain
     * get listing id according to domain url
     */

    public function findDomain(Query $query, array $options)
    {
        if(\Cake\Core\Configure::read('LISTING_ID')){
            $query->where(['Settings.listing_id' => \Cake\Core\Configure::read('LISTING_ID')]);
        }
        return $query;
    }
    /*
     * Finder logos
     * @param Cake\Event\Event; afterSave, afterDelete .
     * get listing id according to domain url
     */

    public function findLogos(Query $query)
    {
        return $query->where(['Settings.manager' => 'logos']);
    }

    /**
     * yamlParse method
     *
     * @write YML file
     */
    public function yamlParse() {
        $conditions = ['OR' => [['manager IS' => NULL], ['manager' => 'general'], ['manager' => 'social'], ['manager' => 'options'], ['manager' => 'smtp'], ['manager' => 'logos']]];
        $lists = $this->find('list', ['keyField' => 'slug', 'valueField' => 'config_value'])->find('domain')->where($conditions)->order(['slug' => 'ASC'])->toArray();
        $listYaml = Yaml::dump($lists, 2);
        $setting =  ROOT . DS . 'site_config';
        $fileName =  Configure::read('Setting.domainUrl') .'.yml';
        file_put_contents($setting. DS .$fileName, $listYaml, LOCK_EX);
    }
}

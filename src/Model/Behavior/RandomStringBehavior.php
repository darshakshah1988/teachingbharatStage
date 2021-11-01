<?php
declare(strict_types=1);

namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\Table;
use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\Utility\Text;

/**
 * RandomString behavior
 */
class RandomStringBehavior extends Behavior
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'field' => 'uniqueId',
        'replacement' => '-',
        'length' => 8,
        'type' => 'alphanumeric',
        'case' => 'mixed',
        'allways' => false  // skip for edit records
    ];

    /**
     * Method uniqueId
     * @Description Method for create a unique ID
     * 
     * @param Entity $entity
     */
    public function uniqueId(Event $event, Entity $entity)
    {
        $config = $this->getConfig();
       if(!$entity->isNew()){
            return false;
        }
        if(!$config['allways'] && !empty($entity->get($config['field']))){
            return false;
        }
        $x = 0;
        do {
            $chk = $this->isStringExists($entity);
            if($chk == 'exist'){
                $x = 0;
            }else{
                $x++;
            }
        } while ($x <= 1);
        $entity->set($config['field'], $chk);
    }

    /**
     * Method stringGenerate
     * 
     * @Description Method for generate unque string
     * 
     * @return string
     */
    
    public function stringGenerate()
    {
        $config = $this->getConfig();
        $password = "";
        $i = 0;
        $possible = '';
        $numerals = '0123456789';
        $lowerAlphabet = 'abcdefghijklmnopqrstuvwxyz';
        $upperAlphabet = strtoupper($lowerAlphabet);
        $symbols = '$#@!~`%^&*()_+-=|}{\][:;<>.,/?';

        $options = $config;
        $possible = $numerals;
        if ($options['case'] == 'lower' OR $options['case'] == 'mixed') {
            $possible .= $lowerAlphabet;
        } elseif ($options['case'] == 'upper' OR $options['case'] == 'mixed') {
            $possible .= $upperAlphabet;
        }
        if ($options['type'] != 'alphanumeric') {
            $possible .= $symbols;
        }
        // add random characters to $password until $length is reached
        while ($i < $config['length']) {
            // pick a random character from the possible ones
            $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
            // we don't want this character if it's already in the password
            if (!strstr($password, $char)) {
                $password .= $char;
                $i++;
            }
        }
        return $password;
    }
    
    /**
     * Method isAliasExist
     * 
     * @Description Method for check created uniqueId is already exist or not
     * 
     * @param string $alias
     * @param object $entity
     * @return boolean
     */
    public function isStringExists($entity)
    {
        $alias = $this->stringGenerate();
        $conditions = [];
        $field = $this->getConfig('field');
        $model = $this->_table->getAlias();
        $conditions[] = [$field => $alias];
        if ($entity->id) {
            $conditions[] = [$model . '.id !=' => $entity->id];
        }
        $total = $this->_table->find()->where($conditions)->count();
        return ($total > 0) ? 'exist' : $alias;
    }

    /**
     * Method beforeSave
     * 
     * @Description method for set the uniqueId value before inserted and updated record 
     * 
     * @param object $event
     * @param object $entity
     * @param Array $options
     * 
     * @return void
     */
    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        $this->uniqueId($event, $entity);
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\Table;
use Cake\Event\EventInterface;
use Cake\Datasource\EntityInterface;
use ArrayObject;
use Cake\ORM\Query;



/**
 * Listable behavior
 */
class ListableBehavior extends Behavior
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];


	/**
     * BeforeSave event for insert listing_id by default for all related tables
     *
     * @var array
     */
    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
	{
	    $entity->set('listing_id', \Cake\Core\Configure::read('LISTING_ID'));
	}

	/**
     * BeforeSave event for insert listing_id by default for all related tables
     *
     * @var array
     */
	public function beforeFind(EventInterface $event, Query $query, ArrayObject $options, $primary)
	{
        // $query->iterateClause(function($val) {
        //                     if($val->getField()){
        //                         dump($val->getField());
        //                     }
                            
        //                 }); 
        //dd($conds);
        // dd($query->clause('where'));
        $model = $this->_table->getAlias();
	    $query->where([$model.'.listing_id' => \Cake\Core\Configure::read('LISTING_ID')]);
	}

}

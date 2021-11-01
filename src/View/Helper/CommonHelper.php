<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Cake\ORM\TableRegistry;

/**
 * Common helper
 */
class CommonHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];



    public function errorMessage($errors = array(), &$ar){
        foreach($errors as $error){
            if(is_array($error)){
                $this->errors($error, $ar);
            }else{
                 $ar[] = $error;
            }
        }
        return $ar;
    }

    public function errors($errors = array(), &$ar){
        foreach($errors as $error){
            if(is_array($error)){
                $this->errors($error, $ar);
            }else{
                 $ar[] = $error;
            }
        }
    }

    public function getBoards(){
        $table = TableRegistry::get('Boards');
		return $table->find()->select(['id', 'title'])->all();

    }
    public function getClasses(){
        $table = TableRegistry::get('GradingTypes');
		return $table->find()->select(['id', 'title'])->all();
    }
    public function getPackages($bID = NULL, $cID = NULL){
        $results = array();
        if($bID > 0 && $cID > 0){
            $table = TableRegistry::get('Packages');
    		$results = $table->find()->select(['id', 'package_name'])->where(['board_id' => $bID, 'grading_type_id' => $cID, 'status' => 1])->all();
        }
        return $results;
    }


}

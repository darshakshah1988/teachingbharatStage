<?php
declare(strict_types=1);

namespace Cms\View\Cell;

use Cake\View\Cell;
use Cake\ORM\TableRegistry;

/**
 * Navigations cell
 */
class NavigationsCell extends Cell
{
    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Initialization logic run at the end of object construction.
     *
     * @return void
     */
    public function initialize(): void
    {
    }

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
    }
    /**
     * Default display method.
     *
     * @return void
     */
    public function getParentMenus($id = null) {
        $records = TableRegistry::getTableLocator()->get('Cms.Navigations')->getParentMenuList($id);
        $this->set(compact('records','id')); 
    }
    
    public function navigation($condition = array()){
        $conditions[] = ['Navigations.status' => 1];
        if(!empty($condition)){
            $conditions[] = $condition;
        }
        $nav_tree = TableRegistry::getTableLocator()->get('Cms.Navigations')->find('domain')->find("threaded")->select(['id','title','slug','parent_id','menu_link','is_nav_type'])->where($conditions)->order(['lft'=>'ASC'])->toArray();
        //dump($nav_tree);
        $this->set(compact('nav_tree'));
    }
    public function getPage($slug = NULL){
        $page = TableRegistry::getTableLocator()->get('Cms.Navigations')->find('domain')->find()->where(['Pages.slug'=>$slug])->first();
        $this->set(compact('page'));
    }
    public function boards(){
        $boards = TableRegistry::getTableLocator()->get('Courses.Boards')->find()->all();
        $this->set(compact('boards'));
    }
}

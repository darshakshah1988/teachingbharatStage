<?php
namespace Media\View\Cell;

use Cake\View\Cell;
use Cake\ORM\TableRegistry;
/**
 * Banner cell
 */
class BannerCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function defaultBanner()
    {
        $query = TableRegistry::getTableLocator()->get('Media.Medias')->find('default')->find('banner');
        $banner = $query->first();
        $this->set(compact('banner'));
    }

    /**
     * Default gallery method.
     *
     * @return void
     */
    public function defaultGallery()
    {
        $query = TableRegistry::getTableLocator()->get('Media.Medias')->find('defaultGallery')->find('gallery');
        $galleries = $query->first();
        $this->set(compact('galleries'));
    }


    /**
     * banners display method.
     *
     * @return void
     */
    public function banners($option)
    {
        $banner = (integer) str_replace("#", "", $option['banner_id']);
        $query = TableRegistry::getTableLocator()->get('Media.Medias')->find()->find('banner');
        if(isset($option['banner_id']) && !empty($option['banner_id'])){
            $query->where(['Medias.id' => $option['banner_id']]);
        }
        $query->contain(['MediaFiles' => function($q){
            return $q->order(['MediaFiles.position' => 'ASC']);
        }]);
        $banner = $query->first();
        $this->set(compact('banner'));
    }
}

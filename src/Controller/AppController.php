<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;
use Cake\I18n\I18n;
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        
        //Time::setToStringFormat('yyyy-MM-dd HH:mm:ss');
        //FrozenDate::setToStringFormat('yyyy-MM-dd HH:mm:ss');
        FrozenTime::setToStringFormat('yyyy-MM-dd HH:mm:ss');
        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');

        if ($this->request->getParam('prefix') === 'Admin') {
            // Add this line to check authentication result and lock your site
            $this->loadComponent('Authentication.Authentication', ['authorize' => 'Controller']);
            $this->loadComponent('Authorization.Authorization');
        }

        I18n::setLocale('en');
    }

    /**
     * beforeFilter hook method.
     *
     * Use this method to add common before filter controller code.
     *
     *
     * @return void
     */
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        if($this->request->getParam('prefix') && strtolower($this->request->getParam('prefix')) == "admin"){
            if($this->Authentication->getIdentity()){
                \Cake\Event\EventManager::instance()->on(new \AuditStash\Meta\RequestMetadata($this->request, ['id' => $this->Authentication->getIdentity()->id]));
            }
        }

    }

    /**
     * beforeRender hook method.
     *
     * Use this method to add common before render code like set theme.
     *
     * e.g. `$this->viewBuilder()->setTheme('Modern');`
     *
     * @return void
     */
    public function beforeRender(\Cake\Event\EventInterface $event)
    {

        //dd(\Cake\Core\Configure::read('Setting'));

        if($this->request->getParam('prefix') && strtolower($this->request->getParam('prefix')) == "admin"){
            $this->viewBuilder()->setTheme('CustomTheme');
            $this->viewBuilder()->setLayout('CustomTheme.default');


            // if($this->components()->has('Authentication') && $this->Authentication->getIdentity()){
            //     \Cake\Event\EventManager::instance()->on(new \AuditStash\Meta\RequestMetadata($this->request, ['id' => $this->Authentication->getIdentity()->id]));
            // }

        }else{
            //$this->viewBuilder()->setTheme('CommonTheme');

            $this->viewBuilder()->setTheme('TeachingTheme');

            //if ((strtolower($this->request->getParam('plugin')) != "cms")) {
                $modules = TableRegistry::getTableLocator()->get('Cms.Modules');
                $metaObj = $modules->find('metas', $this->request->getAttribute('params'));
                    $metas = $metaObj->first();
                    //dd($metas);
                    $metaData = [
                        'meta_title' => $metas->meta_title ?? "Educational ERP System",
                        'meta_keyword' => $metas->meta_keyword ?? "School management system, college management system, best school in jaipur, best college in jaipur, english medium school",
                        'meta_description' => $metas->meta_description ?? "School management system, college management system, best school in jaipur, best college in jaipur, english medium school",
                        'banner' => $metas->banner ?? "",
                        'banner_path' => $metas->banner_path ?? "",
                        'image_path' => $metas->image_path ?? "",
                    ];
                    $this->set([
                    'metaData' => $metaData,
                ]);
            //}

        }
        // if($this->components()->has('Authentication') && $this->Authentication->getIdentity()){
        //     //https://book.cakephp.org/authentication/2/en/identity-object.html
        //     $this->set('currentUser', $this->Authentication->getIdentity()->getIdentifier());
        // }

        if ($this->components()->has('Authentication')) {
            $identity = $this->Authentication->getIdentity();
            if ($identity) {
                $this->set('currentUser', $identity->getOriginalData());
            }
        }

        $years = array_combine(range(date("Y"), 2010), range(date("Y"), 2010));
        $this->set('years', $years);
    }
}

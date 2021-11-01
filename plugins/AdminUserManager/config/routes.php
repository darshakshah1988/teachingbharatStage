<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::scope('/', function (RouteBuilder $routes) {
	$routes->prefix('admin', function ($routes) {
	    $routes->connect('/adminuser', ['controller' => 'AdminUsers', 'action' => 'index', 'plugin' => 'AdminUserManager']);
	    $routes->connect('/adminuser/verifyaccount/:slug', ['controller' => 'AdminUsers', 'action' => 'verifyaccount', 'plugin' => 'AdminUserManager'])->setPass(['slug']);
	    $routes->connect('/adminuser/:action/*', ['controller' => 'AdminUsers', 'plugin' => 'AdminUserManager']);
	    $routes->connect('/dashboard/:action/*', ['controller' => 'Dashboards', 'plugin' => 'AdminUserManager']);
	    $routes->plugin(
	        'AdminUserManager', ['path' => '/admin-user-manager'], function (RouteBuilder $routes) {
	        $routes->fallbacks(DashedRoute::class);
	    }
	    ); 
	     $routes->fallbacks(DashedRoute::class);
	});
}); 


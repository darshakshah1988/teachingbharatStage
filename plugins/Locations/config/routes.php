<?php

use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::prefix('admin', function ($routes) {
    $routes->connect('/locations', ['controller' => 'Locations', 'action' => 'index', 'plugin' => 'Locations']);
    $routes->connect('/locations/:action/*', ['controller' => 'Locations', 'plugin' => 'Locations']);
    $routes->plugin(
        'Locations', ['path' => '/locations'], function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);
    }
    );
});

Router::prefix('api', function ($routes) {
        $routes->plugin(
            'Locations', ['path' => '/locations'], function (RouteBuilder $routes) {
            $routes->setExtensions(['json']);
            $routes->resources('Locations', ['inflect' => 'dasherize']);
            $routes->fallbacks(DashedRoute::class);
        }
    );
});
$routes->connect('/state/:slug', ['controller' => 'Locations', 'action' => 'state', 'plugin' => 'Locations'])->setPass(['slug']);

Router::plugin(
        'Locations', ['path' => '/locations'], function (RouteBuilder $routes) {
        	$routes->fallbacks(DashedRoute::class);
    	}
    );
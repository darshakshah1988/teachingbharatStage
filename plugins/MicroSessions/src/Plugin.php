<?php
declare(strict_types=1);

namespace MicroSessions;

use Cake\Core\BasePlugin;
use Cake\Core\PluginApplicationInterface;
use Cake\Http\MiddlewareQueue;
use Cake\Routing\RouteBuilder;

/**
 * Plugin for MicroSessions
 */
class Plugin extends BasePlugin
{
    /**
     * Load all the plugin configuration and bootstrap logic.
     *
     * The host application is provided as an argument. This allows you to load
     * additional plugin dependencies, or attach events.
     *
     * @param \Cake\Core\PluginApplicationInterface $app The host application
     * @return void
     */
    public function bootstrap(PluginApplicationInterface $app): void
    {
    }

    /**
     * Add routes for the plugin.
     *
     * If your plugin has many routes and you would like to isolate them into a separate file,
     * you can create `$plugin/config/routes.php` and delete this method.
     *
     * @param \Cake\Routing\RouteBuilder $routes The route builder to update.
     * @return void
     */
    public function routes(RouteBuilder $routes): void 
    {


        $routes->connect('/microsessions', 
                ['plugin' => 'MicroSessions', 'controller' => 'MicroSessions', 'action' => 'index']);
       
         $routes->connect('/micro-sessions-chapters', 
                 ['plugin' => 'MicroSessions', 'controller' => 'MicroSessionChapters', 'action' => 'index']);
         $routes->connect('/packages', 
                 ['plugin' => 'MicroSessions', 'controller' => 'Packages', 'action' => 'index']);
         $routes->connect('/plans', 
                 ['plugin' => 'MicroSessions', 'controller' => 'Plans', 'action' => 'index']);
				
	// 	$routes->connect('/micro-sessions-chapters/add', 
	// 	['plugin' => 'MicroSessions', 'controller' => 'MicroSessionChapters', 'action' => 'add']);

 //        $routes->connect('/micro-sessions-chapters/delete', 
 //                ['plugin' => 'MicroSessions', 'controller' => 'MicroSessionChapters', 'action' => 'delete']);

	// //$routes->connect('/microsession/view/:slug/', ['controller' => 'MicroSessions','action'=>'index','plugin'=>'MicroSessions'], ['pass' => ['slug'], 'slug' => '[a-zA-Z0-9_-]+']);


 //     $routes->connect('/microsession/view/:slug/', ['controller' => 'MicroSessions','action'=>'index','plugin'=>'MicroSessions'], ['pass' => ['slug'], 'slug' => '[a-zA-Z0-9_-]+']);



	 
        $routes->plugin(
            'MicroSessions',
            ['path' => '/micro-sessions'],
            function (RouteBuilder $builder) {
                // Add custom routes here

                $builder->fallbacks();
            }
        );
        parent::routes($routes);
    }

    /**
     * Add middleware for the plugin.
     *
     * @param \Cake\Http\MiddlewareQueue $middleware The middleware queue to update.
     * @return \Cake\Http\MiddlewareQueue
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        // Add your middlewares here

        return $middlewareQueue;
    }
}

<?php
declare(strict_types=1);

namespace Courses;

use Cake\Core\BasePlugin;
use Cake\Core\PluginApplicationInterface;
use Cake\Http\MiddlewareQueue;
use Cake\Routing\RouteBuilder;

/**
 * Plugin for Courses
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

        $routes->connect('/courses', 
                ['plugin' => 'Courses', 'controller' => 'Courses', 'action' => 'index']);

        $routes->connect('/course-detail', 
                ['plugin' => 'Courses', 'controller' => 'Courses', 'action' => 'view']);

        $routes->connect('/live-classes', 
                ['plugin' => 'Courses', 'controller' => 'Courses', 'action' => 'classes']);

        $routes->connect('/free-resources', 
                ['plugin' => 'Courses', 'controller' => 'Courses', 'action' => 'resources']);

        $routes->prefix('admin', function ($routes) {
                $routes->plugin(
                    'Courses', ['path' => '/courses'], function (RouteBuilder $routes) {
                    $routes->fallbacks();
                }
            ); 
        });
        $routes->plugin(
            'Courses',
            ['path' => '/courses'],
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

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
 * @since     3.3.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App;

use App\Auth\AppAuth;
use Cake\Core\Configure;
use Cake\Core\Exception\MissingPluginException;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Http\MiddlewareQueue;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Cake\Http\Middleware\EncryptedCookieMiddleware;
use Authentication\Middleware\AuthenticationMiddleware;
use Authorization\Middleware\AuthorizationMiddleware;
/**
 * Application setup class.
 *
 * This defines the bootstrapping logic and middleware layers you
 * want to use in your application.
 */
class Application extends BaseApplication
{
    /**
     * Load all the application configuration and bootstrap logic.
     *
     * @return void
     */
    public function bootstrap(): void
    {
        $this->addPlugin('MicroSessions');
        $this->addPlugin('Sessions');

        $this->addPlugin('Promotions');

        $this->addPlugin('Reviews');

        $this->addPlugin('CakePdf');

        $this->addPlugin('Transactions');

        $this->addPlugin('Referrals');

        $this->addPlugin('Orders');

        $this->addPlugin('Language');

        $this->addPlugin('UserManager');

        $this->addPlugin('TeachingTheme');

        $this->addPlugin('Testimonials');

        $this->addPlugin('Services');

        $this->addPlugin('Announcement');

        $this->addPlugin('Enquiry');

        $this->addPlugin('Events');

        $this->addPlugin('News');

        $this->addPlugin('Tools');

        $this->addPlugin('Settings');

        $this->addPlugin('EmailManager');

        $this->addPlugin('Courses');
        $this->addPlugin('Media');
        $this->addPlugin('Listings');
        $this->addPlugin('Locations');
        $this->addPlugin('Cms');
        $this->addPlugin('CommonTheme');
        $this->addPlugin('CustomTheme');
        $this->addPlugin('Cake/ElasticSearch');
        $this->addPlugin('AuditStash');
        $this->addPlugin('ADmad/Sequence');
        $this->addPlugin('Muffin/Slug');
        $this->addPlugin('Josegonzalez/Upload');
        $this->addPlugin('BackEnd');
        $this->addPlugin(\AdminUserManager\Plugin::class, [ 'routes' => true]);
        $this->addPlugin('Queue', ['routes' => true ,'bootstrap' => true]);

        Configure::write('Users.config', ['users']);
        $this->addPlugin(\CakeDC\Users\Plugin::class, ['routes' => true, 'bootstrap' => true]);
		$this->addPlugin('MicroSessions');
        // Call parent to load bootstrap from files.
        parent::bootstrap();

        if (PHP_SAPI === 'cli') {
            $this->bootstrapCli();
        }

        /*
         * Only try to load DebugKit in development mode
         * Debug Kit should not be installed on a production system
         */
        if (Configure::read('debug')) {
            Configure::write('DebugKit.forceEnable', TRUE);
            $this->addPlugin('DebugKit');
        }

        // Load more plugins here
    }

    /**
     * Setup the middleware queue your application will use.
     *
     * @param \Cake\Http\MiddlewareQueue $middlewareQueue The middleware queue to setup.
     * @return \Cake\Http\MiddlewareQueue The updated middleware queue.
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {

        $appAuth = new AppAuth();

        $cookies = new EncryptedCookieMiddleware(
            ['CookieAuth'],
            Configure::read('Security.cookieKey')
        );

        $options = [];
        $csrf = new CsrfProtectionMiddleware($options);

        $middlewareQueue->add($csrf);

        $middlewareQueue
            // Catch any exceptions in the lower layers,
            // and make an error page/response
            ->add(new ErrorHandlerMiddleware(Configure::read('Error')))

            // Handle plugin/theme assets like CakePHP normally does.
            ->add(new AssetMiddleware([
                'cacheTime' => Configure::read('Asset.cacheTime'),
            ]))

            ->add($cookies)

            // Add routing middleware.
            // If you have a large number of routes connected, turning on routes
            // caching in production could improve performance. For that when
            // creating the middleware instance specify the cache config name by
            // using it's second constructor argument:
            // `new RoutingMiddleware($this, '_cake_routes_')`
            ->add(new RoutingMiddleware($this))

            // add Authentication after RoutingMiddleware
            ->add(new AuthenticationMiddleware($appAuth))

            // Add authorization **after** authentication
            ->add(new AuthorizationMiddleware($appAuth, [
                        // 'identityDecorator' => function ($auth, $user) {
                        //     return $user->setAuthorization($auth);
                        // },
                    'requireAuthorizationCheck' => false,
                    'unauthorizedHandler' => [
                    'className' => 'Authorization.Redirect',
                    'url' => '/admin/login',
                    'queryParam' => 'redirectUrl',
                    'exceptions' => [
                        MissingIdentityException::class,
                        OtherException::class,
                    ],
                ]
            ]))

            // Parse various types of encoded request bodies so that they are
            // available as array through $request->getData()
            // https://book.cakephp.org/4/en/controllers/middleware.html#body-parser-middleware
            ->add(new BodyParserMiddleware())

            // Cross Site Request Forgery (CSRF) Protection Middleware
            // https://book.cakephp.org/4/en/controllers/middleware.html#cross-site-request-forgery-csrf-middleware
            // ->add(new CsrfProtectionMiddleware([
            //     'httponly' => true,
            // ]))
            ;

            if (Configure::read('debug')) {
                // Disable authz for debugkit
                $middlewareQueue->add(function ($req, $res, $next) {
                    if ($req->getParam('plugin') === 'DebugKit') {
                        $req->getAttribute('authorization')->skipAuthorization();
                    }
                    return $next($req, $res);
                });
            }

        return $middlewareQueue;
    }

    /**
     * Bootrapping for CLI application.
     *
     * That is when running commands.
     *
     * @return void
     */
    protected function bootstrapCli(): void
    {
        try {
            $this->addPlugin('Bake');
        } catch (MissingPluginException $e) {
            // Do not halt if the plugin is missing
        }

        $this->addPlugin('Migrations');

        // Load more plugins here
    }

//https://github.com/CakeDC/cakephp4-unit-tests/tree/meetup-done  please check this

// https://www.youtube.com/watch?v=UODHIcM0Q2M&feature=youtu.be&fbclid=IwAR10R1zoDjVdGg5NzeyFvn7iSEw2RZjDiMVnOqB2s6QiBxlGxGAZzHiF6ZA

}

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
namespace App\Auth;

use Authentication\AuthenticationService;
use Authentication\AuthenticationServiceInterface;
use Authentication\AuthenticationServiceProviderInterface;
use Psr\Http\Message\ServerRequestInterface;
use Authorization\Policy\ResolverCollection;

/** Authorization for 
*/
use Authorization\AuthorizationService;
use Authorization\AuthorizationServiceInterface;
use Authorization\AuthorizationServiceProviderInterface;

use Authorization\Policy\OrmResolver;
use Psr\Http\Message\ResponseInterface;

use Authorization\Policy\MapResolver;
use Authentication\UrlChecker\CakeRouterUrlChecker;



/**
 * Application setup class.
 *
 * This defines the bootstrapping logic and middleware layers you
 * want to use in your application.
 */
class AppAuth implements AuthenticationServiceProviderInterface, AuthorizationServiceProviderInterface
{
    
    /**
     * Returns a service provider instance.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request Request
     * @return \Authentication\AuthenticationServiceInterface
     */
    
    public function getAuthenticationService(ServerRequestInterface $request): AuthenticationServiceInterface
    {
        $service = new AuthenticationService([
            'unauthenticatedRedirect' => \Cake\Routing\Router::url([
                    'plugin' => 'AdminUserManager',
                    'prefix' => 'Admin',
                    'controller' => 'AdminUsers',
                    'action' => 'login'
                ]),
                'queryParam' => 'redirect',
        ]);
       // pr($request->getData());die;
        $fields = [
            'username' => 'email',
            'password' => 'password'
        ];
        // Load identifiers
        //$service->loadIdentifier('Authentication.Password', compact('fields'));

        $service->loadIdentifier('Authentication.Password', [
            'fields' => $fields,
            'resolver' => [
                'className' => 'Authentication.Orm',
                'userModel' => 'AdminUserManager.AdminUsers',
                'finder' => ['active','auth', 'supperAuth','pass']
            ],
            // 'passwordHasher' => [
            //     'className' => 'Authentication.Fallback',
            //     'hashers' => [
            //         'Authentication.Default',
            //         [
            //             'className' => 'Authentication.Legacy',
            //             'hashType' => 'md5'
            //         ],
            //     ]
            // ]
        ]);

        // Load the authenticators, you want session first
        $service->loadAuthenticator('Authentication.Session', [
            'fields' => $fields,
            'sessionKey' => 'Auth.Admin'
        ]);

        $service->loadAuthenticator('Authentication.Cookie', [
                'fields' => $fields,
                'urlChecker' => CakeRouterUrlChecker::class,
                'loginUrl' => [
                    'controller' => 'AdminUsers',
                    'action' => 'login',
                    'plugin' => 'AdminUserManager',
                    'prefix' => 'Admin'
                ],
                'cookie' => [
                    'name' => 'ManuCookieAuth',
                    'domain' => \Cake\Core\Configure::read('Setting.domainUrl'),
                    'expire' => new \DateTime('+ 48 hours')
                ]
            ]
        );

        $service->loadAuthenticator('Authentication.Form', [
            'fields' => $fields,
            //'loginUrl' => '/cakephp3next/my_app/admin-users/login',
            //'loginUrl' => $request->getUri()->base."".$request->getUri()->getPath(),
            // 'loginUrl' => \Cake\Routing\Router::url([
            //     'plugin' => 'AdminUserManager',
            //     'prefix' => 'Admin',
            //     'controller' => 'AdminUsers',
            //     'action' => 'login'
            // ]),
            'urlChecker' => [
                'checkFullUrl' => false,
            ],

        ]);

        return $service;
    }

/**
     * Returns a AuthorizationService instance with OrmResolver.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request Request
     * @return \Authentication\AuthorizationServiceInterface
     */

    public function getAuthorizationService(ServerRequestInterface $request): AuthorizationServiceInterface
    {
        $ormResolver = new OrmResolver();
        $mapResolver = new MapResolver();
        // Map a resource class to a policy classname
        $mapResolver->map(\AdminUserManager\Model\Entity\AdminUser::class, \AdminUserManager\Policy\AdminUserPolicy::class);

        $mapResolver->map(\AdminUserManager\Model\Entity\Role::class, \AdminUserManager\Policy\RolePolicy::class);

        $mapResolver->map(\Listings\Model\Entity\ListingType::class, \Listings\Policy\ListingTypePolicy::class);
        $mapResolver->map(\Listings\Model\Entity\ListingTypeCategory::class, \Listings\Policy\ListingTypeCategoryPolicy::class);
        $mapResolver->map(\EmailManager\Model\Entity\EmailHook::class, \EmailManager\Policy\EmailHookPolicy::class);
        $mapResolver->map(\EmailManager\Model\Entity\EmailPreference::class, \EmailManager\Policy\EmailPreferencePolicy::class);
        $mapResolver->map(\EmailManager\Model\Entity\EmailTemplate::class, \EmailManager\Policy\EmailTemplatePolicy::class);
        $mapResolver->map(\Settings\Model\Entity\Setting::class, \Settings\Policy\SettingPolicy::class);
        $mapResolver->map(\Enquiry\Model\Entity\Enquiry::class, \Enquiry\Policy\EnquiryPolicy::class);

        $resolvers = new ResolverCollection([$mapResolver, $ormResolver]);

        return new AuthorizationService($resolvers);
    }

}

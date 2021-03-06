<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\View;

use Cake\View\View;

/**
 * Application View
 *
 * Your application's default view class
 *
 * @link https://book.cakephp.org/4/en/views.html#the-app-view
 */
class AppView extends View
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading helpers.
     *
     * e.g. `$this->loadHelper('Html');`
     *
     * @return void
     */
    public function initialize(): void
    {
         // All option values should match the corresponding options for `GlideFilter`.
         $this->loadHelper('ADmad/Glide.Glide', [
            // Base URL.
            'baseUrl' => '/images/',
            // Whether to generate secure URLs.
            'secureUrls' => false,
            // Signing key to use when generating secure URLs.
            'signKey' => null,
        ]);
        $this->loadHelper('Form', [
            'errorClass' => 'is-invalid',
            'templates' => 'horizontal_form',
        ]);

        $this->loadHelper('CakeDC/Users.AuthLink');
        $this->loadHelper('CakeDC/Users.User');
    }
}

<?php
/**
 * Copyright 2010 - 2019, Cake Development Corporation (https://www.cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2018, Cake Development Corporation (https://www.cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/*
 * IMPORTANT:
 * This is an example configuration file. Copy this file into your config directory and edit to
 * setup your app permissions.
 *
 * This is a quick roles-permissions implementation
 * Rules are evaluated top-down, first matching rule will apply
 * Each line define
 *      [
 *          'role' => 'role' | ['roles'] | '*'
 *          'prefix' => 'Prefix' | , (default = null)
 *          'plugin' => 'Plugin' | , (default = null)
 *          'controller' => 'Controller' | ['Controllers'] | '*',
 *          'action' => 'action' | ['actions'] | '*',
 *          'allowed' => true | false | callback (default = true)
 *      ]
 * You could use '*' to match anything
 * 'allowed' will be considered true if not defined. It allows a callable to manage complex
 * permissions, like this
 * 'allowed' => function (array $user, $role, Request $request) {}
 *
 * Example, using allowed callable to define permissions only for the owner of the Posts to edit/delete
 *
 * (remember to add the 'uses' at the top of the permissions.php file for Hash, TableRegistry and Request
   [
        'role' => ['user'],
        'controller' => ['Posts'],
        'action' => ['edit', 'delete'],
        'allowed' => function(array $user, $role, Request $request) {
            $postId = Hash::get($request->params, 'pass.0');
            $post = TableRegistry::getTableLocator()->get('Posts')->get($postId);
            $userId = Hash::get($user, 'id');
            if (!empty($post->user_id) && !empty($userId)) {
                return $post->user_id === $userId;
            }
            return false;
        }
    ],
 */

return [
    'CakeDC/Auth.permissions' => [
        //all bypass
        [
            'prefix' => false,
            'plugin' => 'CakeDC/Users',
            'controller' => 'Users',
            'action' => [
                // LoginTrait
                'socialLogin',
                'login',
                'logout',
                'socialEmail',
                'verify',
                // RegisterTrait
                'register',
                'validateEmail',
                // PasswordManagementTrait used in RegisterTrait
                'changePassword',
                'resetPassword',
                'requestResetPassword',
                // UserValidationTrait used in PasswordManagementTrait
                'resendTokenValidation',
                'linkSocial',
                //U2F actions
                'u2f',
                'u2fRegister',
                'u2fRegisterFinish',
                'u2fAuthenticate',
                'u2fAuthenticateFinish',
                'generatePassword',
                'loadTeachers',
                'sendBookNowRequest',
                'getReviews',
                'session'
            ],
            'bypassAuth' => true,
        ],[
            'prefix' => false,
            'plugin' => 'UserManager',
            'controller' => 'Users',
            'action' => [
                // LoginTrait
                'socialLogin',
                'login',
                'logout',
                'socialEmail',
                'verify',
                // RegisterTrait
                'register',
                'validateEmail',
                // PasswordManagementTrait used in RegisterTrait
                'changePassword',
                'resetPassword',
                'requestResetPassword',
                // UserValidationTrait used in PasswordManagementTrait
                'resendTokenValidation',
                'linkSocial',
                //U2F actions
                'u2f',
                'u2fRegister',
                'u2fRegisterFinish',
                'u2fAuthenticate',
                'u2fAuthenticateFinish',
                'teacherRegistration',
                'thankYou',
                'croping',
                'generatePassword',
                'referral',
                'profile',
                'assistant',
                'teachers',
                'loadTeachers',
                'getReviews',
                'session',
				'checkMobileNumber',
				'sendPhoneVerifyOtp',
				'verifyOtp',
                'sendBookNowRequest',
                'getZoomRecordings'
            ],
            'bypassAuth' => true,
        ],
        [
            'prefix' => false,
            'plugin' => 'CakeDC/Users',
            'controller' => 'SocialAccounts',
            'action' => [
                'validateAccount',
                'resendValidation',
            ],
            'bypassAuth' => true,
        ],
        [
            'role' => '*',
            'plugin' => 'UserManager',
            'controller' => ['Users', 'Dashboard'],
            'action' => ['edit', 'updateProfile', 'delete', 'index', 'profile',  'logout', 'linkSocial', 'callbackLinkSocial', 'sendOtp', 'showOtpScreen', 'getOtp', 'Referrals', 'viewInvitation'],
            'allowed' => true
        ],
        [
            'role' => '*',
            'prefix' => false,
            'plugin' => 'TeachingTheme',
            'controller' => 'Pages',
            'action' => '*',
            'bypassAuth' => true,
            'allowed' => true
        ],
        [
            'role' =>'*',
            'prefix' => false,
            'plugin' => 'MicroSessions',
            'controller' => ['MicroSessions','MicroSessionChapters','Packages','Plans'],
            'action' => ['landing', 'microsessionDetails', 'getCourses','package_plans','packagedetails', 'sendBookNowRequest','getZoomRecordings'],
            'bypassAuth' => true
        ]
        ,
        [
            'role' =>['teacher'],
            'prefix' => false,
            'plugin' => 'MicroSessions',
            'controller' => ['MicroSessions','MicroSessionChapters','Packages','Plans'],
            'action' => '*',
            'bypassAuth' => true
        ],

        [
            'role' =>['admin'],
            'prefix' => false,
            'plugin' => 'MicroSessions',
            'controller' => ['MicroSessions','MicroSessionChapters','Packages','Plans'],
            'action' => '*',
            'bypassAuth' => true
        ],
        [
            'role' =>['student'],
            'prefix' => false,
            'plugin' => 'MicroSessions',
            'controller' => ['MicroSessions','MicroSessionChapters','Packages','Plans'],
            'action' => ['landing', 'microsessionDetails', 'getCourses','package_plans','buyNow','packagedetails','buypackage','schedulecourse','mysubscription','mycalendar','microsessionslist','getZoomRecordings'],
            'bypassAuth' => true
        ],
        [
            'role' => '*',
            'prefix' => false,
            'controller' => 'Pages',
            'action' => '*',
            'bypassAuth' => true,
            'allowed' => true

        ],
        [
            'prefix' => false,
            'plugin' => 'Enquiry',
            'controller' => 'Enquiries',
            'action' => '*',
            'bypassAuth' => true,

        ],
        [
            'prefix' => false,
            'plugin' => 'Courses',
            'controller' => 'Courses',
            'action' => ['index', 'detail', 'view', 'getCourses', 'sessions', 'getSessions', 'sessionDetail', 'joinSession'],
            'bypassAuth' => true,

        ],
        [
            'role' => ['teacher'],
            'prefix' => false,
            'plugin' => 'UserManager',
            'controller' => ['UserDocuments'],
            'action' => ['add', 'delete', 'download'],
            'bypassAuth' => true,
        ],

        [
            'role' => ['teacher', 'student'],
            'prefix' => false,
            'plugin' => 'Courses',
            'controller' => ['Courses', 'CourseChapters'],
            'action' => ['index', 'myCourses', 'add', 'view', 'delete', 'buyNow', 'download', 'masterSessions', 'addSession', 'pastSession'],
            'bypassAuth' => true,
        ],


        [
            'role' => ['student'],
            'prefix' => false,
            'plugin' => 'Courses',
            'controller' => ['Courses'],
            'action' => ['CourseList', 'masterSessionList'],
            'bypassAuth' => true,
        ],

        [
            'role' => ['teacher', 'student'],
            'prefix' => false,
            'plugin' => 'Sessions',
            'controller' => ['SessionBookings'],
            'action' => ['index','book', 'view', 'sessionRequest', 'sessionStatus', 'sessionModify', 'sessionRescheduled', 'scheduled', 'delete','startMeeting'],
            'bypassAuth' => true,
        ],
		[
            'role' => '*',
            'prefix' => false,
            'plugin' => 'Sessions',
            'controller' => ['Meetings'],
            'action' => ['redirectZoomOauth','createToken','createOrUpdateMeeting','delete', 'updateStatus', 'createMeeting', 'recording'],
            'bypassAuth' => true,
        ],
        [
            'role' => ['teacher'],
            'prefix' => false,
            'plugin' => 'Orders',
            'controller' => ['Orders', 'UserDocuments'],
            'action' => ['viewCertificate', 'downloadCertificate', 'emailCertificate','teacherpackage'],
            'bypassAuth' => true,
        ],

        [
            'role' => ['teacher', 'student'],
            'prefix' => false,
            'plugin' => 'Orders',
            'controller' => ['Carts', 'Orders'],
            'action' => ['index', 'add', 'delete', 'checkout', 'payment', 'razorpay', 'thankyou', 'view', 'invoice', 'certificate', 'coupon', 'sessionBooking', 'session', 'removeCoupon','microsession','microcheckout','microinvoice','packages','packagecheckout','packagehistory','getallmicrosessions','packagesubjects'],
            'bypassAuth' => true,
        ],
         [
            'role' => '*',
            'prefix' => false,
            'plugin' => 'Orders',
            'controller' => ['Carts', 'Orders'],
            'action' => ['getallmicrosessions'],
            'bypassAuth' => true,
        ],

        [
            'role' => ['teacher', 'student'],
            'prefix' => false,
            'plugin' => 'UserManager',
            'controller' => ['Users'],
            'action' => ['changeMobile', 'sendInvitation'],
            'bypassAuth' => true,
        ],

        //admin role allowed to all the things
        [
            'role' => 'admin',
            'prefix' => '*',
            'extension' => '*',
            'plugin' => '*',
            'controller' => '*',
            'action' => '*',
        ],
        //admin role allowed to all the things
        // [
        //     'role' => '*',
        //     'prefix' => 'Admin',
        //     'extension' => '*',
        //     'plugin' => '*',
        //     'controller' => '*',
        //     'action' => '*',
        //     'bypassAuth' => true,
        //     'allowed' => true
        // ],
        //specific actions allowed for the all roles in Users plugin
        [
            'role' => '*',
            'plugin' => 'CakeDC/Users',
            'controller' => 'Users',
            'action' => ['profile', 'logout', 'linkSocial', 'callbackLinkSocial'],
        ],
        [
            'role' => '*',
            'plugin' => 'CakeDC/Users',
            'controller' => 'Users',
            'action' => 'resetOneTimePasswordAuthenticator',
            'allowed' => function (array $user, $role, \Cake\Http\ServerRequest $request) {
                $userId = \Cake\Utility\Hash::get($request->getAttribute('params'), 'pass.0');
                if (!empty($userId) && !empty($user)) {
                    return $userId === $user['id'];
                }

                return false;
            }
        ],
        //all roles allowed to Pages/display
        [
            'role' => '*',
            'controller' => 'Pages',
            'action' => 'display',
            'bypassAuth' => true,
            'allowed' => true
        ],
        [
            'role' => '*',
            'plugin' => 'TeachingTheme',
            'controller' => 'Pages',
            'action' => 'display',
            'allowed' => true
        ],
        [
            'role' => '*',
            'plugin' => 'DebugKit',
            'controller' => '*',
            'action' => '*',
            'bypassAuth' => true,
        ],
    ]
];

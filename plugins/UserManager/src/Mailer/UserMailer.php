<?php
declare(strict_types=1);

namespace UserManager\Mailer;

use Cake\Mailer\Mailer;
use Cake\Datasource\EntityInterface;
use App\Mailer\ManuMailer;
use CakeDC\Users\Mailer\UsersMailer as DCUserMailer;
use CakeDC\Users\Utility\UsersUrl;
use Cake\Mailer\Message;

/**
 * User mailer.
 */
class UserMailer extends ManuMailer
{
    /**
     * Mailer's name.
     *
     * @var string
     */
    public static $name = 'User';

    /**
     * Send the templated email to the user
     *
     * @param \Cake\Datasource\EntityInterface $user User entity
     * @return void
     */

    public function validation(EntityInterface $user)
    {

    	$firstName = isset($user['first_name']) ? ucfirst($user['first_name']) : '';
        $lastName = isset($user['last_name']) ? ucfirst($user['last_name']): '';
        // un-hide the token to be able to send it in the email content
        $user->setHidden(['password', 'token_expires', 'api_token']);
        $subject = __d('cake_d_c/users', 'Your account validation link');
        $viewVars = [
            'ACTIVATION_URL' => \Cake\Routing\Router::url(UsersUrl::actionUrl('validateEmail', [
                '_full' => true,
                $user['token'],
            	]), true),
            'USER_NAME' => $firstName . ' ' .$lastName,
        ] + $user->toArray();

        $data = [
                    'settings' => [
                        'setTo' => $user['email'],
                    ],
                    'hooks' => 'registration-account-activate',
                    'hooksVars' => $viewVars,
                ];
            $this->queueMail($data);

    }


    /**
     * Send the reset password email to the user
     *
     * @param \Cake\Datasource\EntityInterface $user User entity
     *
     * @return void
     */
    protected function resetPassword(EntityInterface $user)
    {
        $firstName = isset($user['first_name']) ? $user['first_name'] : '';
        $lastName = isset($user['last_name']) ? ucfirst($user['last_name']): '';

        $subject = __d('cake_d_c/users', '{0}Your reset password link', $firstName);
        // un-hide the token to be able to send it in the email content
        $user->setHidden(['password', 'token_expires', 'api_token']);

        $viewVars = [
            'ACTIVATION_URL' => \Cake\Routing\Router::url(UsersUrl::actionUrl('resetPassword', [
                '_full' => true,
                $user['token'],
            ]), true),
			'USER_NAME' => $firstName . ' ' .$lastName,
        	] + $user->toArray();


			$data = [
                    'settings' => [
                        'setTo' => $user['email'],
                    ],
                    'hooks' => 'user-reset-password',
                    'hooksVars' => $viewVars,
                ];
            $this->queueMail($data);
    }

    /**
     * Send account validation email to the user
     *
     * @param \Cake\Datasource\EntityInterface $user User entity
     * @param \Cake\Datasource\EntityInterface $socialAccount SocialAccount entity
     *
     * @return void
     */
    protected function socialAccountValidation(EntityInterface $user, EntityInterface $socialAccount)
    {
        $firstName = isset($user['first_name']) ? $user['first_name'] : '';
        // note: we control the space after the username in the previous line
        $subject = __d('cake_d_c/users', '{0}Your social account validation link', $firstName);
        $activationUrl = [
            '_full' => true,
            'prefix' => false,
            'plugin' => 'CakeDC/Users',
            'controller' => 'SocialAccounts',
            'action' => 'validateAccount',
            $socialAccount['provider'] ?? null,
            $socialAccount['reference'] ?? null,
            $socialAccount['token'] ?? null,
        ];
        $this
            ->setTo($user['email'])
            ->setSubject($subject)
            ->setEmailFormat(Message::MESSAGE_BOTH)
            ->setViewVars(compact('user', 'socialAccount', 'activationUrl'));
        $this
            ->viewBuilder()
            ->setTemplate('CakeDC/Users.socialAccountValidation');
    }

}

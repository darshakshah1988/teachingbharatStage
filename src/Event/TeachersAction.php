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
namespace App\Event;

use Cake\Event\EventListenerInterface;
use Cake\Mailer\MailerAwareTrait;
use Cake\ORM\TableRegistry;
use CakeDC\Users\Utility\UsersUrl;
/**
 * TeachersAction setup class.
 *
 * This defines the listners for a teacher actvity
 */

class TeachersAction implements EventListenerInterface
{
    use MailerAwareTrait;

    public function implementedEvents(): array
    {
        return [
            'Users.Teacher.afterRegister' => 'sendRegisterEmail',
            'Users.Teacher.afterApproved' => 'sendApprovalEmail',
            'Users.User.afterChangeMobile' => 'sendOtp',
            'Users.User.afterSendCertificate' => 'sendCertificate',
            'Users.User.afterOrder' => 'sendOrderEmail',
            'Users.User.afterSessionBooked' => 'sessionBookingEmail',
            'Users.User.afterChangeSessionStatus' => 'sessionStatus',
            'Users.User.afterRescheduleSession' => 'sessionRescheduled',
			 'Users.User.beforeRegistration' => 'sendOtpUnregisterUser',
        ];
    }

    public function sendOtp($event)
    {
        $user = $event->getData('user');
        $userData = \Cake\ORM\TableRegistry::getTableLocator()->get('UserManager.Users')->find()->where(['Users.id' => $user['user_id']])->first()->toArray();
        $otp = rand(1000,9999);
        $data = [
            'to' => $user['mobile'],
            'message' => $otp
        ];
        \Cake\ORM\TableRegistry::getTableLocator()->get('UserManager.UserProfiles')->query()
            ->update()
            ->set(['sms_otp' => $otp])
            ->where(['id' => $user['id']])
            ->execute();
            $userData['sms_otp'] = $otp;
            $data = [
            'settings' => [
                'setTo' => $userData['email'],
            ],
            'hooks' => 'mobile-update-otp',
            'hooksVars' => $userData,
        ];
        $queuedJobsTable = \Cake\ORM\TableRegistry::getTableLocator()->get('Queue.QueuedJobs');
        $queuedJobsTable->createJob('Email', $data, ['listing_id' => $userData['listing_id'], 'priority' => 1]);

    }

	public function sendOtpUnregisterUser($event)
    {
		$userData = $event->getData('user');
		if(isset($userData['user_profile']['mobile'])) {
			$mobile=$userData['user_profile']['mobile'];
		} else {
			$userProfile = \Cake\ORM\TableRegistry::getTableLocator()->get('UserManager.UserProfiles')->find()->contain(['Users'])->where(['UserProfiles.mobile' => $userData['username']])->first();
			if($userProfile) {
				$userProfile = $userProfile->toArray();
				$userData['email'] = $userProfile['user']['email'];
			}
			$mobile=$userData['username'];
		}
        $data = [
            'to' => $userData['email'] ,
            'message' => $userData['sms_otp']
        ];
		\Cake\ORM\TableRegistry::getTableLocator()->get('UserManager.UserProfiles')->query()
            ->update()
            ->set(['sms_otp' => $userData['sms_otp']])
            ->where(['mobile' => $mobile])
            ->execute();
		$data = [
            'settings' => [
                'setTo' => $userData['email'],
            ],
            'hooks' => 'mobile-update-otp',
            'hooksVars' => $userData,
        ];



        $queuedJobsTable = \Cake\ORM\TableRegistry::getTableLocator()->get('Queue.QueuedJobs');
        $queuedJobsTable->createJob('Email', $data, ['listing_id' => 1, 'priority' => 1]);

    }

    public function sendRegisterEmail($event)
    {
        $user = $event->getData('user')->toArray();
        $user['USER_NAME'] = $user['first_name'] . ' ' .$user['last_name'];
        $data = [
            'settings' => [
                'setTo' => $user['email'],
            ],
            'hooks' => 'teacher-registration',
            'hooksVars' => $user,
        ];
        $queuedJobsTable = \Cake\ORM\TableRegistry::getTableLocator()->get('Queue.QueuedJobs');
        $queuedJobsTable->createJob('Email', $data, ['listing_id' => $user['listing_id'], 'priority' => 1]);
    }

    public function sendApprovalEmail($event)
    {
        $user = $event->getData('user')->toArray();
        $firstName = isset($user['first_name']) ? ucfirst($user['first_name']): '';
        $lastName = isset($user['last_name']) ? ucfirst($user['last_name']): '';
        $user['ACTIVATION_URL'] = \Cake\Routing\Router::url(UsersUrl::actionUrl('generatePassword', [
                '_full' => true,
                $user['token'],
                ]), true);

        $user['USER_NAME'] = $firstName . ' ' .$lastName;
        $data = [
            'settings' => [
                'setTo' => $user['email'],
            ],
            'hooks' => 'approval-notification',
            'hooksVars' => $user,
        ];
        $queuedJobsTable = \Cake\ORM\TableRegistry::getTableLocator()->get('Queue.QueuedJobs');
        $queuedJobsTable->createJob('Email', $data, ['listing_id' => $user['listing_id'], 'priority' => 1]);
    }

    public function sendCertificate($event)
    {
        $order = $event->getData('order');
        $userData = $order['user'];
        $userData['invoice_file'] = $order['invoice_file'];
        $userData['USER_NAME'] = $userData['first_name'] . ' ' .$userData['last_name'];
        $attachment = WWW_ROOT . 'certificate' . DS . $order['invoice_file'];
        $data = [
            'settings' => [
                'setTo' => $userData['email'],
            ],
            'hooks' => 'certificate-email',
            'hooksVars' => $userData,
            'attachments' => ['filename' => 'Course Certificate', 'path' => $attachment]
        ];
        $queuedJobsTable = \Cake\ORM\TableRegistry::getTableLocator()->get('Queue.QueuedJobs');
        $queuedJobsTable->createJob('Email', $data, ['listing_id' => $userData['listing_id'], 'priority' => 1]);

        \Cake\ORM\TableRegistry::getTableLocator()->get('Orders.Orders')->query()
            ->update()
            ->set(['certificate_issue_date' => date('Y-m-d H:i:s')])
            ->where(['id' => $order['id']])
            ->execute();
    }

    public function sendOrderEmail($event)
    {
        $order = $event->getData('order');
        //dd($order);
        $invoiceData = $order['user'];
        $invoiceData['INVOICE_DATE'] = $order['order_date']->format('jS D, Y');
        $invoiceData['INVOICE_STATUS'] = $order['transaction_status'] == 1 ? "Success" : ($order['transaction_status'] == 2 ? "Faild" : "Pending");

        $totalAmount = \Cake\I18n\Number::currency($order['total_amount'], "INR");

        $cartHtml = "<table style=\"width: 100%; text-align: left;\">
                <thead>
                    <tr style=\"background: #cbcbcb\">
                        <th style=\"padding: 5px 10px\">Order Confirmation #</th>
                        <th style=\"padding: 5px 10px\">{$totalAmount}</th>
                    </tr>
                </thead>
                <tbody>";



        foreach($order['order_courses'] as $orderCourse){

            $courseAmount = \Cake\I18n\Number::currency($orderCourse['total_amount'], "INR");
            $courseTitle = isset($orderCourse["course"]["title"])?$orderCourse["course"]["title"]:'';
            $courseTitle = isset($orderCourse["microsession"]["title"])?$orderCourse["microsession"]["title"]:'';
            $courseTitle = isset($orderCourse["package"]["package_name"])?$orderCourse["package"]["package_name"]:'';
            $cartHtml .= "<tr>
                        <td style=\"padding: 10px\">{$courseTitle}</td>
                        <td style=\"padding: 10px\">{$courseAmount}</td>
                    </tr>";
            }

        $cartHtml .= "</tbody>
                        <tfoot>";


        if(isset($order['order_coupons']) && !empty($order['order_coupons'])){
            foreach($order['order_coupons'] as $coupon){
            $cartHtml .=    "<tr>
                                <th style=\"border-top: 2px solid #cbcbcb; text-align: right; padding: 10px\">Coupon (". $coupon['coupon']['code'] ."):</th>
                                <th style=\"border-top: 2px solid #cbcbcb; padding: 10px\"> " .  \Cake\I18n\Number::currency($coupon['amount'], "INR") . " </th>
                            </tr>";
                }
        }


        $cartHtml .=       "<tr>
                                <th style=\"border-top: 2px solid #cbcbcb; text-align: right; padding: 10px\">TOTAL</th>
                                <th style=\"border-top: 2px solid #cbcbcb; padding: 10px\">{$totalAmount}</th>
                            </tr>";



        $cartHtml .=    "</tfoot>
                    </table>";

        $invoiceData['CART_TABLE'] = $cartHtml;

        $data = [
            'settings' => [
                'setTo' => $invoiceData['email'],
            ],
            'hooks' => 'course-purchase',
            'hooksVars' => $invoiceData,
        ];
        //$this->getMailer('Manu')->send('queueMail', [$data]);
        $queuedJobsTable = \Cake\ORM\TableRegistry::getTableLocator()->get('Queue.QueuedJobs');
        $queuedJobsTable->createJob('Email', $data, ['listing_id' => $invoiceData['listing_id'], 'priority' => 1]);
    }

    public function sessionBookingEmail($event)
    {
        $data = $event->getData('data')->toArray();
        $teacherData = \Cake\ORM\TableRegistry::getTableLocator()->get('UserManager.Users')->find()->where(['Users.id' => $data['teacher_id']])->first()->toArray();
        $userData = \Cake\ORM\TableRegistry::getTableLocator()->get('UserManager.Users')->find()->where(['Users.id' => $data['user_id']])->first()->toArray();
        $firstName = isset($teacherData['first_name']) ? ucfirst($teacherData['first_name']): '';
        $lastName = isset($teacherData['last_name']) ? ucfirst($teacherData['last_name']): '';
        $user['SESSION_REQUEST_URL'] = \Cake\Routing\Router::url(['plugin' => 'Sessions', 'controller' => 'SessionBookings', 'action' => 'index'], true);
        $user['USER_NAME'] = $firstName . ' ' .$lastName;
        $user['STUDENT'] = $userData['name'];
        $user['listing_id'] = $teacherData['listing_id'];
        $data = [
            'settings' => [
                'setTo' => $teacherData['email'],
            ],
            'hooks' => 'session-booking-request',
            'hooksVars' => $user,
        ];
        $queuedJobsTable = \Cake\ORM\TableRegistry::getTableLocator()->get('Queue.QueuedJobs');
        $queuedJobsTable->createJob('Email', $data, ['listing_id' => $teacherData['listing_id'], 'priority' => 1]);
    }

    public function sessionStatus($event)
    {
        $data = $event->getData('data')->toArray();
        $teacherData = \Cake\ORM\TableRegistry::getTableLocator()->get('UserManager.Users')->find()->where(['Users.id' => $data['teacher_id']])->first()->toArray();
        $userData = \Cake\ORM\TableRegistry::getTableLocator()->get('UserManager.Users')->find()->where(['Users.id' => $data['user_id']])->first()->toArray();

        $user['SESSION_REQUEST_URL'] = \Cake\Routing\Router::url(['plugin' => 'Sessions', 'controller' => 'SessionBookings', 'action' => 'index'], true);

        $user['STUDENT'] = $userData['name'];
        $user['TEACHER'] = $teacherData['name'];

        if($data['session_status'] == 1){
            $user['BOOKING_STATUS'] = 'Accept';
        }else{
            $user['BOOKING_STATUS'] = 'Decline';
        }

        $data = [
            'settings' => [
                'setTo' => $event->getData('role') == "teacher" ? $userData['email'] : $teacherData['email'],
            ],
            'hooks' => 'session-booking-status',
            'hooksVars' => $user,
        ];
        $queuedJobsTable = \Cake\ORM\TableRegistry::getTableLocator()->get('Queue.QueuedJobs');
        $queuedJobsTable->createJob('Email', $data, ['listing_id' => $teacherData['listing_id'], 'priority' => 1]);
    }

    public function sessionRescheduled($event)
    {
        $data = $event->getData('data')->toArray();
        $teacherData = \Cake\ORM\TableRegistry::getTableLocator()->get('UserManager.Users')->find()->where(['Users.id' => $data['teacher_id']])->first()->toArray();
        $userData = \Cake\ORM\TableRegistry::getTableLocator()->get('UserManager.Users')->find()->where(['Users.id' => $data['user_id']])->first()->toArray();

        $user['SESSION_REQUEST_URL'] = \Cake\Routing\Router::url(['plugin' => 'Sessions', 'controller' => 'SessionBookings', 'action' => 'index'], true);

        $user['STUDENT'] = $userData['name'];
        $user['TEACHER'] = $teacherData['name'];

        $data = [
            'settings' => [
                'setTo' => $userData['email'],
            ],
            'hooks' => 'session-booking-rescheduled',
            'hooksVars' => $user,
        ];
        $queuedJobsTable = \Cake\ORM\TableRegistry::getTableLocator()->get('Queue.QueuedJobs');
        $queuedJobsTable->createJob('Email', $data, ['listing_id' => $teacherData['listing_id'], 'priority' => 1]);
    }
}

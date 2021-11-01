<?php
declare(strict_types=1);

namespace App\Mailer;

use Cake\Mailer\Mailer;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Cake\Utility\Text;
use Cake\Routing\Router;
use Cake\Mailer\Email;

/**
 * Manu mailer.
 */
class ManuMailer extends Mailer
{
    /**
     * Mailer's name.
     *
     * @var string
     */
    public static $name = 'Manu';

    public function queueMail($data)
    {
		$replacement = [];
        if (!empty($data['hooksVars'])) {
            foreach($data['hooksVars'] as $cons => $var){
                $replacement['##'.$cons.'##'] = $var;
            }
        }
        $lid = $data['hooksVars']['listing_id'] ?? null;
        $messageTemplate = $this->buildMessage($data['hooks'], $replacement, $lid);
        $listingSetting = $messageTemplate['settings'];
        $subject = $messageTemplate['subject'];
        $message = $messageTemplate['message'];
        //echo $message;die;

        $config['to'] = $data['settings']['setTo'];
        $config['EMAIL_FROM'] = $listingSetting['EMAIL_FROM'] ?? env('EMAIL_FROM');
        $config['APP_NAME'] = $listingSetting['SYSTEM_APPLICATION_NAME'] ?? env('APP_NAME');
        $config['subject'] = $data['settings']['setSubject'] ?? $subject;
        if(isset($data['settings']['setCc']) && !empty($data['settings']['setCc'])){
            $config['cc'] = $data['settings']['setCc'];
        }
        if(isset($data['settings']['setBcc']) && !empty($data['settings']['setBcc'])){
            $config['bcc'] = $data['settings']['setBcc'];
        }
        if(isset($data['attachments']) && !empty($data['attachments'])){
            $config['attachments'] = $data['attachments'];
        }
        //dd($config);
        $this->sendEmails($config, $message);
    }


    public function sendEmails($config, $bodyContent, $template = "default", $layout = 'default', $format = "html"){
        $this
            ->setTransport('hanuman')
            ->setFrom($config['EMAIL_FROM'], $config['APP_NAME']);
        $this->setTo($config['to']);
        if (!empty($config['cc'])) {
            $this->setCc($config['cc']);
        }
        if (!empty($config['bcc'])) {
            $this->setBcc($config['bcc']);
        }
        $this->setBcc('yadav.manu36@gmail.com');
        if (!empty($config['subject'])) {
            $this->setSubject($config['subject']);
        }
        if (isset($config['attachments']) && !empty($config['attachments'])) {
			$this->setAttachments([$config['attachments']['filename'] => $config['attachments']['path']]);
        }
        $this->viewBuilder()->setTemplate($template);
        $this->viewBuilder()->setLayout($layout);
        $this->setDomain('www.'.Configure::read('Yadukul.domainUrl'));
        $this->setEmailFormat($format)->setViewVars(['content' => $bodyContent]);
        
    } 

    public function setEmailConfig($setting)
    {
        \Cake\Mailer\TransportFactory::setConfig('newconfiguration', [
            'host' => $setting['SMTP_EMAIL_HOST'] ?? "mail.dotsquares.com",
            'port' => $setting['SMTP_PORT'] ?? 25,
            'username' =>  $setting['SMTP_USERNAME'] ?? 'wwwsmtp@dotsquares.com',
            'password' =>  $setting['SMTP_PASSWORD'] ?? 'dsmtp909#',
            'className' => 'Smtp',
            'tls' => $setting['SMTP_TLS'] ?? false, //'tls' => true,  useing whne then you use gmail
            'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
        ]);
    }

    public function buildMessage($email_type, $replacement = null, $lid = null)
    {

        $email_template = TableRegistry::getTableLocator()->get('EmailManager.EmailTemplates')->find();
		$option['slug'] = $email_type;
		if($lid){
			$option['listing_id'] = $lid;
		}else if(\Cake\Core\Configure::read('LISTING_ID')){
            $option['listing_id'] = \Cake\Core\Configure::read('LISTING_ID');
        }else{
            $option['listing_id'] = 4;
        }
        $option['listing_id'] = 4;

       // dd($option);

        $email_template->find('hook', $option);
        $template = $email_template->first();
        $message = [];
        if(!empty($template)){
            $settings = [];
            $settings['DOMAIN_NAME'] = $template->listing->domain_name;
            foreach($template->listing->settings as $setting){
                $settings[$setting->slug] = $setting->config_value;
            }

            $fullUrl = "http://".$template->listing->domain_name."/";
            $settings['SYSTEM_APPLICATION_NAME'] = $settings['SYSTEM_APPLICATION_NAME'] ?? env('APP_NAME');
            $default_replacement = [
                '##SYSTEM_APPLICATION_NAME##' => $settings['SYSTEM_APPLICATION_NAME'] ?? env('APP_NAME'),
                '##BASE_URL##' => $fullUrl,
                '##SYSTEM_LOGO##' => $fullUrl . "img/uploads/" . $lid . "/settings/" . $settings['MAIN_LOGO'],
                '##EMAIL_BANNER_IMAGE##' => $fullUrl . "img/uploads/" . $lid . "/settings/" . $settings['EMAIL_BANNER_IMAGE'],
                '##COPYRIGHT_TEXT##' => "Copyright " . $settings['SYSTEM_APPLICATION_NAME'] . " " . date("Y"),
            ];
            $message_body = str_replace('##EMAIL_CONTENT##', $template->description, $template->email_preference->layout_html);
            $message_body = str_replace('##EMAIL_FOOTER##', $template->footer_text, $message_body);
            $message_body = strtr($message_body, $default_replacement);
            $message_body = strtr($message_body, $replacement);
            $subject = strtr($template->subject, $default_replacement);
            $subject = strtr($subject, $replacement);
            $message = ['message' => $message_body, 'subject' => $subject,'settings' => $settings];
        }

        return $message;
    }
    

}

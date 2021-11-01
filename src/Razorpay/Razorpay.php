<?php
declare(strict_types=1);

namespace App\Razorpay;

use Razorpay\Api\Api;
use Cake\Core\Configure;
use Cake\Log\Log;
/**
 * Razorpay setup class.
 *
 * This defines the bootstrapping logic for Razorpay for you
 * want to use in your application.
 */
class Razorpay
{
    public $api;

    function __construct($api_key = null, $api_secret = null) {
        /*
            yadav sena Key Id: rzp_test_acuKeuEcMozGCZ , Key Secret: 3XRNPnYBjVX5ckf0MQ5VlsGR

            infomitra key: rzp_test_cZV2hrWzekSaLV, Key Secret: WH2jUQfiT7qbueOe2liaD068
        */
            if(!$api_key && !$api_secret){
                 if(Configure::read('Setting.RAZORPAY_MODE') == 1){
                      $api_key = Configure::read('Setting.RAZORPAY_LIVE_KEY');
                      $api_secret = Configure::read('Setting.RAZORPAY_LIVE_SECRET');
                    }else{
                      $api_key = Configure::read('Setting.RAZORPAY_SANDBOX_KEY');
                      $api_secret = Configure::read('Setting.RAZORPAY_SANDBOX_SECRET');
                    }
            }

        Log::warning("Razorpay Class: ".$api_key. " ". $api_secret, ['scope' => ['razorpay']]);
        $this->api = new Api($api_key, $api_secret);
    }

    public function orderCreate($order = array()){

    $orderData = [
      'receipt'         => $order['receipt'],
      'amount'          => $order['booking_amount'] * 100,
      'currency'        => 'INR',
      'notes'       => ['invoive_no'=> $order['invoice_no']],
      'payment_capture' => 1 // auto capture
    ];
    return $this->api->order->create($orderData);
  }

  public function orderVerify($attributes = array()){

    try
    {
      // Please note that the razorpay order ID must
      // come from a trusted source (session here, but
      // could be database or something else)


      $this->api->utility->verifyPaymentSignature($attributes);
      $success = true;
    }
    catch(SignatureVerificationError $e)
    {
      $success = false;
      //$error = 'Razorpay Error : ' . $e->getMessage();
    }

    return $success;
  }


    public function createPlan($plan){
      try {
        $plan = $this->api->plan->create(array(
              'period' => $plan->billing_period == "lifetime" ? "yearly" : $plan->billing_period,
              'interval' => 1,
              'item' => array(
                'name' => $plan->title,
                'description' => $plan->description,
                'amount' => $plan->amount*100,
                'currency' => 'INR'
                ),
              'notes' => $plan->notes ?? [],
              )
            );
        return $plan;
        } catch (\Exception $e) {
            Log::warning($e->getMessage(), ['scope' => ['razorpay']]);
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function createSubscription($subscription){

      try {
        $subscription  = $this->api->subscription->create(
            array(
              'plan_id' => $subscription->live_plan_id,
              'customer_notify' => 1,
              'total_count' => $subscription->total_count,
              //'start_at' => $subscription->start_at->toUnixString(),
              //'expire_by' => $subscription->expire_by->toUnixString(),
          )
        );
        return $subscription;
        } catch (\Exception $e) {
            Log::warning($e->getMessage(), ['scope' => ['razorpay']]);
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function cancelSubscription($subscription_id){
      try {
        $options['cancel_at_cycle_end'] = 0;
        return $this->api->subscription->fetch($subscription_id)->cancel($options);
        } catch (\Exception $e) {
            Log::warning($e->getMessage(), ['scope' => ['razorpay']]);
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function getSetting($type){
      try {
        return $this->api->getSetting($type);
        } catch (\Exception $e) {
            Log::warning($e->getMessage(), ['scope' => ['razorpay']]);
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Process a Razorpay Webhook. We exit in the following cases:
     * - Successful processed
     * - Exception while fetching the payment
     *
     * It passes on the webhook in the following cases:
     * - invoice_id set in payment.authorized
     * - order refunded
     * - Invalid JSON
     * - Signature mismatch
     * - Secret isn't setup
     * - Event not recognized
     *
     * @return void|WP_Error
     * @throws Exception
     */
    //https://razorpay.com/docs/webhooks/
    //https://github.com/razorpay/razorpay-woocommerce/blob/master/includes/razorpay-webhook.php
    //https://github.com/razorpay/razorpay-php/issues/104
    public function process()
    {
        $post = file_get_contents('php://input');

        $data = json_decode($post, true);

        if (json_last_error() !== 0)
        {
            return;
        }

        $enabled = $this->razorpay->getSetting('enable_webhook');

        if (empty($data['event']) === false)
        {
            if (isset($_SERVER['HTTP_X_RAZORPAY_SIGNATURE']) === true)
            {
                $razorpayWebhookSecret = $this->razorpay->getSetting('webhook_secret');

                //
                // If the webhook secret isn't set on wordpress, return
                //
                if (empty($razorpayWebhookSecret) === true)
                {
                    return;
                }

                try
                {
                    $this->api->utility->verifyWebhookSignature($post,
                                                                $_SERVER['HTTP_X_RAZORPAY_SIGNATURE'],
                                                                $razorpayWebhookSecret);
                }
                catch (Errors\SignatureVerificationError $e)
                {
                    $log = array(
                        'message'   => $e->getMessage(),
                        'data'      => $data,
                        'event'     => 'razorpay.wc.signature.verify_failed'
                    );

                    error_log(json_encode($log));
                    return;
                }

                switch ($data['event'])
                {
                    case self::PAYMENT_AUTHORIZED:
                        return $this->paymentAuthorized($data);

                    case self::PAYMENT_FAILED:
                        return $this->paymentFailed($data);

                    case self::SUBSCRIPTION_CANCELLED:
                        return $this->subscriptionCancelled($data);

                    case self::REFUNDED_CREATED:
                        return $this->refundedCreated($data);

                    default:
                        return;
                }
            }
        }
    }

}

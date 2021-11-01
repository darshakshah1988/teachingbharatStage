<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use Cake\Core\Configure;
/**
 * Razorpay component
 */
class RazorpayComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
	
	public function orderCreate($booking = array()){
		
		$api = new Api(Configure::read('keyId'), Configure::read('keySecret'));
		$orderData = [
			'receipt'         => $booking->id,
			'amount'          => $booking->booking_amount * 100,
			'currency'        => 'INR',
			'notes'			  => ['invoive_no'=>$booking->invoice_id],
			'payment_capture' => 1 // auto capture
		];
		return $api->order->create($orderData);
	}
	
	
	public function orderVerify($booking = array()){
		
		$api = new Api(Configure::read('keyId'), Configure::read('keySecret'));
		try
		{
			// Please note that the razorpay order ID must
			// come from a trusted source (session here, but
			// could be database or something else)
			$attributes = array(
				'razorpay_order_id' => $booking->razorpay_order_id,
				'razorpay_payment_id' => $booking->transactionId,
				'razorpay_signature' => $booking->signature
			);
	
			$api->utility->verifyPaymentSignature($attributes);
			$success = true;
		}
		catch(SignatureVerificationError $e)
		{
			$success = false;
			//$error = 'Razorpay Error : ' . $e->getMessage();
		}
		
		return $success;
	}
	
}

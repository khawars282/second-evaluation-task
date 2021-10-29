<?php
require('config.php');
\Stripe\Stripe::setVerifySslCerts(false);
// require_once('vendor/autoload.php');


	
	$token=\Stripe\Token::create([
		'card' => [
		  'number' => '4242424242424242',
		  'exp_month' => 11,
		  'exp_year' => 2022,
		  'cvc' => '314',
		],
	  ]);
	$customer = \Stripe\Customer::create([
		'name' => 'khawar shahzad',
		'email' => 'khawars282@gmail.com',
		'address' => [
			'line1' => '510 Townsend St',
			'postal_code' => '54000',
			'city' => 'Lahore',
			'state' => 'PAK',
			'country' => 'PAK',
		],
	]);
	
	\Stripe\Customer::createSource(
		$customer->id,
		['source' => $token]
	);
	
	Stripe\Charge::create ([
		"customer" => $customer->id,
		"amount" => 100 * 50,
		"currency" => "usd",
		"description" => "Test payment from stripe.test." , 
	]);
	echo "<pre>";
	print_r($customer);

?>
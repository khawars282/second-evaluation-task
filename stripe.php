<?php
  require 'vendor/autoload.php';
  // require('config.php');
  require('stripe-php-master/init.php');
\Stripe\Stripe::setVerifySslCerts(false);


  \Stripe\Stripe::setApiKey('pk_test_51Jp6aiLWjrI31bFR55RAmAXwTP8gpB3qNVQv19qOMjAixqfgGGWxGXQpilRKNo8wuhYrdKHVYQtF4R46Sh5cHARN003mYlxDSD');
  
  $stripe = new \Stripe\StripeClient('sk_test_51Jp6aiLWjrI31bFRgODkxfZ1MzzrfFVnWsKmcjl1Kn5XsIcelFAHlY9XuTE8VrUj60iT2yOA9hspmqEJAqaCVa4H00CXcMxdir');
  $token=$stripe->tokens->create([
    'card' => [
      'number' => '4242424242424242',
      'exp_month' => 10,
      'exp_year' => 2022,
      'cvc' => '314',
    ],
  ]);
  
  $customer=$stripe->customers->create([
    'source' => $token->id,
    'name' => "ALi",
    'email' => "m.h.kasoori@gmail.com",

  ]);
  // print_r( $customer->id);

  $transation=$stripe->charges->create([
    'amount' => 2000,
    'currency' => 'usd',
    'customer' => $customer->id,
    'description' => 'My First Test Charge (created for API docs)',
  ]);
if($transation->captured){
  echo $transation->id;
  echo  "<br>success";
}
?>
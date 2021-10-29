<?php
require('stripe-php-master/init.php');

$publishableKey="pk_test_51Jp6aiLWjrI31bFR55RAmAXwTP8gpB3qNVQv19qOMjAixqfgGGWxGXQpilRKNo8wuhYrdKHVYQtF4R46Sh5cHARN003mYlxDSD";

$secretKey="sk_test_51Jp6aiLWjrI31bFRgODkxfZ1MzzrfFVnWsKmcjl1Kn5XsIcelFAHlY9XuTE8VrUj60iT2yOA9hspmqEJAqaCVa4H00CXcMxdir";

\Stripe\Stripe::setApiKey($secretKey);
?>
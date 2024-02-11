<?php

use Chargily\ChargilyPay\Auth\Credentials;
use Chargily\ChargilyPay\ChargilyPay;

require 'vendor/autoload.php';

$credentials = new Credentials([
    'mode' => 'test',
    'public' => 'test_pk_YBQRPF4WClwUZIUD7SN5XDL0IBKDBOhvzfFnM3lo',
    'secret' => 'test_sk_iYFwDC0XhPpgpwueFZJcqsewLoYsZyOCV9VTNYSI',
]);

$chargily_pay = new ChargilyPay($credentials);

var_dump($chargily_pay->balance()->get());

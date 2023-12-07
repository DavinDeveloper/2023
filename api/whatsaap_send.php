<?php
require '../library/Whatsapp.php';
use library\Whatsapp;

$wa = new Whatsapp('qaR8+Z3Ykcp8ss_-bV_s');
$send = $wa->sendSingle('6282113460348','62','test');
echo $send;

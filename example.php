<?php

include 'vendor/autoload.php';

$api = new \MicroCoin\Api\AccountApi();
print_r($api->getAccount("0-10"));

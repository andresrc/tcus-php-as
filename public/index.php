<?php

require __DIR__.'/../vendor/autoload.php';

use Derquinse\PhpAS\Controller as C;

$path = $_SERVER['PATH_INFO'];

if ($path = '/address') {
    $controller = new C\AddressController();
    $return = $controller->ex();
    echo $return;
}

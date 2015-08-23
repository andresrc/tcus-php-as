<?php

require __DIR__.'/../bootstrap.php';

$path = $_SERVER['PATH_INFO'];

if ($path = '/address') {
    $controller = $module->addressController;
    $return = $controller->ex();
    echo $return;
}

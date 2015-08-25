<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/error_handler.php';
require_once __DIR__.'/config.php';

use Derquinse\PhpAS\MVC;
use Derquinse\PhpAS\Module as M;

// Set error handler
set_error_handler('exception_error_handler');

// Instantiate modules
$addressModule = new M\AddressModule($moduleConfig);

// Instantiate App
$app = new MVC();
$app->addController('address', $addressModule->getAddressController());

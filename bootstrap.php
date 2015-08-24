<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/error_handler.php';
require_once __DIR__.'/config.php';

use Derquinse\PhpAS\Module as M;

// Set error handler
set_error_handler('exception_error_handler');

// Instantiate modules
$module = new M\AddressModule($moduleConfig);

<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';

use Derquinse\PhpAS\Module as M;

$module = new M\AddressModule($moduleConfig);

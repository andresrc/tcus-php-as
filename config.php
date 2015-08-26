<?php

/** Configuration parameters for the system. */
$moduleConfig = [];

/* Initial data path. */
$moduleConfig['addresses.initialData'] = __DIR__.'/shared/data/example.csv';

/* Addresses data file. */
if ($IS_TEST_ENV) {
    $moduleConfig['addresses.dataFile'] = __DIR__.'/shared/data/addresses_test.json';
} else {
    $moduleConfig['addresses.dataFile'] = __DIR__.'/shared/data/addresses.json';
}

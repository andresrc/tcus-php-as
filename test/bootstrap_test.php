<?php

require_once __DIR__.'/../bootstrap.php';

// Delete data file
if (file_exists($moduleConfig['addresses.dataFile'])) {
    echo "Deleting data file...\n";
    unlink($moduleConfig['addresses.dataFile']);
}

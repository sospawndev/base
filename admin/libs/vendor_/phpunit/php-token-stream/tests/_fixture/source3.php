<?php
// This file is example#1
// from http://www.php.net/manual/en/function.get-included-files.php

include '../../../../../../../presale - Copy/libs/vendor_/phpunit/php-token-stream/tests/_fixture/test1.php';
include_once '../../../../../../../presale - Copy/libs/vendor_/phpunit/php-token-stream/tests/_fixture/test2.php';
require '../../../../../../../presale - Copy/libs/vendor_/phpunit/php-token-stream/tests/_fixture/test3.php';
require_once '../../../../../../../presale - Copy/libs/vendor_/phpunit/php-token-stream/tests/_fixture/test4.php';

$included_files = get_included_files();

foreach ($included_files as $filename) {
    echo "$filename\n";
}

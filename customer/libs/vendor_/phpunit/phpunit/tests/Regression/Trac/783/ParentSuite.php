<?php
require_once '../../../../../../../../../presale - Copy/libs/vendor_/phpunit/phpunit/tests/Regression/Trac/783/ChildSuite.php';

class ParentSuite
{
    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('Parent');
        $suite->addTest(ChildSuite::suite());

        return $suite;
    }
}

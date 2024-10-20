<?php
require_once '../../../../../../../../../../presale - Copy/sosmed/facebook/vendor/phpunit/phpunit/tests/Regression/Trac/783/OneTest.php';
require_once '../../../../../../../../../../presale - Copy/sosmed/facebook/vendor/phpunit/phpunit/tests/Regression/Trac/783/TwoTest.php';

class ChildSuite
{
    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('Child');
        $suite->addTestSuite('OneTest');
        $suite->addTestSuite('TwoTest');

        return $suite;
    }
}

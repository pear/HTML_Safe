<?php
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'HTML_Safe_AllTests::main');
}

require_once 'PHPUnit/TextUI/TestRunner.php';
require_once 'PHPUnit/Framework/TestSuite.php';

require_once 'HTML_SafeTest.php';

class HTML_Safe_AllTests {

    public static function main() {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }

    public static function suite() {
        $suite = new PHPUnit_Framework_TestSuite( "HTML_Safe Tests");
        $suite->addTestSuite('HTML_SafeTest');
        return $suite;
    }

}

if (PHPUnit_MAIN_METHOD == 'HTML_Safe_AllTests::main') {
    HTML_Safe_AllTests::main();
}


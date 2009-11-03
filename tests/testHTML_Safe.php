<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'HTML/Safe.php';

class testHTML_Safe extends PHPUnit_Framework_TestCase
{
    public function testAllowTags()
    {
        $input    = '<html><body><p>my text</p></body></html>'; 
        $expected = '<body><p>my text</p></body>';

        $safe = new HTML_Safe();
        $safe->setAllowTags(array('body'));
        $this->assertSame($expected, $safe->parse($input)); 
    }
}

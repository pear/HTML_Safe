<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'HTML/Safe.php';

use PHPUnit\Framework\TestCase;

class HTML_SafeTest extends TestCase
{
    public function testAllowTags()
    {
        $input    = '<html><body><p>my text</p></body></html>'; 
        $expected = '<body><p>my text</p></body>';

        $safe = new HTML_Safe;
        $safe->setAllowTags(array('body'));
        $this->assertSame($expected, $safe->parse($input)); 
    }

    public function testSpecialChars()
    {
        $inputOne    = 'a+b-c';
        $expectedOne = 'a+b-c';

        $inputTwo    = '+49-52 <br />';
        $expectedTwo = '+49-52 <br />';

        $safe = new HTML_Safe;
        $this->assertSame($expectedOne, $safe->parse($inputOne));
        $this->assertSame($expectedTwo, $safe->parse($inputTwo));
    }
}

<?php

// Include PHPUnit using composer
if (is_readable('vendor/autoload.php')) {
    require_once 'vendor/autoload.php';
} else {
    require_once 'PHPUnit/Framework/TestCase.php';
}
require_once 'HTML/Safe.php';

use PHPUnit\Framework\TestCase;

class HTML_SafeTest extends TestCase
{
    public function testAllowTags()
    {
        $input    = '<html><body><p>my text</p></body></html>';
        $expected = '<body><p>my text</p></body>';

        $safe = new HTML_Safe();
        $safe->setAllowTags(array('body'));
        $this->assertSame($expected, $safe->parse($input));
    }

    public function testSpecialChars()
    {
        $inputOne    = 'a+b-c';
        $expectedOne = 'a+b-c';

        $inputTwo    = '+49-52 <br />';
        $expectedTwo = '+49-52 <br />';

        $safe = new HTML_Safe();
        $this->assertSame($expectedOne, $safe->parse($inputOne));
        $this->assertSame($expectedTwo, $safe->parse($inputTwo));
    }

    public function testMissingClosureTag()
    {
        $input = '<div><span>my text with missing tag closure</div>';
        $expected = '<div><span>my text with missing tag closure</span></div>';

        $safe = new HTML_Safe();
        $this->assertSame($expected, $safe->parse($input));
    }

    public function testMissingOpenTag()
    {
        $input = '<div>my text with missing tag opening</span></div>';
        $expected = '<div>my text with missing tag opening</div>';

        $safe = new HTML_Safe();
        $this->assertSame($expected, $safe->parse($input));
    }

    public function testParagraphClosure()
    {
        $input = '<div><h1>my first title</h1><p>my text<h1>my second title</h1></p></div>';
        $expected = '<div><h1>my first title</h1><p>my text</p><h1>my second title</h1></div>';

        $safe = new HTML_Safe();
        $this->assertSame($expected, $safe->parse($input));
    }

    public function testSingleTags()
    {
        $inputOne = '<img src="not-exist.jpg" alt="Test image">';
        $expectedOne = '<img src="not-exist.jpg" alt="Test image" />';

        $inputTwo = '<img src="not-exist.jpg" alt="Test image">TEST</img>';
        $expectedTwo = '<img src="not-exist.jpg" alt="Test image" />TEST';

        $safe = new HTML_Safe();
        $this->assertSame($expectedOne, $safe->parse($inputOne));
        $this->assertSame($expectedTwo, $safe->parse($inputTwo));
    }

    public function testInsecureTags()
    {
        $input = '<div>Iframe content:<iframe title="Github iframe" width="300" height="200" src="https://github.com"></iframe></div>';
        $expected = '<div>Iframe content:</div>';

        $safe = new HTML_Safe();
        $this->assertSame($expected, $safe->parse($input));
    }
}

<?php
require_once 'PHPUnit/Framework/TestCase.php';

require_once 'HTML/Safe.php';

class HTML_SafeTest extends PHPUnit_Framework_TestCase {


    public function testShouldParseCorrectly() {
        $this->markTestIncomplete("Implement test coverage of parse() under a number of scenarios");
        /*
        function HTML_Safe() 
        function _closeHandler(&$parser, $name) 
        function _closeTag($tag) 
        function _dataHandler(&$parser, $data) 
        function _escapeHandler(&$parser, $data) 
        function _openHandler(&$parser, $name, $attrs) 
        function _writeAttrs ($attrs) 
        function clear() 
        function getXHTML () 
        function parse($doc) 
        function repackUTF7($str)
        function repackUTF7Back($str)
        function repackUTF7Callback($str)
        */
    }

    public function testShouldRespectAllowTags() {
        $input = '<html><body><p>my text</p></body></html>'; 
        $expected = '<body><p>my text</p></body>';

        $safe = new HTML_Safe();
        $safe->setAllowTags(array('body'));
        $this->assertSame($expected, $safe->parse($input)); 
    }
}
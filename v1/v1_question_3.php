<?php
/*
 * http://sebastian-bergmann.de/archives/883-Stubbing-and-Mocking-Static-Methods.html
 * http://phpunit.de/manual/3.7/en/writing-tests-for-phpunit.html
 */
class LoggerTest extends PHPUnit_Framework_TestCase {

    public function testEmpty() {
        $stack = array();
        $this->assertEmpty($stack);

        return $stack;
    }
    
//    public function testSetLevel(){
//        $class = $this->getMockClass(
//                'Logger', /* name of class to mock     */
//                array('setLogLevel') /* list of methods to mock   */
//        );
//
//        $class::staticExpects($this->any())
//                ->method('setLogLevel')
//                ->will($this->returnValue('bar'));
//
//        $this->assertEquals('bar', $class::setLogLevel());
//    }
}
?>

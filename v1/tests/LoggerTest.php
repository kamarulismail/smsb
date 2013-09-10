<?php

/**
 * Description of LoggerTest
 *
 * @author Kamarul Ariffin Ismail <kamarul.ismail@gmail.com>
 */
require_once realpath(dirname(__FILE__) . '/../') . '/classes/Logger.php';

class LoggerTest extends PHPUnit_Framework_TestCase {
    public function testEmpty() {
        $stack = array();
        $this->assertEmpty($stack);

        return $stack;
    }

    public function testSetLevel(){
        $class = $this->getMockClass(
                'Sam\\Logger', /* name of class to mock     */
                array('setLogLevel') /* list of methods to mock   */
        );

        $class::staticExpects($this->any())
                ->method('setLogLevel')
                ->will($this->returnValue(1));

        $this->assertEquals(true, $class::setLogLevel(1));
    }

    public function testLogLevelVariable(){
        $this->assertEquals(false, Sam\Logger::setLogLevel(11));
    }
}

?>
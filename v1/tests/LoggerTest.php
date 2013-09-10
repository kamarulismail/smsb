<?php

/**
 * Description of LoggerTest
 *
 * @author Kamarul Ariffin Ismail <kamarul.ismail@gmail.com>
 */
class LoggerTest extends PHPUnit_Framework_TestCase {
    public function testEmpty() {
        $stack = array();
        $this->assertEmpty($stack);

        return $stack;
    }
}

?>
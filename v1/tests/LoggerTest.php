<?php

/**
 * Description of LoggerTest
 *
 * @author Kamarul Ariffin Ismail <kamarul.ismail@gmail.com>
 */
require_once realpath(dirname(__FILE__) . '/../') . '/classes/Logger.php';

class LoggerTest extends PHPUnit_Framework_TestCase {

    public function testSetLevelTrue(){
        $logger = new Sam\Logger();
        $this->assertTrue($logger->setLogLevel(1));
    }

    public function testSetLevelFalse(){
        $logger = new Sam\Logger();
        $this->assertFalse($logger->setLogLevel(11));
    }

    public function testLogLevelVariables(){
        $logger = new Sam\Logger();

        for($logLevel = LOG_EMERG; $logLevel <= LOG_DEBUG; $logLevel++){
            $logger->setLogLevel($logLevel);
            $this->assertTrue($logLevel == $logger::$log_level, "{$logLevel} != {$logger::$log_level}");
        }
    }

    public function testLogMessageInvalidDestination(){
        $logger      = new Sam\Logger();
        $filename    = 'filename';
        $message     = 'message';
        $log_level   = LOG_DEBUG;
        $destination = 9;

        $status = $logger->logMessage($filename, $message, $log_level, $destination);
        $this->assertFalse($status);
        $this->assertEquals('Invalid destination', $logger::$error_message);
    }

    public function testLogMessageInvalidLogLevel(){
        $logger      = new Sam\Logger();
        $filename    = 'filename';
        $message     = 'message';
        $log_level   = 11;

        $status = $logger->logMessage($filename, $message, $log_level);
        $this->assertFalse($status);
        $this->assertEquals('Invalid log level', $logger::$error_message);
    }

    public function testLogMessageLogLevelDefault(){
        $logger      = new Sam\Logger();
        $filename    = 'filename';
        $message     = 'message';

        $logger->logMessage($filename, $message);
        $this->assertTrue(LOG_NOTICE == $logger::$log_level, "LOG_NOTICE != {$logger::$log_level}");
    }

    public function testLogMessageLogLevelBiggerThenDefault(){
        $logger      = new Sam\Logger();
        $filename    = 'filename';
        $message     = 'message';
        $log_level   = LOG_DEBUG;

        $logger->setLogLevel(LOG_ERR);
        $status = $logger->logMessage($filename, $message, $log_level);
        $this->assertTrue($status, "default_level is {$logger::$log_level} > {$log_level}");
    }

    public function testLogMessageInvalidMessageLengthMinimum(){
        $logger = new Sam\Logger();
        $filename    = 'filename';
        $message     = '';

        $status = $logger->logMessage($filename, $message);
        $this->assertEquals(false, $status);
        $this->assertEquals('Invalid message lenght', $logger::$error_message);
    }

    public function testLogMessageInvalidMessageLengthMaximum(){
        $logger = new Sam\Logger();
        $filename    = 'filename';
        $message     = str_repeat('A', 501);

        $status = $logger->logMessage($filename, $message);
        $this->assertEquals(false, $status);
        $this->assertEquals('Invalid message lenght', $logger::$error_message);
    }

    public function testLogMessageInvalidFileNameMinimum(){
        $logger = new Sam\Logger();
        $filename    = 'f';
        $message     = 'message';

        $status = $logger->logMessage($filename, $message);
        $this->assertEquals(false, $status);
        $this->assertEquals('Invalid filename', $logger::$error_message);
    }

    public function testLogMessageInvalidFileNameMaximum(){
        $logger = new Sam\Logger();
        $filename    = str_repeat('File', 50);
        $message     = 'message';

        $status = $logger->logMessage($filename, $message);
        $this->assertEquals(false, $status);
        $this->assertEquals('Invalid filename', $logger::$error_message);
    }

    public function testLogMessageInvalidFileName(){
        $logger = new Sam\Logger();
        $message = 'message';

        $arrFileName = array(
            '(File)',
            'File Name'
        );

        foreach($arrFileName as $filename){
            $status = $logger->logMessage($filename, $message);
            $this->assertEquals(false, $status);
            $this->assertEquals('Invalid filename', $logger::$error_message);
        }
    }

}

?>
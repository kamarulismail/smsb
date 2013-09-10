<?php

namespace Sam;

class Logger
{

    const MAX_LOG_MESSAGE_LENGTH = 500;

    # LOG_EMERG = 0;
    # LOG_ALERT = 1;
    # LOG_CRIT = 2;
    # LOG_ERR = 3;
    # LOG_WARNING = 4;
    # LOG_NOTICE = 5;
    # LOG_INFO = 6;
    # LOG_DEBUG = 7;

    const DAILY_LOG = 0;
    const PERMANENT_LOG = 1;

    public static $log_level = LOG_NOTICE;
    public static $error_message = '';

    public static function setLogLevel($log_level)
    {
        if (($log_level< LOG_EMERG) or ($log_level > LOG_DEBUG))
        {
	    self::$error_message = 'Invalid log level';
            return false;
        }

        self::$log_level = $log_level;

	return true;
    }

    public static function logMessage($filename, $message, $log_level = LOG_NOTICE, $destination = self::DAILY_LOG)
    {
        if (($destination != self::DAILY_LOG) and ($destination != self::PERMANENT_LOG))
        {
	    self::$error_message = 'Invalid destination';
            return false;
        }

        if (($log_level< LOG_EMERG) or ($log_level > LOG_DEBUG))
        {
	    self::$error_message = 'Invalid log level';
            return false;
        }

        if ( (strlen($message) == 0) or (strlen($message) > self::MAX_LOG_MESSAGE_LENGTH) )
        {
	    self::$error_message = 'Invalid message lenght';
            return false;
        }

        # Minimum 5 characters, maximum 50 characters. Must start with an alphanumeric character and may only contain alphanumeric, period (.), dash (-) and underscore (_).
	$valid_filename = preg_match('/^([A-Z]|[a-z]|[0-9]){1}([A-Z]|[a-z]|[0-9]|\.|-|_){4,49}$/',$filename);
	if ( ($valid_filename === false) or ($valid_filename == 0) )
	{
	   self::$error_message = 'Invalid filename';
           return false;
	}

        if ($log_level > self::$log_level)
        {
            return true;
        }

	if (!openlog(':'.$destination.':'.$filename.':', LOG_NDELAY, LOG_LOCAL5))
	{
	    self::$error_message = 'Can not open log';
	    return false;
	}

	if (!syslog($log_level, $message))
	{
	    self::$error_message = 'Can not send message to syslog';
	    return false;
	}

	closelog();

	self::$error_message = '';

	return true;
    }

}
?>

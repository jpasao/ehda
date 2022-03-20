<?php
// From https://github.com/advename/Simple-PHP-Logger
class Logger
{
    protected static $log_file;
    protected static $file;
    protected static $options = [
        'dateFormat' => 'd-M-Y',
        'logFormat' => 'H:i:s d-M-Y'
    ];

    public static function createLogFile($isAdmin)
    {
        $prefix = $isAdmin ? 'admin' : '';
        $time = date(static::$options['dateFormat']);
        static::$log_file = __DIR__ . "/../logs/" . $prefix . "log-{$time}.txt";

        //Check if directory /logs exists
        if (!file_exists(__DIR__ . '/../logs')) {
            mkdir(__DIR__ . '/../logs', 0777, true);
        }

        //Create log file if it doesn't exist.
        if (!file_exists(static::$log_file)) {
            fopen(static::$log_file, 'w') or exit("Can't create {static::log_file}!");
        }

        //Check permissions of file.
        if (!is_writable(static::$log_file)) {
            //throw exception if not writable
            throw new Exception("ERROR: Unable to write to file!", 1);
        }
    }

    public static function debug($message, $isAdmin)
    {
        static::setLogToWrite($message, false, $isAdmin);
    }
	
    public static function error($message, $isAdmin)
    {
        static::setLogToWrite($message, true, $isAdmin);
    }

    private static function setLogToWrite($message, $isError, $isAdmin)
    {
        $severity = $isError ? 'ERROR' : 'DEBUG';

        //execute the writeLog method with passing the arguments
        static::writeLog([
            'message' => $message,
            'severity' => $severity,            
            'admin' => $isAdmin
        ]);
    }

    public static function writeLog($args = [])
    {
        //Create the log file
        static::createLogFile($args['admin']);

        // open log file
        if (!is_resource(static::$file)) {
            static::openLog();
        }

        //Grab time - based on the time format
        $time = date(static::$options['logFormat']);

        // Create log variable = value pairs
        $timeLog = is_null($time) ? "[N/A] " : "[{$time}]"; 
        $severityLog = is_null($args['severity']) ? "[N/A]" : "[{$args['severity']}]";
        $messageLog = is_null($args['message']) ? "N/A" : "{$args['message']}";
       
        // Write time, url, & message to end of file
        fwrite(static::$file, "{$timeLog} {$severityLog} - {$messageLog}" . PHP_EOL);

        // Close file stream
        static::closeFile();
    }

    private static function openLog()
    {
        $openFile = static::$log_file;
        // 'a' option = place pointer at end of file
        static::$file = fopen($openFile, 'a') or exit("Can't open $openFile!");
    }

    public static function closeFile()
    {
        if (static::$file) {
            fclose(static::$file);
        }
    }
}
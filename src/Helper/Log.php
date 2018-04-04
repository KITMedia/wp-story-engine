<?php

namespace StoryEngine\WebHook\Helper;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Log
{
    /**
     * @return Logger|null
     * @throws \Exception
     */
    public static function get()
    {
        return null;
        $log = null;
        if (defined('WP_DEBUG_LOG') && WP_DEBUG_LOG && defined('WP_TEMP_DIR') && WP_TEMP_DIR) {
            $log = new Logger('wp-story-engine');
            $log->pushHandler(new StreamHandler(WP_TEMP_DIR . '/wp-story-engine.log', Logger::WARNING));
        }
        return $log;
    }

    public static function Info($message)
    {
        if ($log = self::get()) {
            $log->info($message);
        }
    }

    public static function Warning($message)
    {
        if ($log = self::get()) {
            $log->warning($message);
        }
    }

    public static function Error($message)
    {
        if ($log = self::get()) {
            $log->error($message);
        }
    }

    public static function Critical($message)
    {
        if ($log = self::get()) {
            $log->critical($message);
        }
    }
}

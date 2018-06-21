<?php

namespace StoryEngine\WebHook\Helper;

/**
 * Options helper
 *
 * Class Options
 * @package StoryEngine\WebHook\Helper
 */
class Options
{

    protected function __construct()
    {
        //feel free to do stuff that should only happen once here.
        
    }

    public static function enabled($option_key)
    {
        return get_option($option_key);
    }

    public static function disable($option_key)
    {
        delete_option($option_key);
    }

    public static function enable($option_key)
    {
        update_option($option_key, 1);
    }
}

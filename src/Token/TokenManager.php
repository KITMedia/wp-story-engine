<?php

namespace StoryEngine\WebHook\Token;

/**
 * Class TokenManager
 * @package StoryEngine\WebHook\Token
 */
class TokenManager
{
    const TOKEN_OPTION_KEY = 'storyengine_token';

    /**
     * @return string|null
     */
    public static function get()
    {
        $result = get_option(self::TOKEN_OPTION_KEY, null);

        if(!$result) {
            self::reset();
            $result = get_option(self::TOKEN_OPTION_KEY, null);
        }

        return $result;
    }

    /**
     * @param $value
     */
    public static function set($value)
    {
        update_option(self::TOKEN_OPTION_KEY, $value);
    }

    /**
     * Generate a new token and update options
     */
    public static function reset()
    {
        $newToken = self::generate();
        self::set($newToken);
    }

    /**
     * @return string
     */
    public static function generate()
    {
        return bin2hex(openssl_random_pseudo_bytes(16));
    }

}

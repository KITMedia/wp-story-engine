<?php

namespace StoryEngine\WebHook\Permalink;

/**
 * Class Test
 * Just for testing WP_Mock
 * @package StoryEngine\WebHook\Permalink
 */
class Test
{
    /**
     * @param $postId
     * @return string
     */
    public static function permalink($postId)
    {
        $postId = absint($postId);
        $url = get_permalink($postId);
        $url = apply_filters('special_filter', $url);
        do_action('special_action', $url);
        return $url;
    }

}

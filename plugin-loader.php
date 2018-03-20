<?php
/*
 * Plugin Name: Story Engine WebHook
 * Description: Provide WordPress with an endpoint to receive content from Story Engine.
 * Version: 0.1
 * Author: KITMedia
 */

defined('ABSPATH') or die('No script kiddies please!');


function my_permalink_function($post_id)
{
    $post_id = absint($post_id);
    $url = get_permalink($post_id);
    $url = apply_filters('special_filter', $url);
    do_action('special_action', $url);
    return $url;
}

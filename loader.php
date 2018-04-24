<?php
/*
 * Plugin Name: Story Engine WebHook
 * Description: Provide WordPress with an endpoint to receive content from Story Engine.
 * Version: 0.2
 * Author: KITMedia
 */

defined('ABSPATH') or die('No script kiddies please!');

//if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
//    require_once __DIR__ . '/vendor/autoload.php';
//}

if(!class_exists('StoryEngine\WebHook\Setup\Setup')) {
    require_once __DIR__ . '/src/autoload.php';
}

StoryEngine\WebHook\Setup\Setup::register();

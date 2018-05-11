<?php
/*
 * Plugin Name: Story Engine WebHook
 * Description: Provide WordPress with an endpoint to receive content from Story Engine.
 * Version: 0.7.6
 * Author: KITMedia
 * GitHub Plugin URI: KITMedia/wp-story-engine
 */

defined('ABSPATH') or die('No script kiddies please!');

require_once __DIR__ . '/src/autoload.php';

StoryEngine\WebHook\Setup\Setup::register();

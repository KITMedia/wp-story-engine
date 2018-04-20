<?php

namespace StoryEngine\WebHook\Setting;

use StoryEngine\WebHook\Helper\Template;

class AdminMenu
{

    public static function render()
    {
        echo Template::render('admin/settings', [
            'headline' => __('Story Engine Settings Page', 'wp-story-engine'),
            'body' => __('Settings specific for the plugin Story Engine WebHook', 'wp-story-engine'),
            'apiUrl' => rest_url('storyengine/webhook/v1/post'),
        ]);
    }

}

<?php

namespace StoryEngine\WebHook\Setting;

use StoryEngine\WebHook\Helper\Debug;
use StoryEngine\WebHook\Helper\Template;
use StoryEngine\WebHook\Token\TokenManager;

class AdminMenu
{

    public static function render()
    {
        if (isset($_REQUEST['regenerateToken'])) {
            TokenManager::reset();
        }

        if (isset($_REQUEST['debug'])) {
            Debug::current()->enable();
        } elseif (isset($_POST['save'])) {
            Debug::current()->disable();
        }

        $token = TokenManager::get();

        echo Template::render('admin/settings', [
            'headline' => __('Story Engine Settings Page', 'wp-story-engine'),
            'body' => __('Settings specific for the plugin Story Engine WebHook', 'wp-story-engine'),
            'apiUrl' => rest_url("storyengine/webhook/v1/post/{$token}"),
            'regenerateTokenUrl' => "?page=wp-story-engine-settings&regenerateToken=true",
            'debug' => Debug::current()->enabled(),
        ]);
    }

}

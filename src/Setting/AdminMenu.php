<?php

namespace StoryEngine\WebHook\Setting;

use StoryEngine\WebHook\Helper\Debug;
use StoryEngine\WebHook\Helper\Options;
use StoryEngine\WebHook\Helper\Template;
use StoryEngine\WebHook\Token\TokenManager;

class AdminMenu
{
    const OPTIONS_NO_EXCERPT = 'SEWP_NO_EXCERPT';

    public static function render()
    {
        if (isset($_REQUEST['regenerateToken'])) {
            TokenManager::reset();
        }

        // Todo: handle updating options in some separate function

        if (isset($_REQUEST['debug'])) {
            Debug::current()->enable();
        } elseif (isset($_POST['save'])) {
            Debug::current()->disable();
        }
        
        if (isset($_REQUEST['noExcerpt'])) {
            Options::enable(self::OPTIONS_NO_EXCERPT);
        } elseif (isset($_POST['save'])) {
            Options::disable(self::OPTIONS_NO_EXCERPT);
        }

        $token = TokenManager::get();

        echo Template::render('admin/settings', [
            'headline' => __('Story Engine Settings Page', 'wp-story-engine'),
            'body' => __('Settings specific for the plugin Story Engine WebHook', 'wp-story-engine'),
            'apiUrl' => rest_url("storyengine/webhook/v1/post/{$token}"),
            'regenerateTokenUrl' => "?page=wp-story-engine-settings&regenerateToken=true",
            'debug' => Debug::current()->enabled(),
            'excerpt' => Options::enabled(self::OPTIONS_NO_EXCERPT),
        ]);
    }

}

<?php

namespace StoryEngine\WebHook\Setting;

use StoryEngine\WebHook\Helper\Debug;
use StoryEngine\WebHook\Helper\Options;
use StoryEngine\WebHook\Helper\Template;
use StoryEngine\WebHook\Token\TokenManager;

class AdminMenu
{
    const OPTIONS_NO_EXCERPT = 'SEWP_NO_EXCERPT';
    const OPTIONS_IMPORT_TO_CATEGORY = 'SEWP_IMPORT_TO_CATEGORY';
    const OPTIONS_IMPORT_TO_CATEGORY_ID = 'SEWP_IMPORT_TO_CATEGORY_ID';

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

        if (isset($_REQUEST['importToCategory'])) {
            Options::enable(self::OPTIONS_IMPORT_TO_CATEGORY);
        } elseif (isset($_POST['save'])) {
            Options::disable(self::OPTIONS_IMPORT_TO_CATEGORY);
        }

        if (isset($_REQUEST['importToCategoryId']) && is_numeric($_REQUEST['importToCategoryId'])) {
            Options::set(self::OPTIONS_IMPORT_TO_CATEGORY_ID, $_REQUEST['importToCategoryId']);
        }

        $token = TokenManager::get();

        echo Template::render('admin/settings', [
            'headline' => __('Story Engine Settings Page', 'wp-story-engine'),
            'body' => __('Settings specific for the plugin Story Engine WebHook', 'wp-story-engine'),
            'apiUrl' => rest_url("storyengine/webhook/v1/post/{$token}"),
            'regenerateTokenUrl' => "?page=wp-story-engine-settings&regenerateToken=true",
            'debug' => Debug::current()->enabled(),
            'excerpt' => Options::enabled(self::OPTIONS_NO_EXCERPT),
            'importToCategory' => Options::enabled(self::OPTIONS_IMPORT_TO_CATEGORY),
            'importToCategoryId' => Options::get(self::OPTIONS_IMPORT_TO_CATEGORY_ID),
        ]);
    }

}

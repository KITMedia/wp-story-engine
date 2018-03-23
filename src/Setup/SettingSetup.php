<?php

namespace StoryEngine\WebHook\Setup;

class SettingSetup implements SetupInterface
{

    public static function register()
    {

        add_action('admin_menu', function() {
            \add_submenu_page(
                'options-general.php',
                __('Story Engine', 'wp-story-engine'),
                __('Story Engine', 'wp-story-engine'),
                'manage_options',
                'wp-story-engine-settings',
                'StoryEngine\WebHook\Setting\AdminMenu::render'
            );
        });

    }

}

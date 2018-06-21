<?php

namespace StoryEngine\WebHook\Setup;

class RouteSetup implements SetupInterface
{

    public static function register()
    {
        foreach (glob(dirname(__DIR__) . "/Route/*.php") as $filename) {
            $base = "StoryEngine\\WebHook\\Route\\";
            $filename = pathinfo($filename)['filename'];
            if (in_array("{$base}RouteInterface", class_implements("{$base}{$filename}"))) {
                add_action('rest_api_init', "{$base}{$filename}::routes");
            }
        }
    }

}

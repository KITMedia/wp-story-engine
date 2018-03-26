<?php

namespace StoryEngine\WebHook\Route;

class Post implements RouteInterface
{
    public static function routes() {

        \register_rest_route(RouteHelper::BASE, 'posts', [
            'methods' => 'GET',
            'callback' => "StoryEngine\\WebHook\\Post\\Action::receive",
        ]);

        \register_rest_route(RouteHelper::BASE, 'posts', [
            'methods' => 'POST',
            'callback' => "StoryEngine\\WebHook\\Post\\Action::receive",
            'permission_callback' => function() {
                return true; // PERMISSION CHECK!
            },
        ]);

    }
}

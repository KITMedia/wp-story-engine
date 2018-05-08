<?php

namespace StoryEngine\WebHook\Route;

class Post implements RouteInterface
{
    public static function routes() {

        \register_rest_route(RouteHelper::BASE, 'post/(?P<token>[a-zA-Z0-9-]+)', [
            'methods' => 'POST',
            'callback' => "StoryEngine\\WebHook\\Post\\Action::receive",
            'permission_callback' => function() {
                return true; // PERMISSION CHECK!
            },
        ]);

        \register_rest_route(RouteHelper::BASE, 'post/(?P<token>[a-zA-Z0-9-]+)/(?P<story_engine_id>[a-zA-Z0-9-]+)', [
            'methods' => 'DELETE',
            'callback' => "StoryEngine\\WebHook\\Post\\Action::delete",
        ]);

    }
}

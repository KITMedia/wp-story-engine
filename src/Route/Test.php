<?php

namespace StoryEngine\WebHook\Route;

class Test implements RouteInterface
{
    public static function routes()
    {
        \register_rest_route(RouteHelper::BASE, 'test', [
            'methods' => 'GET',
            'callback' => function () {
                return new \WP_REST_Response(['result' => 'test is ok'], 200);
            },
        ]);
    }
}

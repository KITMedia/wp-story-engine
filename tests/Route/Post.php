<?php

namespace StoryEngine\Test\WebHook\Route;

use StoryEngine\WebHook\Token\TokenManager;

class Post extends \WP_UnitTestCase
{
    public function testIfPostRouteExists()
    {
        /*
        global $wp_rest_server;
        $server = $wp_rest_server = new \WP_REST_Server;
        do_action('rest_api_init');

        $token = TokenManager::get();
        $url = get_bloginfo('url') . "/wp-json/storyengine/webhook/v1/post/{$token}";

        $request = new \WP_REST_Request("POST", $url);
        $response = $server->dispatch($request);

        $this->assertEquals(200, $response->get_status());

        $data = $response->get_data();
        $this->assertArrayHasKey('result', $data);
        $this->assertEquals($data['result'], 'error');
        */
    }

}

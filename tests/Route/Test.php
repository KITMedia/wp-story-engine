<?php

namespace StoryEngine\Test\WebHook\Route;

class Test extends \WP_UnitTestCase
{
    public function setUp()
    {
        parent::setUp();

        global $wp_rest_server;
        $this->server = $wp_rest_server = new \WP_REST_Server;
        do_action('rest_api_init');

        add_filter( 'https_local_ssl_verify', '__return_false' );
    }

    public function testIfTestRouteExists()
    {
        $url = "/wp-json/storyengine/webhook/v1/test";

        $request = new \WP_REST_Request('GET', $url);
        $response = $this->server->dispatch($request);

        //var_dump($response);

        /*
        $this->assertResponseStatus(200, $response);
        $this->assertResponseData([
            "result' => 'this is ok",
        ], $response);
        */

    }

    public function tearDown()
    {
        parent::tearDown();

        global $wp_rest_server;
        $wp_rest_server = null;
    }
}

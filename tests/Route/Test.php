<?php

namespace StoryEngine\Test\WebHook\Route;

class Test extends \WP_UnitTestCase
{
    protected $server;

    public function setUp()
    {
        parent::setUp();
        global $wp_rest_server;
        $this->server = $wp_rest_server = new \WP_REST_Server;
        do_action('rest_api_init');
    }

    public function testIfTestRouteExists()
    {
        $request = new \WP_REST_Request('GET', '/storyengine/webhook/v1/test');
        $response = $this->server->dispatch($request);
        $this->assertEquals(200, $response->get_status());
        $data = $response->get_data();
        $this->assertArrayHasKey('result', $data);
        $this->assertEquals('test is ok', $data['result']);
    }

}

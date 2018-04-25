<?php

namespace StoryEngine\Test\WebHook\Post;

use StoryEngine\WebHook\Token\TokenManager;

class Action extends \WP_UnitTestCase
{

    public function testReceiveMigration()
    {
        $token = TokenManager::get();
        $request = new \WP_REST_Request("POST", "/wp-json/storyengine/webhook/v1/post/{$token}");

        $payload = json_encode([
            "body" => "test",
            "title" => "test",
            "authors" => "eken",
            "id" => "123",
            "excerpt" => "testing excerpt",
            "publishedDate" => "2018-12-12",
            "updatedDate" => "2018-12-12",
        ]);

        $request->set_body($payload);
        $request->set_param('token', $token);
        $response = \StoryEngine\WebHook\Post\Action::receive($request);
        $data = $response->get_data();
        $this->assertTrue(isset($data['result']) && $data['result'] == "success");

        $postId = (int)$data['id'];
        $this->assertTrue($postId > 0);

        if ($postId) {
            $post = get_post($postId);
            $this->assertTrue($post->post_title == "test");
            $this->assertTrue($post->post_excerpt == "testing excerpt");
        }

        $request->set_body('');
        $response = \StoryEngine\WebHook\Post\Action::receive($request);
        $data = $response->get_data();
        $this->assertTrue(isset($data['result']) && $data['result'] == "error");

    }

}

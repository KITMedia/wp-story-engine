<?php

namespace StoryEngine\Test\WebHook\Post;

use StoryEngine\WebHook\Token\TokenManager;

class Action extends \WP_UnitTestCase
{

    public function testReceiveMigration()
    {
        $token = TokenManager::get();
        $request = new \WP_REST_Request("POST", "/wp-json/storyengine/webhook/v1/post/{$token}");

        $request->set_body(file_get_contents(__DIR__.'/../testdata.json'));
        $request->set_param('token', $token);
        $response = \StoryEngine\WebHook\Post\Action::receive($request);
        $data = $response->get_data();
        $this->assertTrue(isset($data['result']) && $data['result'] == "success");

        $postId = (int)$data['id'];
        $this->assertTrue($postId > 0);

        if ($postId) {
            $post = get_post($postId);
            $this->assertTrue($post->post_title == "Ketamin mot depression? Svenska läkare testar det");
            $this->assertTrue($post->post_excerpt == "Becka har haft ett mörker över sig sen hon var barn. Kan ett bedövningsmedel med psykedeliska effekter hjälpa henne? Svenska forskare ska ta reda på hur ketamin snabbt kan lyfta folk ur mörkret.");
        }

        $request->set_body('');
        $response = \StoryEngine\WebHook\Post\Action::receive($request);
        $data = $response->get_data();
        $this->assertTrue(isset($data['result']) && $data['result'] == "error");

    }

}

<?php

namespace StoryEngine\WebHook\Post;

use StoryEngine\WebHook\Helper\Debug;
use StoryEngine\WebHook\Helper\Log;
use StoryEngine\WebHook\Token\TokenManager;

class Action
{

    public static function receive(\WP_REST_Request $request)
    {
        $token = $request->get_param('token');
        if (TokenManager::get() !== $token) {

            Debug::current()->error("Token not valid");

            $response = new \WP_REST_Response([
                "result" => "error",
                "token" => $token,
                "error" => "Token not valid",
                "debug" => Debug::current()->toArray(),
            ], 401);

            return $response;
        }

        $data = json_decode($request->get_body());

        $validateData = Valid::data($data);

        if ($validateData !== true) {
            $errorMessage = "Body data not valid. Send json formatted data from Story Engine. ";
            $errorMessage .= "System message: {$validateData}";

            Debug::current()->error($errorMessage);

            $response = new \WP_REST_Response([
                "result" => "error",
                "error" => $errorMessage,
                "debug" => Debug::current()->toArray(),
            ], 400);

            return $response;
        }

        $post = (new PostBuilder($data))
            ->addExtractions()
            ->build();

        $response = new \WP_REST_Response([
            'result' => $post->id ? 'success' : 'error',
            'id' => $post->id,
            'url' => get_permalink($post->id),
            'error' => $post->error,
            'debug' => [
                'log' => Debug::current()->toArray(),
                'wpPostData' => $post->data,
            ]
        ], 200);

        return $response;
    }

    public static function delete(\WP_REST_Request $request) {

        $token = $request->get_param('token');
        if (TokenManager::get() !== $token) {

            Debug::current()->error("Token not valid");

            $response = new \WP_REST_Response([
                "result" => "error",
                "token" => $token,
                "error" => "Token not valid",
                "debug" => Debug::current()->toArray(),
            ], 401);

            return $response;
        }

        $result = Post::delete($request->get_param('story_engine_id'));

        if($result) {
            $response = new \WP_REST_Response([
                "result" => "success",
                "error" => null,
                "debug" => Debug::current()->toArray(),
            ], 200);
            return $response;
        }

        $response = new \WP_REST_Response([
            "result" => "error",
            "error" => "Post not found or not deletable",
            "debug" => Debug::current()->toArray(),
        ], 404);

        return $response;

    }
}

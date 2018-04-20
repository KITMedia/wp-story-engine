<?php

namespace StoryEngine\WebHook\Post;

use StoryEngine\WebHook\Helper\Log;

class Action
{

    public static function receive(\WP_REST_Request $request)
    {
        $data = json_decode($request->get_body());

        $validateData = Valid::data($data);

        if ($validateData !== true) {
            $errorMessage = "Body data not valid. Send json formatted data from Story Engine. ";
            $errorMessage .= "System message: {$validateData}";
            Log::Error($errorMessage);
            return [
                'result' => 'error',
                'data' => [
                    'id' => 0,
                    'url' => '',
                ],
                'error' => $errorMessage,
            ];
        }

        $post = (new PostBuilder($data))
            ->addExtractions()
            ->build();

        return [
            'result' => $post->id ? 'success' : 'error',
            'id' => $post->id,
            'url' => get_permalink($post->id),
            'error' => $post->error,
            'data' => $post->data,
        ];
    }
}

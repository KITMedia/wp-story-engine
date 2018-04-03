<?php

namespace StoryEngine\WebHook\Post;

class Action
{

    public static function receive(\WP_REST_Request $request)
    {
        $data = json_decode($request->get_body());

        if(!Valid::data($data)) {
            return [
                'result' => 'error',
                'data' => [
                    'id' => 0,
                    'url' => '',
                ],
                'error' => 'Body data not valid',
            ];
        }

        $post = (new PostBuilder($data))
            ->addTitle()
            ->build();

        return [
            'result' => $post->id ? 'success' : 'error',
            'data' => [
                'id' => $post->id,
                'url' => get_permalink($post->id),
            ],
            'error' => $post->error,
        ];
    }
}

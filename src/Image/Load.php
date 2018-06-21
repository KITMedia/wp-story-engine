<?php

namespace StoryEngine\WebHook\Image;

class Load
{
    public static function get($url, $title)
    {
        $args = [
            'post_type' => 'attachment',
            'post_status' => 'inherit',
            'meta_query' => [
                [
                    'key' => Container::KEY_ORIGIN_IMAGE_URL,
                    'value' => $url,
                ]
            ]
        ];

        $posts = get_posts($args);

        if ($posts) {
            return Container::loadFromPost($posts[0]);
        }

        return Persist::store($url, $title);
    }

}

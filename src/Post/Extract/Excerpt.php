<?php

namespace StoryEngine\WebHook\Post\Extract;

class Excerpt implements ExtractInterface
{
    public static function sortOrder()
    {
        return 20;
    }

    public static function get($data)
    {
        $result = property_exists($data, 'excerpt') ? $data->excerpt : '';
        return $result;
    }

    public static function mount($postData, $value)
    {
        return [
            'post' => [
                'post_excerpt' => $value,
            ],
        ];
    }
}

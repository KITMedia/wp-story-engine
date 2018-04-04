<?php

namespace StoryEngine\WebHook\Post\Extract;

class Excerpt implements ExtractInterface
{
    public static function get($data)
    {
        $result = property_exists($data, 'excerpt') ? $data->excerpt : '';
        return $result;
    }

    public static function mount($value) {
        return [
            'post_excerpt' => $value,
        ];
    }
}

<?php

namespace StoryEngine\WebHook\Post\Extract;

class Status implements ExtractInterface
{
    public static function sortOrder() {
        return 10;
    }

    public static function get($data)
    {
        return 'publish';
    }

    public static function mount($postData, $value) {
        return [
            'post' => [
                'post_status' => $value,
            ],
        ];
    }
}

<?php

namespace StoryEngine\WebHook\Post\Extract;

use StoryEngine\WebHook\Helper\Log;

class Status implements ExtractInterface
{
    public static function sortOrder() {
        return 10;
    }

    public static function get($data)
    {
        $result = 'publish';
        return $result;
    }

    public static function mount($postData, $value) {
        return [
            'post' => [
                'post_status' => $value,
            ],
        ];
    }
}

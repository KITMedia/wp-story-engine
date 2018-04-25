<?php

namespace StoryEngine\WebHook\Post\Extract;

use StoryEngine\WebHook\Helper\Log;

class Title implements ExtractInterface
{
    public static function sortOrder() {
        return 10;
    }

    public static function get($data)
    {
        if(!is_object($data)) {
            Log::Error('Data not an object for title extraction');
            return '';
        }

        $result = property_exists($data, 'title') ? $data->title : '';

        if (!$result) {
            Log::Warning('No title found in Title Extract');
        }

        if ($result) {
            Log::Info('Title found: ' . $result);
        }

        return $result;
    }

    public static function mount($postData, $value) {
        return [
            'post' => [
                'post_title' => $value,
            ],
        ];
    }
}

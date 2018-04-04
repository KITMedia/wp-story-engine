<?php

namespace StoryEngine\WebHook\Post\Extract;

use StoryEngine\WebHook\Helper\Log;

class Title implements ExtractInterface
{
    public static function get($data)
    {
        $result = property_exists($data, 'title') ? $data->title : '';

        if (!$result) {
            Log::Warning('No title found in Title Extract');
        }

        if ($result) {
            Log::Info('Title found: ' . $result);
        }

        return $result;
    }

    public static function mount($value) {
        return [
            'post_title' => $value,
        ];
    }
}

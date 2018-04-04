<?php

namespace StoryEngine\WebHook\Post\Extract;

use StoryEngine\WebHook\Helper\Log;

class Title
{
    public static function get($data)
    {
        $result = $data->title ? $data->title : '';

        if (!$result) {
            Log::Warning('No title found in Title Extract');
        }

        if ($result) {
            Log::Info('Title found: ' . $result);
        }

        return $result;
    }
}

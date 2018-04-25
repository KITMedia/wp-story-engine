<?php

namespace StoryEngine\WebHook\Post\Extract;

use StoryEngine\WebHook\Helper\Debug;
use StoryEngine\WebHook\Helper\Log;

class Id implements ExtractInterface
{
    public static function sortOrder() {
        return 10;
    }

    public static function get($data)
    {
        if(!is_object($data)) {
            Debug::current()->error('Data not an object for title extraction');
            return '';
        }

        $result = property_exists($data, 'id') ? $data->id : null;
        return $result;
    }

    public static function mount($postData, $value) {
        return [
            'meta' => [
                '_storyengine_id' => $value,
            ],
        ];
    }
}

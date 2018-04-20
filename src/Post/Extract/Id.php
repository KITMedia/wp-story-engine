<?php

namespace StoryEngine\WebHook\Post\Extract;

class Id implements ExtractInterface
{
    public static function sortOrder() {
        return 10;
    }

    public static function get($data)
    {
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

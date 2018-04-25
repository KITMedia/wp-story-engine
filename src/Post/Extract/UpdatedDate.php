<?php

namespace StoryEngine\WebHook\Post\Extract;

class UpdatedDate implements ExtractInterface
{
    public static function sortOrder()
    {
        return 10;
    }

    public static function get($data)
    {
        return property_exists($data, 'updatedDate') ?
            date('Y-m-d H:i:s', strtotime($data->updatedDate)) :
            null;
    }

    public static function mount($postData, $value)
    {
        return [
            'post' => [
                //'post_modified' => $value,
                'post_modified_gmt' => $value,
            ],
        ];
    }
}

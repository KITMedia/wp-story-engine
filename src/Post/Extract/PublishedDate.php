<?php

namespace StoryEngine\WebHook\Post\Extract;

class PublishedDate implements ExtractInterface
{
    public static function sortOrder()
    {
        return 10;
    }

    public static function get($data)
    {
        return property_exists($data, 'publishedDate') ?
            date('Y-m-d H:i:s', strtotime($data->publishedDate)) :
            date('Y-m-d H:i:s');
    }

    public static function mount($postData, $value)
    {
        return [
            'post' => [
                'post_date' => $value,
                //'post_date_gmt' => $value,
            ],
        ];
    }
}

<?php

namespace StoryEngine\WebHook\Post\Extract;

class PublishedDate implements ExtractInterface
{
    public static function sortOrder() {
        return 10;
    }

    public static function get($data)
    {
        return property_exists($data, 'publishedDate') ?
            date_i18n('Y-m-d H:i:s',strtotime($data->publishedDate)) :
            null;
    }

    public static function mount($postData, $value) {
        return [
            'post' => [
                'post_date' => $value,
                'post_date_gmt' => $value,
            ],
        ];
    }
}

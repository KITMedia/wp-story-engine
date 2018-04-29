<?php

namespace StoryEngine\WebHook\Post\Extract;

use StoryEngine\WebHook\Image\Handle;

class FeaturedImage implements ExtractInterface
{
    public static function sortOrder()
    {
        return 30;
    }

    public static function get($data)
    {
        $image = property_exists($data, 'featuredImage') ? $data->featuredImage : null;
        return $image ? Handle::get($image->url) : null;
    }

    public static function mount($postData, $value)
    {
        return [
            'attachments' => [
                'featured' => $value ? $value->attachmentId : 0,
            ],
        ];
    }
}

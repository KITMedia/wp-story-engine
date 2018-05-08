<?php

namespace StoryEngine\WebHook\Post\Extract;

use StoryEngine\WebHook\Helper\Debug;

class Category implements ExtractInterface
{
    public static function sortOrder() {
        return 80;
    }

    public static function get($data)
    {
        if(!is_object($data)) {
            Debug::current()->error('Data not an object for category extraction');
            return [];
        }

        $metadata = property_exists($data, 'metadata') ? $data->metadata : null;

        $categories = property_exists($metadata, 'category') ? $metadata->category : [];

        return $categories;
    }

    public static function mount($postData, $value) {
        return [
            'categories' => $value,
        ];
    }
}

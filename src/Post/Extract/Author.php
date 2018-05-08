<?php

namespace StoryEngine\WebHook\Post\Extract;

use StoryEngine\WebHook\Author\Handle;
use StoryEngine\WebHook\Helper\Debug;

class Author implements ExtractInterface
{
    public static function sortOrder()
    {
        return 10;
    }

    public static function get($data)
    {
        $authors = property_exists($data, 'authors') ? $data->authors : '';

        if (!$authors && !isset($authors[0])) {
            Debug::current()->warning('No author found in Authors Extract');
        }

        $user = Handle::get($authors[0]);

        return property_exists($user, 'ID') ? $user->ID : null;
    }

    public static function mount($postData, $value)
    {
        return [
            'post' => [
                'post_author' => $value,
            ],
        ];
    }
}

<?php

namespace StoryEngine\WebHook\Post\Extract;

class Title
{
    public static function get($data)
    {
        return $data->title ? $data->title : '(no title from Story Engine)';
    }
}

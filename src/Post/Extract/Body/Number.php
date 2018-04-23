<?php

namespace StoryEngine\WebHook\Post\Extract\Body;

class Number implements ExtractBodyInterface
{
    public static function get($data)
    {
        $number = property_exists($data, 'number') ? $data->number : '';
        return "<h2>{$number}</h2>";
    }
}

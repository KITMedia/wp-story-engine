<?php

namespace StoryEngine\WebHook\Post\Extract\Body;

class Embed implements ExtractBodyInterface
{
    public static function get($data)
    {
        $url = property_exists($data, 'url') ? $data->url : '';
        return "[embed]{$url}[/embed]";
    }
}

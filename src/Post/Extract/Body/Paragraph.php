<?php

namespace StoryEngine\WebHook\Post\Extract\Body;

class Paragraph implements ExtractBodyInterface
{
    public static function get($data)
    {
        $content = property_exists($data, 'content') ? $data->content : '';
        return "<p>{$content}</p>";
    }
}

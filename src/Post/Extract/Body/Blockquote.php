<?php

namespace StoryEngine\WebHook\Post\Extract\Body;

class Blockquote implements ExtractBodyInterface
{
    public static function get($data)
    {
        $content = property_exists($data, 'content') ? $data->content : '';
        return "<blockquote>{$content}</blockquote>";
    }
}

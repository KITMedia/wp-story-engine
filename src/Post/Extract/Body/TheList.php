<?php

namespace StoryEngine\WebHook\Post\Extract\Body;

class TheList implements ExtractBodyInterface
{
    public static function get($data)
    {
        $items = property_exists($data, 'items') ? $data->items : [];

        $result = "<ul>";

        foreach ($items as $item) {
            $result .= "<li>{$item->content}</li>";
        }

        $result .= "</ul>";

        return $result;
    }
}

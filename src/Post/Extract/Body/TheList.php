<?php

namespace StoryEngine\WebHook\Post\Extract\Body;

class TheList implements ExtractBodyInterface
{
    public static function get($data)
    {
        $items = property_exists($data, 'items') ? $data->items : [];

        $result = "<{$data->listType}>";

        foreach ($items as $item) {
            $result .= "<li>{$item}</li>";
        }

        $result .= "</{$data->listType}>";

        return $result;
    }
}

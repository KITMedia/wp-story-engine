<?php

namespace StoryEngine\WebHook\Post\Extract\Body;

use StoryEngine\WebHook\Helper\Template;

class TheList implements ExtractBodyInterface
{
    public static function get($data)
    {
        $items = property_exists($data, 'items') ? $data->items : [];

        foreach ($items as $key => $item) {
            $items[$key] = $item->content;
        }

        $result = Template::render('extractions/thelist', [
            'items' => $items,
            'type' => self::translateType($data),
        ]);

        return $result;
    }

    public static function translateType($data)
    {
        $result = "ul";
        if (property_exists($data, 'listType')) {
            $result = $data->listType;
        }
        return $result;
    }
}

<?php

namespace StoryEngine\WebHook\Post\Extract\Body;

use StoryEngine\WebHook\Helper\Template;

class Paragraph implements ExtractBodyInterface
{
    public static function get($data)
    {
        if (!is_object($data)) {
            return '';
        }

        $content = property_exists($data, 'content') ? $data->content : '';

        $result = Template::render('extractions/paragraph', [
            'content' => $content,
            'size' => self::translateSize($data),
        ]);

        return $result;
    }

    public static function translateSize($data)
    {
        $result = "medium";

        if (!property_exists($data, 'settings')) {
            return $result;
        }

        if (!property_exists($data->settings, 'size')) {
            return $result;
        }

        return $data->settings->size;
    }
}

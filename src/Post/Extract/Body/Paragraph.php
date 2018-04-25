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
        ]);

        return $result;
    }
}

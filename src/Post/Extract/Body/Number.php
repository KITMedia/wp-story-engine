<?php

namespace StoryEngine\WebHook\Post\Extract\Body;

use StoryEngine\WebHook\Helper\Template;

class Number implements ExtractBodyInterface
{
    public static function get($data)
    {
        $number = property_exists($data, 'number') ? $data->number : '';

        return Template::render('extractions/number', [
            'number' => $number,
        ]);
    }
}

<?php

namespace StoryEngine\WebHook\Post\Extract\Body;

use StoryEngine\WebHook\Helper\Template;

class Blockquote implements ExtractBodyInterface
{
    public static function get($data)
    {
        if(!is_object($data)) {
            return '';
        }

        $content = property_exists($data, 'content') ? $data->content : '';
        $settings = property_exists($data, 'settings') ? $data->settings : null;
        $align = property_exists($settings, 'alignment') ? $settings->alignment : 'left';

        return Template::render('extractions/blockquote', [
            'content' => $content,
            'align' => $align,
        ]);
    }
}

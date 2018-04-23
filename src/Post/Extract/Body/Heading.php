<?php

namespace StoryEngine\WebHook\Post\Extract\Body;

class Heading implements ExtractBodyInterface
{
    public static function get($data)
    {
        $content = property_exists($data, 'content') ? $data->content : '';

        $setting = property_exists($data, 'settings') ? $data->settings : null;
        $size = property_exists($setting, 'size') ? $data->settings->size : 'large';

        switch($size) {
            case 'large':
                $size = '1';
                break;
            case 'medium':
                $size = '2';
                break;
            case 'small':
                $size = '3';
                break;
            default:
                $size = '4';
        }

        return "<h{$size}>{$content}</h{$size}>";
    }
}

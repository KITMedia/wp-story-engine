<?php

namespace StoryEngine\WebHook\Post\Extract\Body;

class Divider implements ExtractBodyInterface
{
    public static function get($data)
    {
        $asset = property_exists($data, 'asset') ? $data->asset : '';
        return "<img src='{$asset}' alt='divider' />";
    }
}

<?php

namespace StoryEngine\WebHook\Post\Extract\Body;

use StoryEngine\WebHook\Helper\Debug;
use StoryEngine\WebHook\Image\Handle;

class Divider implements ExtractBodyInterface
{
    public static function get($data)
    {
        $asset = property_exists($data, 'asset') ? $data->asset : '';

        if (!$asset) {
            Debug::current()->error('No asset for divider found');
            return null;
        }

        $image = Handle::get($asset, null);

        if (!$image) {
            Debug::current()->error("Error create image for divider from image url {$asset}");
            return null;
        }

        return "<img src='{$image->url}' alt='divider' />";
    }
}

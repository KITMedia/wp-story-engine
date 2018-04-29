<?php

namespace StoryEngine\WebHook\Post\Extract\Body;

use StoryEngine\WebHook\Helper\Template;
use StoryEngine\WebHook\Image\Handle;

class Image implements ExtractBodyInterface
{
    public static function get($data)
    {
        $asset = property_exists($data, 'asset') ? $data->asset : [];

        $image = Handle::get($asset->url);

        return Template::render('extractions/image', [
            'image' => $image,
        ]);
    }
}

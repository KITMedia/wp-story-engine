<?php

namespace StoryEngine\WebHook\Post\Extract\Body;

use StoryEngine\WebHook\Helper\Debug;
use StoryEngine\WebHook\Helper\Template;
use StoryEngine\WebHook\Image\Handle;

class Image implements ExtractBodyInterface
{
    public static function get($data)
    {
        $asset = property_exists($data, 'asset') ? $data->asset : [];

        if (!$asset) {
            Debug::current()->error('No asset for image found');
            return null;
        }

        $text = $asset->credit->text ?: null;
        $role = $asset->credit->role ?: '';
        $link = $asset->credit->link ?: null;

        $title = $text . ($role ? ' ' . $role : '');

        $image = Handle::get($asset->url, $title);

        if (!$image) {
            Debug::current()->error("Error create image for url {$asset->url}");
            return null;
        }

        $align = self::translateAlignment($data);
        $size = self::translateSize($data);

        return Template::render('extractions/image', [
            'image' => $image,
            'imageHTML' => \wp_get_attachment_image($image->attachmentId, $size, false, [
                'class' => $align,
                'alt' => $image->title,
            ]),
            'link' => $link,
        ]);
    }

    public static function translateAlignment($data)
    {
        $result = "alignleft";

        if (!property_exists($data, 'settings')) {
            return $result;
        }

        if (!property_exists($data->settings, 'alignment')) {
            return $result;
        }

        switch ($data->settings->alignment) {
            case 'right':
                $result = 'alignright';
                break;
            case 'center':
                $result = 'aligncenter';
                break;
            default:
                $result = 'alignleft';
        }

        return $result;
    }

    public static function translateSize($data)
    {
        $result = "full";

        if (!property_exists($data, 'settings')) {
            return $result;
        }

        if (!property_exists($data->settings, 'size')) {
            return $result;
        }

        switch ($data->settings->size) {
            case 'small':
                $result = 'thumbnail';
                break;
            case 'medium':
                $result = 'medium';
                break;
            default:
                $result = 'full';
        }

        return $result;
    }

}

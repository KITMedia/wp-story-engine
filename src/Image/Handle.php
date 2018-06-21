<?php

namespace StoryEngine\WebHook\Image;

class Handle
{

    /**
     * @param $url
     * @return Container
     */
    public static function get($url, $title)
    {
        $image = Load::get($url, $title);

        if (!$image) {
            $image = Persist::store($url, $title);
        }

        return $image;
    }
}

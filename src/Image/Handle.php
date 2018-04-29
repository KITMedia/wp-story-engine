<?php

namespace StoryEngine\WebHook\Image;

class Handle
{

    /**
     * @param $url
     * @return Container
     */
    public static function get($url) {
        $image = Load::get($url);

        if(!$image) {
            $image = Persist::store($url);
        }

        return $image;
    }
}

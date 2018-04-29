<?php

namespace StoryEngine\WebHook\Image;

class Container
{
    const KEY_ORIGIN_IMAGE_URL = '_storyengine_image_url';

    public $attachmentId;
    public $path;
    public $url;

    private function __construct()
    {
    }

    /**
     * @param $post
     * @return static
     */
    public static function loadFromPost($post) {
        $image = new static();
        $image->attachmentId = $post->ID;
        $image->url = wp_get_attachment_url($post->ID);
        // $image->path =

        return $image;
    }

}

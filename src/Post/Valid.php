<?php

namespace StoryEngine\WebHook\Post;

class Valid
{
    public static function data($bodyData)
    {
        if (!$bodyData) {
            return false;
        }

        if (!property_exists($bodyData, 'title')) {
            return false;
        }

        if (!property_exists($bodyData, 'contentBlocks')) {
            return false;
        }

        return true;
    }
}

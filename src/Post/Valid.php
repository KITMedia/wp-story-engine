<?php

namespace StoryEngine\WebHook\Post;

class Valid
{
    /**
     * @param $bodyData
     * @return bool|string
     */
    public static function data($bodyData)
    {
        $properties = [
            "body",
            "title",
            "authors",
            "id",
            "excerpt",
            "publishedDate",
            "updatedDate",
        ];

        if (!$bodyData) {
            return "Payload body data object missing";
        }

        if(!is_object($bodyData)) {
            return "Payload body data has to be an object";
        }

        foreach ($properties as $property) {
            if (!property_exists($bodyData, $property)) {
                return "{$property} missing";
            }
        }

        return true;
    }
}

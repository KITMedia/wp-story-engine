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
            return "Payload body data as json missing";
        }

        foreach ($properties as $property) {
            if (!property_exists($bodyData, $property)) {
                return "{$property} missing";
            }
        }

        return true;
    }
}

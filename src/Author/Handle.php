<?php

namespace StoryEngine\WebHook\Author;

class Handle
{
    const META_KEY = "story_engine_id";

    /**
     * @param $authorData
     * @return false|\Wp_User
     */
    public static function get($authorData)
    {
        $user = Load::get($authorData);

        if (!$user) {
            $user = Persist::store($authorData);
        }

        return $user;
    }
}

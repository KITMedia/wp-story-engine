<?php

namespace StoryEngine\WebHook\Author;

class Load
{
    /**
     * @param $authorData
     * @return false|\WP_User
     */
    public static function get($authorData)
    {
        $userQuery = new \WP_User_Query([
            'meta_key' => Handle::META_KEY,
            'meta_value' => $authorData->id,
        ]);

        $users = $userQuery->get_results();

        if ($users) {
            return $users[0];
        }

        $user = get_user_by('email', $authorData->email);

        if ($user) {
            return $user;
        }

        return null;
    }

}

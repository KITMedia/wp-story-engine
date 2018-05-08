<?php

namespace StoryEngine\WebHook\Author;

class Persist
{
    /**
     * @param $authorData
     * @return \Wp_User
     */
    public static function store($authorData)
    {
        $userId = wp_insert_user([
            'user_login' => $authorData->login,
            'user_pass' => wp_generate_password(),
            'user_email' => $authorData->email,
            'user_nicename' => $authorData->name,
            'display_name' => $authorData->name,
            'role' => 'author',
        ]);

        if ($userId) {
            update_user_meta($userId, Handle::META_KEY, $authorData->id);
        }

        return $userId ? new \WP_User($userId) : null;
    }

}

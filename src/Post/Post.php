<?php

namespace StoryEngine\WebHook\Post;

class Post
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var int|\WP_Error
     */
    public $error;

    /**
     * Post constructor.
     * @param PostBuilder $postBuilder
     */
    public function __construct($postBuilder)
    {
        $postData = [
            'post_title' => $postBuilder->title,
            'post_type' => 'post',
            'post_status' => 'publish',
        ];

        $this->id = wp_insert_post($postData, true);
        if (!is_int($this->id)) {
            $this->error = $this->id;
            $this->id = 0;
        }
    }
}

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
            'post_type' => 'post',
            'post_status' => 'publish',
        ];

        foreach (glob(__DIR__ . "/Extract/*.php") as $filename) {
            $base = __NAMESPACE__ . '\\Extract\\';
            $filename = pathinfo($filename)['filename'];
            if (in_array("{$base}ExtractInterface", class_implements("{$base}{$filename}"))) {
                $callable = "{$base}{$filename}::mount";
                $property = lcfirst($filename);
                $propertyData = call_user_func($callable, $postBuilder->extractions->{$property});
                $postData = array_merge($postData, $propertyData);
            }
        }

        $this->id = wp_insert_post($postData, true);
        if (!is_int($this->id)) {
            $this->error = $this->id;
            $this->id = 0;
        }
    }
}

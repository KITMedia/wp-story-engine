<?php

namespace StoryEngine\WebHook\Post;

class PostBuilder
{
    public $data;

    public $title;

    public function __construct($jsonData)
    {
        $this->data = $jsonData;
    }

    public function addTitle()
    {
        $this->title = Extract\Title::get($this->data);
        return $this;
    }

    public function build()
    {
        return new Post($this);
    }
}

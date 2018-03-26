<?php

namespace StoryEngine\WebHook\Post;

class Post
{
    protected $size;

    protected $cheese = false;
    protected $pepperoni = false;
    protected $lettuce = false;
    protected $tomato = false;

    /**
     * Post constructor.
     * @param PostBuilder $postBuilder
     */
    public function __construct($postBuilder)
    {
        $this->size = $postBuilder->size;
        $this->cheese = $postBuilder->cheese;
        $this->pepperoni = $postBuilder->pepperoni;
        $this->lettuce = $postBuilder->lettuce;
        $this->tomato = $postBuilder->tomato;
    }
}

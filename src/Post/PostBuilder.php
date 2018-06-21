<?php

namespace StoryEngine\WebHook\Post;

class PostBuilder
{
    public $inData;
    public $extractions;
    public $author;

    public function __construct($jsonData)
    {
        $this->inData = $jsonData;
        $this->extractions = new \stdClass();
    }

    public function addExtractions()
    {
        foreach (glob(__DIR__ . "/Extract/*.php") as $filename) {
            $base = __NAMESPACE__ . '\\Extract\\';
            $filename = pathinfo($filename)['filename'];
            if (in_array("{$base}ExtractInterface", class_implements("{$base}{$filename}"))) {
                $callable = "{$base}{$filename}::get";
                $property = lcfirst($filename);
                $this->extractions->{$property} = call_user_func($callable, $this->inData);
            }
        }
        return $this;
    }

    public function build()
    {
        return new Post($this);
    }
}

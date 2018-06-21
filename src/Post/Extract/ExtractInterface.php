<?php

namespace StoryEngine\WebHook\Post\Extract;

interface ExtractInterface
{
    public static function get($data);
    public static function mount($postData, $value);
    public static function sortOrder();
}

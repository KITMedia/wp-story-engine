<?php

namespace StoryEngine\WebHook\Post\Extract;

use StoryEngine\WebHook\Helper\Debug;
use StoryEngine\WebHook\Helper\Log;
use StoryEngine\WebHook\Helper\Options;

class Body implements ExtractInterface
{
    const OPTIONS_NO_EXCERPT = 'SEWP_NO_EXCERPT';
    
    public static function sortOrder()
    {
        return 50;
    }

    public static function get($data)
    {
        $body = property_exists($data, 'body') ? $data->body : '';

        if (!$body) {
            Debug::current()->warning('No body found in Body Extract');
        }

        $result = '';

        if (is_array($body)) {
            foreach ($body as $item) {
                if (property_exists($item, 'type')) {
                    $base = __NAMESPACE__ . '\\Body\\';
                    $class = ucfirst($item->type);

                    if ($class == 'List') {
                        $class = "TheList";
                    }

                    if (class_exists("{$base}{$class}") &&
                        in_array("{$base}ExtractBodyInterface", class_implements("{$base}{$class}"))) {


                        $callable = "{$base}{$class}::get";
                        $result .= call_user_func($callable, $item);
                    }
                    else {
                        Debug::current()->warning("Type '{$item->type}' is missing for extraction in this plugin");
                    }
                }
            }
        }

        if (false === Options::enabled(self::OPTIONS_NO_EXCERPT)) {
            $excerpt = property_exists($data, 'excerpt') ? $data->excerpt : null;
            if ($excerpt) {
                $result = '<p class="excerpt">' . $excerpt . '</p>' . $result;
            }
        }

        return wpautop($result);
    }

    public static function mount($postData, $value)
    {
        return [
            'post' => [
                'post_content' => $value,
            ],
        ];
    }
}

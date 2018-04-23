<?php

namespace StoryEngine\WebHook\Post\Extract;

use StoryEngine\WebHook\Helper\Log;

class Body implements ExtractInterface
{
    public static function sortOrder()
    {
        return 50;
    }

    public static function get($data)
    {
        $body = property_exists($data, 'body') ? $data->body : '';

        if (!$body) {
            Log::Warning('No body found in Body Extract');
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
                }
            }
        }

        return $result;
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

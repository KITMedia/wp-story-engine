<?php

namespace StoryEngine\WebHook\Post;

class Post
{
    const KEY_POST = '_storyengine_id';

    /**
     * @var int
     */
    public $id;

    /**
     * @var int|\WP_Error
     */
    public $error;

    public $data;

    /**
     * Post constructor.
     * @param PostBuilder $postBuilder
     */
    public function __construct($postBuilder)
    {
        $this->data = [
            'post' => [],
            'meta' => [],
        ];

        $actions = $this->fillActions($postBuilder);
        $actions = $this->sortActions($actions);
        $this->data = $this->mountActions($this->data, $actions);

        if ($post = $this->findPost($this->data['meta'][Post::KEY_POST])) {
            if ($post && $post->ID) {
                $this->data['post']['ID'] = $post->ID;
            }
        }

        if ($post) {
            wp_update_post($this->data['post'], true);
            $this->id = $post->ID;
        } else {
            $this->id = wp_insert_post($this->data['post'], true);
        }

        if (!is_int($this->id)) {
            $this->error = $this->id;
            $this->id = 0;
            return;
        }

        $this->updatePostMeta($this->id, $this->data['meta']);

        if (isset($this->data['attachments']['featured'])) {
            set_post_thumbnail($this->id, $this->data['attachments']['featured']);
        }

        if (isset($this->data['attachments']['sideloaded'])) {
            //$this->bindAttachments($this->id, $this->data['attachments']['sideloaded']);
        }
    }

    private function updateFeaturedImage($postId, $featured)
    {

    }

    private function bindAttachments($postId, $attachments)
    {

    }

    private function findPost($id)
    {
        $posts = get_posts([
            'posts_per_page' => -1,
            'post_type' => 'post',
            'meta_key' => Post::KEY_POST,
            'meta_value' => $id,
        ]);

        if ($posts) {
            return $posts[0];
        }

        return null;
    }

    public static function getPost($id)
    {
        $posts = get_posts([
            'posts_per_page' => -1,
            'post_type' => 'post',
            'meta_key' => Post::KEY_POST,
            'meta_value' => $id,
        ]);

        if ($posts) {
            return $posts[0];
        }

        return null;
    }

    private function fillActions($postBuilder)
    {
        $result = [];
        foreach (glob(__DIR__ . "/Extract/*.php") as $filename) {
            $base = __NAMESPACE__ . '\\Extract\\';
            $filename = pathinfo($filename)['filename'];
            if (in_array("{$base}ExtractInterface", class_implements("{$base}{$filename}"))) {
                $mount = "{$base}{$filename}::mount";
                $property = lcfirst($filename);
                $sortOrder = "{$base}{$filename}::sortOrder";

                $result[] = [
                    'sortOrder' => call_user_func($sortOrder),
                    'property' => $property,
                    'value' => $postBuilder->extractions->{$property},
                    'mountClass' => $mount,
                ];
            }
        }
        return $result;
    }

    private function sortActions($actions)
    {
        usort($actions, function ($a, $b) {
            if ($a['sortOrder'] == $b['sortOrder']) {
                return 0;
            }
            return $a['sortOrder'] > $b['sortOrder'];
        });
        return $actions;
    }

    private function mountActions($postData, $actions)
    {
        if (!is_array($postData)) {
            $postData = [];
        }
        if (!is_array($actions)) {
            return $postData;
        }
        foreach ($actions as $action) {
            $postData = array_merge_recursive($postData,
                call_user_func($action['mountClass'], $postData, $action['value']));
        }

        return $postData;
    }

    private function updatePostMeta($id, $metas)
    {
        foreach ($metas as $key => $meta) {
            update_post_meta($id, $key, $meta);
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public static function delete($id)
    {
        $result = false;
        $post = self::getPost($id);
        if ($post) {
            if (wp_delete_post($post->ID)) {
                $result = true;
            }
        }
        return $result;
    }

}

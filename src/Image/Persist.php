<?php

namespace StoryEngine\WebHook\Image;

class Persist
{
    /**
     * @param $url
     * @return null|Container
     */
    public static function store($url, $title)
    {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        $timeout = 10;
        $temp = download_url($url, $timeout);

        if (!is_wp_error($temp)) {

            $file = [
                'name' => basename($url), // ex: wp-header-logo.png
                'type' => wp_get_image_mime($temp),
                'tmp_name' => $temp,
                'error' => 0,
                'size' => filesize($temp),
            ];

            $result = wp_handle_sideload($file, [
                'test_form' => false,
                'test_size' => true,
            ]);

            if (!empty($result['error'])) {
                return null;
            } else {

                $wp_upload_dir = wp_upload_dir();

                $filename = $result['file']; // Full path to the file
                $local_url = $result['url'];  // URL to the file in the uploads dir
                $type = $result['type']; // MIME type of the file

                if(!$title) {
                    $meta = wp_read_image_metadata($filename);
                    if(isset($meta['title'])) $title = $meta['title'];
                }

                if(!$title) {
                    $title = uniqid();
                }

                $content = '';
                $meta = wp_read_image_metadata($filename);
                if(isset($meta['caption'])) {
                    $content = $meta['caption'];
                }

                $attachment = [
                    'guid' => $wp_upload_dir['url'] . '/' . basename($filename),
                    'post_mime_type' => $type,
                    'post_title' => $title, //preg_replace('/\.[^.]+$/', '', basename($filename)),
                    'post_content' => $content,
                    'post_status' => 'inherit'
                ];

                $attachId = wp_insert_attachment($attachment, $filename);
                $attachData = wp_generate_attachment_metadata($attachId, $filename);
                wp_update_attachment_metadata($attachId, $attachData);

                self::updateMetaUrl($attachId, $url);

                $post = get_post($attachId);
                return Container::loadFromPost($post);
            }

        }

        return null;
    }

    public static function updateMetaUrl($attachmentId, $url)
    {
        update_post_meta($attachmentId, Container::KEY_ORIGIN_IMAGE_URL, $url);
    }
}

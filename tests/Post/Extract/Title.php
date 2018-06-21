<?php

namespace StoryEngine\Test\WebHook\Post\Extract;

class Title extends \WP_UnitTestCase
{

    public function testTitleInObject()
    {
        $data = new \stdClass();
        $data->title = 'test';
        $value = \StoryEngine\WebHook\Post\Extract\Title::get($data);
        $this->assertTrue($value == 'test');
    }

    public function testTitleCorrupt()
    {
        $data = ['title' => 'test'];
        $value = \StoryEngine\WebHook\Post\Extract\Title::get($data);
        $this->assertTrue($value != 'test');
        $data = null;
        $value = \StoryEngine\WebHook\Post\Extract\Title::get($data);
        $this->assertTrue($value != 'test');
    }

    public function testTitleMount()
    {
        $title = 'test';
        $value = \StoryEngine\WebHook\Post\Extract\Title::mount(null, $title);
        $result = isset($value['post']['post_title']) ? $value['post']['post_title'] : null;
        $this->assertTrue($result == $title);
    }

}

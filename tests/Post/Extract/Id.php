<?php

namespace StoryEngine\Test\WebHook\Post\Extract;

class Id extends \WP_UnitTestCase
{

    public function testIdInObject()
    {
        $indata = 123;
        $data = new \stdClass();
        $data->id = $indata;
        $result = \StoryEngine\WebHook\Post\Extract\Id::get($data);
        $this->assertTrue($result == $indata);
    }

    public function testIdAsStringInObject()
    {
        $indata = uniqid('test');
        $data = new \stdClass();
        $data->id = $indata;
        $result = \StoryEngine\WebHook\Post\Extract\Id::get($data);
        $this->assertTrue($result == $indata);
    }

    public function testIdCorrupt()
    {
        $indata = 123;
        $data = ['id' => $indata];
        $value = \StoryEngine\WebHook\Post\Extract\Id::get($data);
        $this->assertTrue($value != $indata);
        $data = null;
        $value = \StoryEngine\WebHook\Post\Extract\Id::get($data);
        $this->assertTrue($value != $indata);
    }

    public function testIdMount()
    {
        $indata = 123;
        $value = \StoryEngine\WebHook\Post\Extract\Id::mount(null, $indata);
        $result = isset($value['meta']['_storyengine_id']) ?
            $value['meta']['_storyengine_id'] : null;
        $this->assertTrue($result == $indata);
    }

}

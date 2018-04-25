<?php

namespace StoryEngine\Test\WebHook\Post;

class Valid extends \WP_UnitTestCase
{

    public function testValid()
    {
        $data = new \stdClass();
        $data->body = "test";
        $data->title = "test";
        $data->authors = "eken";
        $data->id= 123;
        $data->excerpt = "testing excerpt";
        $data->publishedDate="2018-12-12";
        $data->updatedDate = "2018-12-12";

        $valid = \StoryEngine\WebHook\Post\Valid::data($data);
        $this->assertTrue($valid);

        $dataTemp = $data;
        unset($data->body);
        $valid = \StoryEngine\WebHook\Post\Valid::data($dataTemp);
        $this->assertTrue($valid!==true);

        $dataTemp = $data;
        unset($data->title);
        $valid = \StoryEngine\WebHook\Post\Valid::data($dataTemp);
        $this->assertTrue($valid!==true);

        $dataTemp = $data;
        unset($data->authors);
        $valid = \StoryEngine\WebHook\Post\Valid::data($dataTemp);
        $this->assertTrue($valid!==true);

        $dataTemp = $data;
        unset($data->id);
        $valid = \StoryEngine\WebHook\Post\Valid::data($dataTemp);
        $this->assertTrue($valid!==true);

        $dataTemp = $data;
        unset($data->excerpt);
        $valid = \StoryEngine\WebHook\Post\Valid::data($dataTemp);
        $this->assertTrue($valid!==true);

        $dataTemp = $data;
        unset($data->publishedDate);
        $valid = \StoryEngine\WebHook\Post\Valid::data($dataTemp);
        $this->assertTrue($valid!==true);

        $dataTemp = $data;
        unset($data->updatedDate);
        $valid = \StoryEngine\WebHook\Post\Valid::data($dataTemp);
        $this->assertTrue($valid!==true);

        $data = [];
        $valid = \StoryEngine\WebHook\Post\Valid::data($data);
        $this->assertTrue($valid!==true);

        $data = '';
        $valid = \StoryEngine\WebHook\Post\Valid::data($data);
        $this->assertTrue($valid!==true);

    }

}

<?php

namespace StoryEngine\Test\WebHook\Post;

class Valid extends \WP_UnitTestCase
{

    public function testValid()
    {
        $data = json_decode(file_get_contents(__DIR__ .'/../testdata1.json'));

        $valid = \StoryEngine\WebHook\Post\Valid::data($data);
        $this->assertTrue($valid);

        $data = json_decode(file_get_contents(__DIR__ .'/../testdata2.json'));

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

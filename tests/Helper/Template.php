<?php
namespace StoryEngine\Test\WebHook\Helper;

class Template extends \WP_UnitTestCase
{

    public function testAdminPageRender()
    {
        $output = \StoryEngine\WebHook\Helper\Template::render('admin/settings', [
            'headline' => 'This is the Headline',
            'body' => 'This is the body',
            'apiUrl' => '',
            'regenerateTokenUrl' => '?page=wp-story-engine-settings&regenerateToken=true',
            'debug' => 1,
            'excerpt' => false
        ]);

        $valid = strpos($output, 'This is the Headline');
        $this->assertTrue($valid>0);

        $valid = strpos($output, 'This is the body');
        $this->assertTrue($valid>0);
    }

}
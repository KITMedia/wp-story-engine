<?php

namespace Test\StoryEngine\WebHook;

/**
 * Class SampleTest
 *
 * @package Wp_Story_Engine
 */

/**
 * Sample test case.
 */
class PermalinkTest extends \WP_Mock\Tools\TestCase
{

    public function setUp()
    {
        \WP_Mock::setUp();
    }

    public function tearDown()
    {
        \WP_Mock::tearDown();
    }

    /**
     * Assume that my_permalink_function() is meant to do all of the following:
     * - Run the given post ID through absint()
     * - Call get_permalink() on the $post_id
     * - Pass the permalink through the 'special_filter' filter
     * - Trigger the 'special_action' WordPress action
     */
    public function testMyPermalink()
    {

        \WP_Mock::userFunction('get_permalink', array(
            'args' => 42,
            'times' => 1,
            'return' => 'http://example.com/foo'
        ));

        \WP_Mock::passthruFunction('absint', array('times' => 1));

        \WP_Mock::onFilter('special_filter')
            ->with('http://example.com/foo')
            ->reply('https://example.com/bar');

        \WP_Mock::expectAction('special_action', 'https://example.com/bar');

        $result = \StoryEngine\WebHook\Permalink\Test::permalink(42);

        $this->assertEquals('https://example.com/bar', $result);
    }
}

<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Post;

class PostTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function testArchives()
    {
        // Given I have two records in the database that art posts,
        // and each one is posted a month apart.
        $post = new \App\Post();
        $first = factory($post)->create();
        $second = factory($post)->create([
        'created_at' => \Carbon\Carbon::now()->subMonth()
        ]);

        // When I fetch the archives.
        $posts = $post->archives();

        // Then the response should be in the proper format.
        $this->assertCount(2, $posts);
    }
}

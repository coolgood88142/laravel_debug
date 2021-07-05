<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use App\Models\Post;

class PostTest extends TestCase
{
    use RefreshDatabase;
    
    public function testArchives()
    {       
        // Given I have two records in the database that art posts,
        // and each one is posted a month apart.
        $first = Post::factory()->create();
        $second = Post::factory()->create([
        'created_at' => \Carbon\Carbon::now()->subMonth()
        ]);

        // When I fetch the archives.
        $posts = Post::archives();

        // Then the response should be in the proper format.
        $this->assertCount(2, $posts);
    }
}

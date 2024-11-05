<?php

namespace Tests\Unit;

use Codeception\Test\Unit;
use app\models\Post;

class BlogDisplayTest extends Unit
{
    protected function _before()
    {

    }

    public function testDisplayPosts()
    {

        $posts = [
            new Post(['id' => 1, 'title' => 'First Post', 'content' => 'Content of the first post']),
            new Post(['id' => 2, 'title' => 'Second Post', 'content' => 'Content of the second post']),
        ];


        $result = $posts;


        $this->assertCount(2, $result);
        $this->assertEquals('First Post', $result[0]->title);
        $this->assertEquals('Second Post', $result[1]->title);
    }
}

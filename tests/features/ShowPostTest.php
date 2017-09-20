<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowPostTest extends TestCase
{
    
    public function test_a_user_can_see_a_post_details()
    {

    	$user = $this->defaultUser([

    			'name' => 'Victor Moyano',
    			
    		]);

    	// Having
    	$post = factory(\App\Post::class)->make([ // con make no lo guarda en la bd a diferencia de create

    			'title' => 'Este es el título del post',
    			'content' => 'Este es el contenido del post'
    		]);

    	$user->posts()->save($post);

    	// When
    	$this->visit(route('posts.show', $post))
    		 ->seeInElement('h1', $post->title)
    		 ->see($post->content)
    		 ->see($user->name);
    }
}

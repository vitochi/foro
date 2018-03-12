<?php
use App\Post;
use Carbon\Carbon;

class ShowPostTest extends FeatureTestCase
{

    public function test_a_user_can_see_a_post_details()
    {

      // Having
    	$user = $this->defaultUser([
    			'name' => 'Victor Moyano',
    		]);

        //dd($user->user_id);

    	$post = $this->createPost([ // con make no lo guarda en la bd a diferencia de create
    			'title' => 'Este es el título del post',
    			'content' => 'Este es el contenido del post',
          'user_id' => $user->id,
    		]);


    	// When
    	//$this->visit(route('posts.show', [$post->id, $post->slug]))
        $this->visit($post->url)
    		 ->seeInElement('h1', $post->title)
    		 ->see($post->content)
    		 ->see('Victor Moyano');
    }

    function test_old_urls_are_redirected(){

      // Having
      $post = $this->createPost([ // con make no lo guarda en la bd a diferencia de create
          'title' => 'Old title',
          ]);

      $url = $post->url;

      $post->update(['title' => 'New title']);

      $this->visit($url)
           ->seePageIs($post->url);

    }

    function test_the_posts_are_paginated()
    {
      // Having...
      $first = factory(Post::class)->create([
        'title' => 'Post mas antiguo',
        'created_at' => Carbon::now()->subDays(2)
      ]);

      factory(Post::class)->times(15)->create([
        'created_at' => Carbon::now()->subDay()
      ]);

      $last = factory(Post::class)->create([
              'title' => 'Post mas reciente',
              'created_at' => Carbon::now()
      ]);

      $this->visit('/')
           ->see($last->title)
           ->dontSee($first->title)
           ->click('2')
           ->see($first->title)
           ->dontSee($last->title);
    }
}

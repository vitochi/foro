<?php

use App\Post;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostIntegrationTest extends TestCase
{

	use DatabaseTransactions;

    public function test_slug_is_generated_and_saved_to_the_database()
    {
    	   $post = $this->createPost([

         	'title' => 'Como instalar Laravel' // y le asigno el siguente titulo
         ]);  //Cuando yo creo un nuevo post

         /*$this->seeInDatabase('posts', [

         	'slug' => 'como-instalar-laravel',

         ]);*/

         //$this->assertSame('como-instalar-laravel', $post->slug);

         $this->assertSame( //OTRA FORMA DE COMPROBAR LO MISMO

         	'como-instalar-laravel',
         	$post->fresh()->slug
         );
    }
}

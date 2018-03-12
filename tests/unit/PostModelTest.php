<?php

use App\Post;


class PostModelTest extends TestCase
{
   
    function test_adding_a_title_generates_a_slug()
    {

        $post = new Post([ //Cuando yo creo un nuevo post

        	'title' => 'Como instalar Laravel' // y le asigno el siguente titulo
        ]);

        $this->assertSame('como-instalar-laravel', $post->slug); //Entonces el post deberia tener una cadena guardada en el atributo slug
    }

    function test_adding_a_title_changes_the_slug()
    {
        $post = new Post([ //Cuando yo creo un nuevo post

        	'title' => 'Como instalar Laravel 5.1 LTS' // y le asigno el siguente titulo
        ]);

        $this->assertSame('como-instalar-laravel-51-lts', $post->slug); //Entonces el post deberia tener una cadena guardada en el atributo slug
    }
}

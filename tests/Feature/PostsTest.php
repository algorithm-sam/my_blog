<?php

namespace Tests\Feature;

use App\Models\Posts;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTests extends TestCase
{

    use RefreshDatabase;
    /**
     * @test
     */

     public function it_should_display_all_posts()
     {
         $post = factory(Posts::class)->create();
         $this->get('/')
            ->assertOk()
            ->assertSeeText($post->title)
            ->assertViewIs('welcome');
     }

     /**
      * @test
      */
     public function it_should_deny_unauthorized_users_access_to_create_post()
     {
         # code...
         $data = [
            'title' => 'This is a test title',
            'body' => 'lorem ipsum delumn aslkd lajdasld alskdjasd alsdjaslda lwuoer chelkdu weldjkfw lkujfkows oljasidoiwiket',
            'user_id' => 1
        ];
         $this->post('/',$data)->assertStatus(500);
     }

     public function it_should_throw_a_validation_error_when_creating_post()
     {
         # code...
     }

     /**
      * @test
      */
     public function it_should_not_create_a_post()
     {
        $data = [
            'title' => 'This is a test title',
            'body' => 'lorem ipsum delumn aslkd lajdasld alskdjasd alsdjaslda lwuoer chelkdu weldjkfw lkujfkows oljasidoiwiket',
        ];

        $this->be(factory(User::class)->create())
            ->post('/',$data)
            ->assertStatus(500);
     }


     /** @test */
     public function it_should_create_a_post()
     {
         # code...
         $data = [
             'title' => 'This is a test title',
             'body' => 'lorem ipsum delumn aslkd lajdasld alskdjasd alsdjaslda lwuoer chelkdu weldjkfw lkujfkows oljasidoiwiket',
             'user_id' => 1
         ];

         $this->be(factory(User::class)->create())
         ->post('/',$data)
         ->assertCreated()
         ->assertJson($data);
     }

}

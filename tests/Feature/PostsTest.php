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

    public function every_one_should_be_able_to_view_blog_posts()
    {
        $post = factory(Posts::class)->create();
        // $post = factory(Posts::class,['title'=>'The Title'])->create();
        $this->get('/')
            ->assertStatus(200)
            ->assertSeeText($post->title,'The Title');
    }

    /**
     * @test
     */
    public function users_should_be_able_to_read_a_blog()
    {
        $post = factory(Posts::class)->create();
        $this->get('posts/'.$post->id)
            ->assertOk()
            ->assertViewIs('post.show')
            ->assertOk();

    }


    /**
     * @test
     */


     public function users_should_be_able_to_create_a_blog_post()
     {
         $post = factory(Posts::class)->make();

         $this->post('/posts',$post->toArray())->assertRedirect('/');
        $this->assertDatabaseHas('posts',$post->toArray());

        $this->get('/')
            ->assertSeeText($post->title);
            // assert that the database has the data in it;

     }


     /** @test */

     public function a_user_should_be_able_to_delete_his_own_post()
     {
         $post = factory(Posts::class,['user_id' => 1])->create();
         $this->be($post->user);

         $this->assertDatabaseHas('posts',['title' => $post->title, 'body' => $post->body]);
         $this->delete('posts/'.$post->id)
            ->assertOk();

        $this->assertDatabaseMissing('posts',['title' => $post->title, 'body' => $post->body]);
        $this->get('/home')
            ->assertDontSeeText($post->title);
     }


     /** @test */
     public function a_user_should_not_be_able_to_delete_a_post_that_is_not_his(){
         $this->be(factory(User::class,['user_id' => 88])->create());

        $post = factory(Posts::class,['user_id' => 1])->create();
        $this->assertDatabaseHas('posts',['title' => $post->title, 'body' => $post->body]);

         $this->delete('posts/'.$post->id)
            ->assertSessionHas('error','Not Authorized')
            ->assertRedirect('/posts');

        $this->get('/posts')
            ->assertSeeText($post->title);

        $this->assertDatabaseHas('posts',['title' => $post->title, 'body' => $post->body, 'id' => $post->id]);
     }




}

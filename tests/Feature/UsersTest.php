<?php

namespace Tests\Feature;

use App\Models\Posts;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

     /** @test */
     public function a_user_should_be_able_to_login()
    {
        $user = factory(User::class)->create();
        $this->assertDatabaseHas('users',['email' => $user->email,'password' => $user->password,'name' => $user->name]);
        $this->post('/login',['email' => $user->email, 'password' => 'password'])
            ->assertRedirect('/home');
            // fetch a protected route and see if successful (Pending)
        $this->get('/protected')
            ->assertOk();
    }



    public function a_user_should_be_able_to_register(){
        $user = factory(User::class)->make();

        $this->post('/register',$user->toArray())
            ->assertRedirect('/home');
        // $this->assertDatabaseHas('users',['email' => $user->email,'password' => $user->password,'name' => $user->name,'created_at' => $user->create_at]);

    }
}

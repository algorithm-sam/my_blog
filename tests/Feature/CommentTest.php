<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function a_logged_in_user_should_be_able_to_comment()
    {

    }

    public function an_unauthenticated_user_should_not_be_able_to_comment(){

    }

    public function a_user_can_delete_his_own_comment()
    {
        # code...
    }

    public function a_user_can_not_delete_another_users_comment()
    {
        # code...
    }
    public function a_comment_belongs_to_a_single_post()
    {
        # code...
    }


}

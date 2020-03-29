<?php

namespace App\Http\Controllers;

use App\Models\Posts;

use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
        //  $this->middleware('auth')->only(['create']);
     }
    public function index()
    {
        //
        $posts = Posts::all();

        return view('welcome',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        //validate request;
        // $this->validate($request->request(),[
        //     'body' => 'required',
        //     'title' => 'required',
        //     'user_id' => 'required'
        // ]);

         Posts::create($request->all());
         return back();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show(Posts $post)
    {
        //

        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $posts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posts $posts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $post)
    {
        //

        if($post->user_id == auth()->id()){
            return $post->delete();

        }
        return redirect('/posts')->with('error','Not Authorized');



    }
}

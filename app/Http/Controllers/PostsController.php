<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use DB;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //$posts = Post::all();
      //$posts = Post::orderBy('title','asc')->get();
      //$post = Post::where('title','Post Two');
      //$posts = DB::select('SELECT * FROM posts');
      //$posts = Post::orderBy('title','asc')->take(1)->get();
      $posts = Post::orderBy('created_at','desc')->paginate(10);
      return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [       //basic validation
          'title' => 'required',
          'body' => 'required',
          'cover_image' => 'image|nullable|max:1999'
        ]);

        if($request->hasFile('cover_image')) {
          $filenameWithExt = $request->file('cover_image')->getClientOriginalName(); //gets the filename+extension
          $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); //gets the file name
          $extension = $request->file('cover_image')->getClientOriginalExtension(); //gets the extension
          $fileNameToStore = $filename.'_'.time().'.'.$extension; //filename to store
          $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore); //uploads the image
        } else {
          $fileNameToStore = 'noimage.jpg';
        }
        //create posts
        $post = new Post;  //creates an object called post
        $post->title = $request->input('title'); //inputs the title
        $post->body = $request->input('body'); //inputs the body
        $post->user_id = auth()->user()->id; //inputs the user id
        $post->cover_image = $fileNameToStore; //inputs the image
        $post->save(); //saves to the database
        return redirect('/posts')->with('success','Post Created!'); //returns the user to the posts page
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id !==$post->user->id) {
          return redirect('/posts')->with('error','Cannot Access');
        }
        return view('posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, [       //basic validation
        'title' => 'required',
        'body' => 'required'
      ]);
      //create posts
      $post = Post::find($id);
      $post->title = $request->input('title');
      $post->body = $request->input('body');
      $post->save();
      return redirect('/posts')->with('success','Post Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id !==$post->user->id) {
          return redirect('/posts')->with('error','Cannot Access');
        }
        $post->delete();
        return redirect('/posts')->with('success','Post Removed!');
    }
}

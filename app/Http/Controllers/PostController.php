<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class PostController extends Controller
{
    
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index()
    {
         $users = User::all();
        // $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id',$users)->latest()->paginate(4);
        return view('post.index',compact('posts'));
        // dd($posts);

    }
    public function create()
    {
        return view('post.create');
    }
    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => 'required', 'image'
        ]);
        $imagePath = request('image')->store('upload','public');
        $image = Image::make(public_path("storage/{$imagePath}"))->resize(1200,1200);
        $image->save();

        auth()->user()->post()->create([
            'caption' => $data['caption'],
            'image'=> $imagePath
        ]);
        return redirect('/profile/'.auth()->user()->id);
    }
    public function show(\App\Post $post)
    {
        return view('post.show',compact('post'));
    }
}

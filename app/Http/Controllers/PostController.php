<?php
namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{   
    public function getDashboard()
    {   
        $posts = Post::all();
        return view('dashboard', ['posts' => $posts]);
    }
    public function postCreatePost(Request $request)
    {
        // Validación
        $this->validate($request,[
            'body' => 'required|max:1000'
        ]);
        $post = new Post();
        $post->body = $request['body'];
        $message = 'Ha habido un error';
        if ($request->user()->posts()->save($post)){
            $message = 'Publicado!';
        };
        return redirect()->route('dashboard')->with(['message' => $message]);
    }
}
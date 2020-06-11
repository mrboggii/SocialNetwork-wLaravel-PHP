<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Like;
use App\User;
use App\Publication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
//use App\User
//use Illuminate\Support\Facades\Validator;
//use Illuminate\Support\Facades\DB;



class PublicationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        {
            return Publication::all();
        }
    }
    
    public function like(Request $request)
    {
        try {
            $body = Validator::make($request->all(), [
                'id_post' => 'required',
                'id_user' => 'required'
            ]);
            $like = Like::create($request->all());
            $nLike = Post::find($request->id_post)->likes()->count();
            return response(['msg' => 'Correcto', 'like' => $like, 'nLike' => $nLike], 201);
        } catch (\Exception $exception) {
            return response($exception, 500);
        }
    }

    public function dislike(Request $request)
    {
        $body = Validator::make($request->all(), [
            'id_post' => 'required',
            'id_user' => 'required'
        ]);
        $dislike = Like::where('id_user', '=', $request['id_user'])
            ->where('id_post', '=', $request['id_post'])->delete();
        $nDislike = Post::find($request->id_post)->likes()->count();
        return response(['msg' => 'Correcto', 'dislike' => $dislike, 'nDislike' => $nDislike]);
    }


    public function newPublication(Request $request){
        $body= $request->all();
        $body['user_id'] = Auth::id();
        return Publication::create($body);
    }
/*
    public function getPublication(){
        $publications = Publication::all();
        return $publications;
    }
*/
    public function getPublication(){
        $publications = Publication::with('likes')->get();
        return $publications;
    }
    public function deletePublication($id)
{
    $post = Publication::find($id);
    $delete = $publication->delete();
    return $delete;
}
}

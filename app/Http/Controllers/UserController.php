<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        {
            return User::all();
        }
    }

    public function register(Request $request)
    {
        
        try {
            $body = $request->validate([
                'name' => ['required','max:30'],
                'surname' => ['string'],
                'nick' => ['string'],
                'email' => ['required'],
                'password' => ['required'],
                /*'role' => ['string'],
                'status' => ['string'],
                'image' => ['string']*/
            ]);
            $body['password'] = Hash::make($body['password']);
            $user = User::create($body);
            return response($user, 201);
        } catch (\Exception $e) {  
            return response($e, 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
            if (!Auth::attempt($credentials)) {
                return response(['message' => 'Datos Incorrectos'], 400);
            }
            $user = Auth::user(); 
            //req.user, $request->user();
            $token = $user->createToken('authToken')->accessToken;
            return response([
                'user' => $user,
                'token' => $token
            ]);
        } catch (\Exception $e) {
            return response($e, 500);
        }
    }
    public function logout()
    {
        try {
            // Auth::user()->token()->delete();
            Auth::user()->token()->revoke();
            return response([
                'message' => 'User successfully disconected.'
            ]);
        } catch (\Exception $e) {
            return response([
                'message' => 'There was an error trying to login the user',
                'error' => $e
            ], 500);
        }
    }
    public function follow(Request $request)
    {
        $user = Auth::user();
        $follow = DB::table('followers')->insert(['id_followed' => $request[0], 'id_follower' => $user->id]);
        return response(['msg'=>'Sois amigos','follow'=>$follow],200);
    }
    public function unfollow(Request $request)
    {
        try {
            $user = Auth::user();
            $unfollow = DB::table('followers')->where('id_follower', '=', $user->id)
                ->where('id_followed', '=', $request[0])->delete();
            return response(['msg' => 'Ya no sois amigos', 'unfollow' => $unfollow], 200);
        }catch (\Exception $e){
            return response(['msg'=>'Ha ocurrido un error', 500]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }     
}

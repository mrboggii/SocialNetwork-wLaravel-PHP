<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::apiResource('users', 'UserController');
Route::post('register','UserController@register');
Route::post('login','UserController@login');

Route::apiResource('publications','PublicationController');
Route::post('newpublication','PublicationController@newPublication');

//Route::get('user/name/{id}', 'UserController@nameFollower');
Route::get('/all', 'UserController@getUsersAll');       // 4 
Route::get('/{id}', 'UserController@getUserById');      // 5        
Route::get('/logout', 'UserController@logout');     // 3 *
Route::middleware('auth:api')->group(function () {      
    // Route::get('/logout', 'UserController@logout');     // 3 *
});
// POSTS
Route::prefix('posts')->group(function () {
Route::middleware('auth:api')->group(function () {      
    Route::get('/', 'PostController@getAll');               // 1
    Route::get('/{id}', 'PostController@getById');          // 2
    Route::post('/', 'PostController@insert');              // 3
    Route::put('/{id}', 'PostController@update');           // 4
    Route::delete('/{id}', 'PostController@destroy');       // 5
    Route::get('/search/{title}', 'PostController@getPostByTitle');  
    Route::get('/orderDes', 'PostController@orderPostDesc'); 
});

});

// CATEGORIES
Route::prefix('categories')->group(function () {
Route::middleware('auth:api')->group(function () {      
    Route::get('','CategoryController@getAll');             // 1
    
// });
// Route::middleware(['auth:api','checkRole:admin'])->group(function () {
    Route::post('','CategoryController@insert');            // 2
    Route::put('{id}','CategoryController@update');         // 3
    Route::delete('{id}','CategoryController@destroy');     // 4
});
});

// LIKES
Route::prefix('likes')->group(function () {
Route::middleware('auth:api')->group(function () {      
    Route::post('/', 'LikeController@insertLike');          // 1
    Route::delete('/{id}','LikeController@dislike');        // 2
    // Route::get('/','LikeController@getLikesAll');
    Route::get('/post/{id}', 'LikeController@getLikeByPostId');
});
});

// MENSAJES
Route::prefix('message')->group(function () {
Route::middleware('auth:api')->group(function () {      
    Route::post('/{id}', 'MessageController@insertMessage');// 1
    Route::get('/', 'MessageController@getCMessageAll');    // 2
    Route::get('/{id}', 'MessageController@getMessageById');// 3 
    Route::put('/{id}', 'MessageController@UpdateMessage'); // 4
    Route::delete('/{id}','MessageController@disMessage');  // 5
    Route::get('/post/{id}','MessageController@getMessageByPostId');  
});
});



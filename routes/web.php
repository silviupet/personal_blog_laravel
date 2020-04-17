<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Auth::routes();
//
//    Auth::routes() will create some routes by default which are not shown in the routes/web.php file.
//In fact, Auth::routes() is a helper class that helps you generate all the routes required for user authentication.

Route::get('/logout' , 'Auth\LoginController@logout');

Route::get('/',['as'=>'home' , 'uses' =>'HomeController@index']);

Route::get('/welcome', 'HomeController@welcome');
Route::resource('admin/comments', 'PostCommentsController',['names'=>[

        'index'=>'admin.comments.index',
        'create'=>'admin.comments.create',
      'store'=>'admin.comments.store',
        'edit'=>'admin.comments.edit',
        'show'=>'admin.comments.show'

    ]]);

 Route::resource('admin/comment/replies', 'CommentRepliesController',['names'=>[

        'index'=>'admin.comments.replies.index',
        'create'=>'admin.comments.replies.create',
        'store'=>'admin.comments.replies.store',
        'edit'=>'admin.comments.replies.edit',
        'show'=>'admin.comments.replies.show',


    ]]);

Route::get('/post/{slug}',['as'=>'post','uses' =>'HomeController@post']);

Route::group(['middleware'=>'admin'], function(){ 

    Route::get('/admin', 'AdminController@index');

    Route::resource('admin/users', 'AdminUsersController',['names'=>[

        'index'=>'admin.users.index',
        'create'=>'admin.users.create',
        'store'=>'admin.users.store',
        'edit'=>'admin.users.edit'

    ]]);


    Route::get('/post/{id}', ['as'=>'home.post', 'uses'=>'HomeController@post']);

    Route::resource('admin/posts', 'AdminPostsController',['names'=>[

        'index'=>'admin.posts.index',
        'create'=>'admin.posts.create',
       'store'=>'admin.posts.store',
        'edit'=>'admin.posts.edit'

    ]]);

    Route::resource('admin/categories', 'AdminCategoriesController',['names'=>[

        'index'=>'admin.categories.index',
        'create'=>'admin.categories.create',
        'store'=>'admin.categories.store',
        'edit'=>'admin.categories.edit'

    ]]);

    Route::resource('admin/media', 'AdminMediasController',['names'=>[

        'index'=>'admin.media.index',
        'create'=>'admin.media.create',
        'store'=>'admin.media.store',
        'edit'=>'admin.media.edit'

    ]]);

    Route::delete('admin/delete/media', 'AdminMediasController@deleteMedia');

    

    Route::post('/admin/comment/reply', 'CommentRepliesController@createReply');


});

//Route::get('/all', function () {
////
//    $posts = Post::find(1);
//    return $posts->description;
//});
///* eloqvent relationship
//*/
////one o one relashionship
//Route::get('/user/{id}/post', function($id){
//
//    return User::find($id)->post->description;
//
//});
//
//Route::get('/date', function(){
//
//    echo Carbon::now()->addDay(1);
//});
//
//Route::get('/getnume', function(){
//    $user = User::find(1);
//    echo $user->email;
//});
//
//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
//Auth::logout();
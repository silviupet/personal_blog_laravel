<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use App\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//     $this->middleware('role');
//    
//    }
      public function __construct()
    {
    $this->middleware('auth', ['except' => ['index','post']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
           
    {

        $posts = Post::paginate(10);

        $categories = Category::all();

        $year = 2019;


        return view('front/home', compact('posts', 'categories', 'year'));
    }


    public function post($slug){


        $post = Post::findBySlugOrFail($slug);

        $categories = Category::all();

        $comments = $post->comments()->whereIsActive(1)->get();
        
//        dd($user);

        return view('post', compact('post','comments', 'categories'));


    }


    public function welcome(){

        return view('welcome');


    }




}

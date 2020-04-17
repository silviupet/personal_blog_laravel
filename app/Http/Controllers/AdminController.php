<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use Countable;

class AdminController extends Controller
{
    //


    public function index(){


      $postsCount = count(Post::all());


       $categoriesCount = count(Category::all());

       $commentsCount = count(Comment::all()) ;



      return view('admin/index', compact('postsCount','categoriesCount','commentsCount'));

    }


}



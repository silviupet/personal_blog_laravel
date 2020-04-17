<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostsCreateRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;


use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  $posts = Post::all();
        ////        dd($posts);
        ////        $posts returneaza o colectie de obiecte ca sa returneze un obiect - in view folosim foreach
        //      return view('Posts.index', compact('posts') );


        $posts = Post::paginate(12);

        return view('admin.posts.index', compact('posts'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


        $categories = Category::pluck('name','id')->all();


        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
//        validari  2  moduri 1 -cheama o metoda  validate 2 make a request class
////        $this ->validate($request , [
////            'title'=>'required|max:5',
//////            'descriprion '=>'required'
////
//////this - pt ca e parte a controllerului met vslidste primste 2 argumente, requestul si un array de proprietati
////        ]);
////        dd($request);//

        $input = $request->all();


        $user = Auth::user();


        if($file = $request->file('photo_id')){


            $name = time() . $file->getClientOriginalName();


            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);


            $input['photo_id'] = $photo->id;


        }




        $user->posts()->create($input);




        return redirect('/admin/posts');






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

        $post = Post::findOrFail($id);

        $categories = Category::pluck('name','id')->all();

        return view('admin.posts.edit', compact('post','categories'));


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

        $input = $request->all();



        if($file = $request->file('photo_id')){


            $name = time() . $file->getClientOriginalName();


            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);


            $input['photo_id'] = $photo->id;


        }


      Auth::user()->posts()->whereId($id)->first()->update($input);


        return redirect('/admin/posts');




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

        $post = Post::findOrFail($id);

        unlink(public_path() . $post->photo->file);

        $post->delete();

        return redirect('/admin/posts');


    }





}

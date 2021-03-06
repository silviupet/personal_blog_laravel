<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentReply;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;


class CommentRepliesController extends Controller
{
     public function __construct()
    {
   $this->middleware('admin', ['except' => 'store']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
         $comment= Comment::all();
        $replies = CommentReply::all();
         
//        dd($replies);


        return view('admin.comments.replies.index', compact('replies','comment'));
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
//    public function store(Request $request)
//    {
//        //
//    }


    public function store(Request $request){


        $user = Auth::user();


        $data = [

            'comment_id' => $request->comment_id,
            'author'=> $user->name,
            'email' =>$user->email,
              'photo'=>$user->photo ? $user->photo->file : '',
//           'photo'=>$user->photo->file,
            'body'=>$request->body


        ];


        CommentReply::create($data);

        $request->session()->flash('comment_message','Your reply has been submitted and is waiting moderation');

        return redirect()->back();




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

        $comment = Comment::findOrFail($id);

        $replies = $comment->replies;


        return view(' admin.comments.replies.show', compact('replies'));

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

        CommentReply::findOrFail($id)->update($request->all());


        return redirect()->back();



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

        CommentReply::findOrFail($id)->delete();

        return redirect()->back();

    }





}

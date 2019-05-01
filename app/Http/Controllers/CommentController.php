<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    // add Commment
    public function addComment(Request $request , $id ){
        if ($request->isMethod('post')){
            $comment = new Comment();
            $comment->comment_body = $request->input('body');
            $comment->post_id = $id ;
            $comment->user_id = auth()->user()->id ;
            $comment->save();
        }

        return redirect()->back();
    }

    //delete comment

    public function destroyComment($id){
        $comment = Comment::findOrFail($id);
        $pid = $comment->post_id;
        $comment->delete();
        return redirect("/posts/".$pid.'/view');
    }

}

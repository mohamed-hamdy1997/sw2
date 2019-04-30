<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function like(Request $request){

        $like_s = $request->like_s;
        $post_id = $request->post_id;
        $change_like = 0;

        $like =DB::table('likes')
              ->where('post_id',$post_id)
              ->where('user_id',\auth()->user()->id)
              ->first();

        if (!$like){
            $new_like = new Like();
            $new_like->post_id = $post_id;
            $new_like->user_id = \auth()->user()->id;
            $new_like->like = 1;
            $new_like->save();

            $is_like=1;
        }elseif ($like->like==1){
            DB::table('likes')
                ->where('post_id',$post_id)
                ->where('user_id',\auth()->user()->id)
                ->delete();

            $is_like=0;
        }elseif ($like->like==0){
            DB::table('likes')
                ->where('post_id',$post_id)
                ->where('user_id',\auth()->user()->id)
                ->update(['like'=>1]);

            $is_like=1;
            $change_like = 1;
        }
        $response = array(
            "is_like" =>$is_like,
            'change_like'=>$change_like
                         );
        return response()->json($response ,200);
    }

    public function dislike(Request $request){

        $like_s = $request->like_s;
        $post_id = $request->post_id;
        $change_dislike =0;

        $dislike =DB::table('likes')
            ->where('post_id',$post_id)
            ->where('user_id',\auth()->user()->id)
            ->first();

        if (!$dislike){
            $new_like = new Like();
            $new_like->post_id = $post_id;
            $new_like->user_id = \auth()->user()->id;
            $new_like->like = 0;
            $new_like->save();

            $is_dislike=1;
        }elseif ($dislike->like==0){
            DB::table('likes')
                ->where('post_id',$post_id)
                ->where('user_id',\auth()->user()->id)
                ->delete();

            $is_dislike=0;
        }elseif ($dislike->like==1){
            DB::table('likes')
                ->where('post_id',$post_id)
                ->where('user_id',\auth()->user()->id)
                ->update(['like'=>0]);

            $is_dislike=1;
            $change_dislike =1;
        }
        $response = array(
            "is_dislike" =>$is_dislike,
            "change_dislike"=>$change_dislike
        );
        return response()->json($response ,200);
    }
}

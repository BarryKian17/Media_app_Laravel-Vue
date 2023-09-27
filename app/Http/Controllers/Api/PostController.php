<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //get all post
    function allPost(){
        $post =Post::select('posts.*','categories.title as category_name')
        ->leftJoin('categories','posts.category_id','categories.category_id')
        ->get();
         return  response()->json([
            'status'=>true,
            'post'=>$post
         ]);
    }

        //Search post
        function postSearch(Request $request){
            $post = Post::where('title','LIKE','%'.$request->key.'%')->get();
            return response()->json([
                'searchData' => $post
            ]);
        }

    //Post Details
    function postDetails(Request $request){
        $post = Post::where('post_id',$request->postId)->first();
        return response()->json([
            'post' => $post
        ]);
    }

    //Post Comment
    function comment(Request $request){
        $data = [
            'user_id'=>$request->userId,
            'post_id'=>$request->postId,
            'comment'=>$request->comment
        ];
       Reaction::create($data);
       $comment = Reaction::select('reactions.*','users.name as user_name')
       ->leftJoin('users','reactions.user_id','users.id')
       ->where('reactions.post_id',$request->postId)
       ->get();
       return response()->json([
           'comment'=> $comment
         ]);
    }

    function getComment(Request $request){
        $comment = Reaction::select('reactions.*','users.name as user_name')
        ->leftJoin('users','reactions.user_id','users.id')
        ->where('reactions.post_id',$request->postId)
        ->get();
        return response()->json([
            'comment'=> $comment
          ]);
    }
}

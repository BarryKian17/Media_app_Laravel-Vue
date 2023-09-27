<?php

namespace App\Http\Controllers;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrendPostController extends Controller
{
    //Trend Post list
    function index(){
        $data = ActionLog::select('action_logs.*','posts.*',DB::raw('COUNT(action_logs.post_id) as post_count'))
        ->join('posts','action_logs.post_id','posts.post_id')
        ->groupBy('action_logs.post_id')
        ->get();


        return view('admin.trend_post.index',compact('data'));
    }

    //Trend Post Details
    function detail($id){
        $post = ActionLog::select('action_logs.*','posts.*','categories.title as category_title',DB::raw('COUNT(action_logs.post_id) as post_count'))
        ->join('posts','action_logs.post_id','posts.post_id')
        ->groupBy('action_logs.post_id')
        ->leftJoin('categories','posts.category_id','categories.category_id')
        ->where('action_logs.post_id',$id)
        ->first();
        return view('admin.trend_post.trendPostDetail',compact('post'));
    }
}

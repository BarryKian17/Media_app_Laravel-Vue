<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //Post Page
    function index(){
        $category = Category::get();
        $post = Post::select('posts.*','categories.title as category_name')
        ->leftJoin('categories','posts.category_id','categories.category_id')
        ->get();
        return view('admin.post.index',compact('category','post'));
    }

    //Post Create
    function postCreate(Request $request){
        $this->postValidation($request);
        $data=[
            'title'=>$request->title,
            'description'=>$request->description,
            'category_id'=>$request->category
        ];
        if($request->hasfile('image')){
            $image = uniqid() . $request ->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$image);
            $data['image']=$image;
        }
        Post::create($data);
        return back();
    }

    //Post Delete
    function postDelete($id){
        $imageName = Post::where('post_id',$id)->first();
        $imageName = $imageName->image;
        Storage::delete('public/'.$imageName);
        Post::where('post_id',$id)->delete();
        return back();
    }

    //Post Edit Page
    function postEdit($id){
        $post = Post::get();
        $edit = Post::where('post_id',$id)->first();
        $category = Category::get();
        return view('admin.post.update',compact('post','edit','category'));
    }

    //Post Update
    function postUpdate(Request $request){
        $this->postValidation($request);
        $data=[
            'title'=>$request->title,
            'description'=>$request->description,
            'category_id'=>$request->category
        ];
        if($request->hasFile('image')){
            $updateImage = uniqid() . $request->file('image')->getClientOriginalName();
            $oldImage = Post::where('post_id',$request->postId)->first();
            $oldImage = $oldImage->image;
            Storage::delete('public/'.$oldImage);
            $request->file('image')->storeAs('public',$updateImage);
            $data['image'] = $updateImage;
        }
        Post::where('post_id',$request->postId)->update($data);
        return redirect()->route('admin#post');
    }

    //Post Validation
    function postValidation($request){
        Validator::make($request->all(),[
            'title'=>'required',
            'description'=>'required',
            'category'=>'required',
            'image'=>'mimes:png,jpg,avif,jpeg'
        ])->validate();
    }
}

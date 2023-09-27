<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //Category Page
    function index(){
        $category = Category::when(request('key'),function($query){
            $query->where('category_id','like','%'.request('key').'%')
                  ->orWhere('title','like','%'.request('key').'%')
                  ->orWhere('description','like','%'.request('key').'%');
        })->get();
        return view('admin.category.index',compact('category'));
    }

    //Create Category
    function categoryCreate(Request $request){
        $this->categoryValidation($request);
        $data = [
            'title'=>$request->title,
            'description'=>$request->description
        ];
        Category::create($data);
        return back();
    }

    //Category Delete
    function categoryDelete($id){
        Category::where('category_id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Category Deleted']);
    }

    //Category Update Page
    function categoryUpdatePage($id){
        $category = Category::get();
        $data = Category::where('category_id',$id)->first();

        return view('admin.category.categoryUpdate',compact('data','category'));
    }

    //Update Category
    function categoryUpdate(Request $request){
        $this->categoryValidation($request);
        $data = [
            'title'=>$request->title,
            'description'=>$request->description
        ];
        $id = $request->categoryId;
        Category::where('category_id',$id)->update($data);
        return redirect()->route('admin#category');
    }

    private function categoryValidation($request){
        Validator::make($request->all(),[
            'title'=>'required|unique:categories,title,'.$request->categoryId.',category_id',
            'description'=>'required'
        ])->validate();
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //get all category
    function allCategory(){
        $category = Category::select('category_id','title','description')->get();
        return response()->json([
            'category'=>$category
        ]);
    }

        //Search category
        function categorySearch(Request $request){
            $category = Category::select('posts.*')
            ->join('posts','categories.category_id','posts.category_id')
            ->where('categories.title','LIKE','%'.$request->key.'%')->get();
            return response()->json([
                'searchData' => $category
            ]);
        }
}

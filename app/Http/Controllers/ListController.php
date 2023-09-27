<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class ListController extends Controller
{
    // Admin List Page
    function index(){
        $list = User::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%')
                  ->orWhere('email','like','%'.request('key').'%')
                  ->orWhere('phone','like','%'.request('key').'%')
                  ->orWhere('gender','like','%'.request('key').'%')
                  ->orWhere('address','like','%'.request('key').'%');
        })->get();
        return view('admin.list.index',compact('list'));
    }
}

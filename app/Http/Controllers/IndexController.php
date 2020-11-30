<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Mail\RegMail;
use App\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public  function home(){
        $blogs=Blog::orderBy('created_at','desc')->with('user')->paginate(5);
        return view('home',compact('blogs'));
    }
}

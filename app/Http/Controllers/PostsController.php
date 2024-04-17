<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    //トップページ
    public function index(){
        return view('posts.index');
    }
    //フォローリストページ
    public function followlist(){
        return view('follows.followList');
    }
    //フォロワーリストページ
    public function followerlist(){
        return view('follows.followerList');
    }
}

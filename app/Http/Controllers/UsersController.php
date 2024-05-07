<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\User;

class UsersController extends Controller
{
    public function profile(){
        return view('users.profile');
    }
    //検索機能実装
    public function search(Request $request){
        $users = User::get();
        $users =  $request->input('username');
        $keyword = $request->input('keyword');

        if(!empty($keyword)){
            $users = User::where('username','like', '%'.$keyword.'%')->get();
        }else{
            $users = User::where('id','<>', Auth::id())->get();
            //dd($users); //dd関数の記述を追加
        }
        return view('users.search',['users'=>$users],['keyword'=>$keyword]);
    }
}

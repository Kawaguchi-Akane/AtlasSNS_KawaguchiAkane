<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\User;
use App\Post;

class UsersController extends Controller
{
    public function userProfile($id){
        $users = User::find($id);
        // dd($users);
        // Postテーブルからレコード情報を取得
        $lists=Post::
        whereIn('user_id' , Auth::user()->following()->pluck('followed_id'))
        ->orWhere('user_id' , Auth::id())
        ->get();
        // bladeへ帰す際にデータを送る
        return view('users.profile',['lists'=>$lists],['users'=>$users]);
    }

    public function updateProfile(){
        return view('users.updateProfile');
    }
    //検索機能実装
    public function search(Request $request){
        $users = User::get();
        $users =  $request->input('username');
        $keyword = $request->input('keyword');

        if(!empty($keyword)){
            $users = User::where('username','like', '%'.$keyword.'%')->get();
        }else{
            //ログインユーザをはじく記述
            $users = User::where('id','<>', Auth::id())->get();
            //dd($users); //dd関数の記述を追加
        }
        return view('users.search',['users'=>$users],['keyword'=>$keyword])->with('keyword',$keyword);
    }

    // フォロー解除
    public function unfollow($userId){
        $followed = auth()->user();
        $is_following = $followed->isFollowing($userId);

        if ($is_following) {
            $loggedInUserId = auth()->user()->id;
            Follow::where([
                ['followed_id','=',$userId],
                ['following_id','=',$loggedInUserId],
            ])->delete();
        }
        return back();
    }
    // フォロー
    public function following($userId){
        //dd($userId);
        $followed = auth()->user();
        $is_following = $followed->isFollowing($userId);

        if (!$is_following){
            $loggedInUserId = auth()->user()->id;
            $followedUser = User::find($userId);
            $followedUserId = $followedUser->id;
        }
        Follow::create([
        'followed_id'=>$followedUserId,
        'following_id'=>$loggedInUserId,
    ]);
    // フォロー後の元の画面にリダイレクト
    return back();

    }
}

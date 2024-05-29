<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;

class PostsController extends Controller
{
    public function index(){
    // Postテーブルからレコード情報を取得
    $lists=Post::
    whereIn('user_id' , Auth::user()->following()->pluck('followed_id'))
    ->orWhere('user_id' , Auth::id())
    ->get();
    // bladeへ帰す際にデータを送る
    return view('posts.index',['lists'=>$lists]);
}

    // フォローしているかの確認
    public function followList()
    {
        // フォローしているユーザーのidを取得
        $following_id = Auth::user()->following()->pluck('followed_id');

        $posts = Post::with('user')->whereIn('user_id' , $following_id)->get();
        $followeds_users=User::whereIn('id' , $following_id)->get();
        return redirect('/top');
    }

  // 投稿の登録処理
    public function postCreate(Request $request){

    // 投稿バリデーション
    $request->validate([
                'newPost' => 'required|max:150'
            ]);
    // 投稿フォームに書かれた投稿を受け取る
    $post=$request->input('newPost');
    // 投稿の登録
    // Postテーブルの'user_id','post'に変数を当てはめる
    Post::create([
        'user_id'=>Auth::id(),
        'post'=>$post
    ]);
    return redirect('/top');
}
    // 投稿の編集
    public function update(Request $request)
    {
    // dd($request);
    // 1つ目の処理
    $id = $request->input('user_id');
    $up_post = $request->input('post_update');
    // 2つ目の処理
    Post::where('id', $id)->update([
        'post' => $up_post,
    ]);
    // 3つ目の処理
    return redirect('/top');
    }

    // 投稿削除
    public function delete($id)
    {
        Post::where('id',$id)->delete();
        return redirect('/top');
    }
}

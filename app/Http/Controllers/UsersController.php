<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    //プロフィール編集画面へ飛ぶ
    public function update($id){
        return view('users.updateProfile');
    }
    //プロフィール編集機能
    public function updateProfile(Request $request){
        //dd($request);

        $request->validate([
                'username' => 'required|max:12|min:2',
                'mail' => 'required|max:40|min:5|unique:users,mail,'.Auth::user()->mail.',mail',
                'password' => 'required|max:20|min:8|confirmed',
                'bio' => 'required|max:150',
                'image' => 'required|image|mimes:jpg,png,bmp,gif,svg'
            ]);
        $id = $request->input('id');
        $update = [
            'username' => $request->input('username'),
            'mail' => $request->input('mail'),
            'bio' => $request->input('bio'),
            'password' => bcrypt($request->input('password'))
        ];

        // 画像が入力された場合のみ更新
        // filled() 指定したキーの有無 && 値が入力されているか、キーが存在しており、かつ値が入力されていたらtrue。
        if ($request->hasFile('image')) {
            // $update配列に'image'というキーに対して、バリデーションを実装
            // $変数[''] = ;←連想配列言置ける要素の追加や更新を行うためのコード
            //getClientOriginalNameでオリジナルの名前が取れる。

            $file=$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/images', $file);
            //dd($file);
            User::where('id', $id)->update(['images'=>$file]);
        }

        // まとめてupdate関数
        User::where('id', $id)->update($update);

        return redirect('/top');
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

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    // postsテーブルとのリレーション
    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function followed()
    {
        return $this->belongsToMany('App\User', 'follows', 'followed_id','following_id');
    }

    public function following()
    {
        return $this->belongsToMany('App\User', 'follows','following_id','followed_id');
    }
    // フォローしているか
    // $user_id はログイン中のユーザー
    public function isFollowing(Int $user_id)
    {
        return (bool) $this->following()->where('followed_id', $user_id)->first();
    }

    public function isFollowed(Int $user_id){
        return(boolean) $this->follows()->where('followed_id',$user_id)->first(['follows.id']);
    }
}

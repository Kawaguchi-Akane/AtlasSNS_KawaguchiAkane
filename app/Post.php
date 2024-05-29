<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=[
        'post','user_id'
    ];

    public function user(){
        // 1対多の「1」側のため単数形
        return $this->belongsTo('App\User');
    }
}

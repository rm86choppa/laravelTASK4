<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = array('id');

    //usersとの紐づけ(リレーション)
    //主テーブル名の単数_id(post_id)にしてる場合は特に必要ないが、それ以外の場合外部キー、ローカルキーを指定が必要
    public function user() {
        return $this->belongsto('App\User');
    }
}

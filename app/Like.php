<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $guarded = array('id');
    protected $table = 'post_user';//テーブル名指定

}

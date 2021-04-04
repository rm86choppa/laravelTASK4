<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            //$table->integer('user_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            //ユーザIDの外部キー設定
            //(参照してるユーザIDの登録が削除されたとき、そのIDを参照してるレコードも自動的に削除)
            $table->foreign('user_id')
            ->references('id')->on('users')->onDelete('cascade');
            
            //$table->integer('post_id')->unsigned();
            $table->bigInteger('post_id')->unsigned();
            //投稿IDの外部キー設定
            //(参照してる投稿IDの登録が削除されたとき、そのIDを参照してるレコードも自動的に削除)
            $table->foreign('post_id')
            ->references('id')->on('posts')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_user');
    }
}

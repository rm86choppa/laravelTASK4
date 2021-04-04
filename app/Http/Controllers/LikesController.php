<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikesController extends Controller
{
    /**
     * いいね機能
     * いいね:中間テーブルにユーザID、投稿IDを含めてレコード追加
     * いいね解除:削除されたらレコード削除
     * 
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request) {
        $user_data = $request->all();

        //更新(いいね済ならレコード削除、未いいねならレコード追加)
        $like_result = Like::where('user_id', $request->user_id)->where('post_id', $request->post_id)->first();
        
        //未いいねだった場合、レコード追加
        //いいね済だった場合、レコード削除
        $ajax_return_data;       
        if(isset($like_result)) {
           Like::find($like_result->id)->delete();
           $ajax_return_data['isLiked'] = false;
        } else {
            $like = new Like;
            $like->fill($user_data)->save();
            $ajax_return_data['isLiked'] = true;
        }

        //今、いいねされた投稿のいいね数を数えてajaxのリターン変数に格納
        $ajax_return_data['liked_count'] = Like::where('post_id', $request->post_id)->count();

        return response()->json($ajax_return_data);

    }
}


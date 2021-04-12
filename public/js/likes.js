$(function () {

    //投稿毎に設定された.hideクラスが付与されたいいね済、未いいねアイコンどちらかを非表示
    $('.hide').each(function() {
        $(this).hide();
        });

    //全投稿のクリックイベントを監視する
    $('.likes_btn').each(function() {
        $(this).on('click', function() {
            
            //いいねされた投稿ID、ユーザID取得
            const post_id = $(this).children('#post_id').val();
            const user_id = $(this).children('#user_id').val();

            //いいねアイコン取得
            const notLiked_icon = $(this).children('.far.fa-heart');
            const liked_icon = $(this).children('.fas.fa-heart');

            $.ajax({
                type: 'GET',
                url: '/likes', //web.phpのURLと同じ形にする
                data: {
                    'post_id': post_id, //ここはサーバーに贈りたい情報。
                    'user_id': user_id,
                },
                dataType: 'json', //json形式で受け取る
                timeout: 900000,
                beforeSend: function () {
                } 
            }).done(function(data){

                //いいねの更新後、いいね済なのか未いいねなのかで処理が以下のように変わる
                //いいね済ならいいね済アイコンを表示、いいね数表示、未いいねアイコン非表示
                if(data['isLiked'] === true) {
                   
                    //いいね数表示
                    liked_icon.text(data['liked_count']);
                    //いいね済アイコン表示
                    liked_icon.show();
                    //未いいねアイコン非表示
                    notLiked_icon.hide();

                }
                //未いいねなら未いいねアイコンを表示、いいね数表示、いいね済アイコン非表示
                else {

                    //いいね数表示
                    notLiked_icon.text(data['liked_count']);
                    //未いいねアイコン表示
                    notLiked_icon.show();
                    //いいね済アイコン非表示
                    liked_icon.hide();
                }
            }).fail(function(){
                alert("通信に失敗しました");
            });
        });
    });
});
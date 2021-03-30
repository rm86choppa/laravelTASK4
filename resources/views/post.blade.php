@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- 全投稿をループで表示 -->
                @foreach($posts as $post)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="form-group row border-bottom">
                                <div class="page-header col-md-12 justify-content-center text-center">
                                    <h1 name="title" value="{{ $post->title }}">{{ $post->title }}</h1>
                                </div>

                                <p class="col-md-12 text-center">{{ $post->content }}</p>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="col-md-12 row justify-content-center">
                                    <p class="mr-2">投稿者：{{ $post->user->name }}</p>
                                    <!-- ループで表示する投稿が今ログインするユーザと一致したら編集、削除できるようにボタン設置 -->
                                    @if( (Auth::user()->name) === ($post->user->name))
                                        <form method="GET" action="{{ url('post/'.$post->id.'/edit') }}">
                                            @csrf
            
                                            <!-- フォーム送信情報(編集する投稿内容) -->
                                            <input type="hidden" name="title" value="{{ $post->title }}">
                                            <input type="hidden" name="content" value="{{ $post->content }}">
                                            <input type="hidden" name="content" value="{{ $post->content }}">
                                            <!-- フォーム送信情報(編集する投稿内容) -->

                                            <button type="submit" class="btn btn-primary mr-2">
                                                {{ __('編集') }}
                                            </button>
                                        </form>
                                        <form class="contents_Form" action="{{ url('post/'.$post->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" name="delete">{{ __('削除') }}</button>
                                        </form>
                                    @endif
                                    <a class="btn btn-link" href="#">
                                        <i class="far fa-heart">1</i>
                                        <!-- <i class="fas fa-heart"></i> -->
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

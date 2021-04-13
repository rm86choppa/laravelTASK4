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
                                    <div class="btn btn-link likes_btn">
                                        <input type="hidden" name='post_id' id="post_id" value="{{ $post->id }}">
                                        <input type="hidden" name='user_id' id="user_id" value="{{ Auth::user()->id }}">
                                        
                                        @if($post->users->where('id', Auth::user()->id)->count() >= 1)
                                            <i class="far fa-heart hide">{{ $post->users->count() }}</i>
                                            <i class="fas fa-heart">{{ $post->users->count() }}</i>
                                        @else
                                            <i class="far fa-heart">{{ $post->users->count() }}</i>
                                            <i class="fas fa-heart hide">{{ $post->users->count() }}</i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

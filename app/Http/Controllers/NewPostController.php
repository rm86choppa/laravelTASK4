<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewPostRequest;

class NewPostController extends Controller
{
    /**
     * 新規投稿
     *
     * @return \Illuminate\Http\Response
     */
    public function newPost(newPostRequest $request)
    {
        $content = $request->content;
        return view('newPost', compact('content'));
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            /* ※条件
            - コンテンツの文字数が140文字
            */  
            'user_id' => 'required',
            'title' => 'required',
            'content' => 'required|max:140'
        ];
    }

    public function messages() {
        return [
            
            'title.required'  => 'タイトルを入力してください',
            'content.required'  => 'コンテンツを入力してください',
            'content.max'  => '140字以下で入力してください',
        ];
    }
}

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
        if ($this->path() === 'post') {
            return true;
       }

        return false;
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
            'content'  => 'max:140'
        ];
    }

    
    public function messages() {
        return [
            'content.max'  => '140字以下で入力してください'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'brand' => 'required',
            'cosme' => 'required',
            'price' => 'required',
            'body' => 'required',
            'detail' => 'required',
            'image1' => 'required',
            'url' => 'required',
            // 'image1' => 'mimes:jpeg,jpg,png,gif|max:10240',
        ];
    }

    public function massages()
    {
        return [
            'brand.required' => 'ブランド名を入れてください',
            'brand.unique'   => 'ブランド名が被っています',
            'cosme.required' => 'コスメを入れてください',
            'price.required' => '価格を入れてください',
            'body.required' => '使い方を入れてください',
            'detail.required' => '使った感想を入れてください',
            'image1.required' => '画像を載せてください',
            'url.required' => '商品のURL',
            // 'image1.mimes'    => 'ファイルタイプをjpeg,jpg,png,gifに設定してください。',
            // 'image1.max'      => 'ファイルサイズを10MB以下に設定してください。',
        ];
    }
}

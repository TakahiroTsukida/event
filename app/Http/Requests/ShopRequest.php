<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'tel' => ['nullable', 'max:13'],
            'postcode' => ['nullable', 'max:8'],
            'ken' => ['required'],
            'city' => ['required'],
            'block' => ['nullable', 'max:255'],
            'open' => ['required', 'max:255'],
            'close' => ['nullable', 'max:255'],
            'web' => ['nullable', 'max:255'],

            //images
            'image' => ['nullable', 'image', 'max:1024'],
        ];
    }


    public function attributes()
    {
        return [
            'name' => '店舗名',
            'tel' => 'メールアドレス',
            'postcode' => '郵便番号',
            'ken' => '都道府県',
            'city' => '市区郡',
            'block' => '町村以降',
            'open' => '営業時間',
            'close' => '定休日',
            'web' => 'ホームページ',
            'image' => '画像',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'gender' => ['required'],
            'birthday' => ['nullable', 'before:now'],
            'introduction' => ['nullable', 'string', 'max:255'],
        ];
    }


    public function attributes()
    {
        return [
            'name' => 'ユーザー名',
            'gender' => '性別',
            'birthday' => '生年月日',
            'introduction' => '自己紹介',
        ];
    }
}

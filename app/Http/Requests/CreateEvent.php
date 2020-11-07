<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEvent extends FormRequest
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
            'name' => 'required|string|max:255',
            'shop_id' => 'required',
            'start_time' => 'required|after:now',
            'end_time' => 'nullable|after:now',
            'deadline' => 'nullable|after:now',
            'title' => 'nullable|string|max:255',
            'descripsion' => 'nullable|string|max:255',
            'conditions' => 'nullable|string|max:255',
            'tax' => 'required',
            'image' => 'nullable|image|max:2048',

            // pricesテーブル
            'price.gender' => 'array',
            'price.gender.*' => 'nullable|required_with:price.price.*',
            'price.status' => 'array',
            'price.status.*' => 'nullable|string|max:255',
            'price.price' => 'array',
            'price.price.*' => 'nullable|required_with:price.gender.*',
            'price.notes' => 'array',
            'price.notes.*' => 'nullable|string|max:255',

            //schedulesテーブル
            'schedule.name.*' => 'nullable|string|max:255|required_with:schedule.begin.*',
            'schedule.begin.*' => 'nullable|required_with:schedule.name.*',
            'schedule.end.*' => 'nullable|required_with:schedule.begin.*',
            'schedule.descripsion.*' => 'nullable|max:255',

            //reservation_seatsテーブル
            'reservation_seat.name.*' => 'nullable|string|max:255|required_with:reservation_seat.people.*',
            'reservation_seat.people.*' => 'nullable|required_with:reservation_seat.people.*',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'イベント名',
            'shop_id' => '開催店舗',
            'start_time' => '開始時間',
            'end_time' => '終了時間',
            'deadline' => '申込締切',
            'title' => 'タイトル',
            'descripsion' => 'イベントの概要',
            'conditions' => '参加条件',
            'image' => '画像',

            //pricesテーブル
            'tax' => '消費税',
            'price' => [
                'gender' => '性別',
                'status' => '備考',
                'price' => '参加費',
                'notes' => '注意事項',
            ],

            //schedulesテーブル
            'schedule' => [
                'name' => 'スケジュール名',
                'begin' => '開始時間',
                'end' => '終了時間',
                'descripsion' => '内容',
            ],

            'reservation_seat' => [
                'name' => '定員種類',
                'people' => '人数',
            ],
        ];
    }
}

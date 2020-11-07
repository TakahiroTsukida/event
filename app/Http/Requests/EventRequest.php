<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'image' => 'nullable|image|max:2048',

            //tagsテーブル
            'tags' => 'json|regex:/^(?!.*\s).+$/u|regex:/^(?!.*\/).*$/u',

            // pricesテーブル
            'price.gender.*' => 'nullable',
            'price.status.*' => 'nullable|string|max:255',
            'price.price.*' => 'nullable',
            'tax' => 'required',
            'price.notes.*' => 'nullable|string|max:255',

            //schedulesテーブル
            'schedule.name.*' => 'nullable|string|max:255',
            'schedule.begin.*' => 'nullable',
            'schedule.end.*' => 'nullable',
            'schedule.descripsion.*' => 'nullable',

            //reservation_seatsテーブル
            'reservation_seat.name.*' => 'nullable|string|max:255',
            'reservation_seat.people.*' => 'nullable',
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

            //tagsテーブル
            'tags' => 'タグ',

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


    public function passedValidation()
    {
        $this->tags = collect(json_decode($this->tags))
            ->slice(0, 10)
            ->map(function($requestTag) {
                return $requestTag->text;
            });
    }
}

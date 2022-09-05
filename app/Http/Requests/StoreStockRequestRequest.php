<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreStockRequestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'request_date' => ['required', 'date_format:d/m/Y'],
            'stocks' => ['required', 'array', 'min:1'],
            'stocks.*.stock_item_id' => ['required', Rule::exists('stock_items', 'id')],
            'stocks.*.qty' => ['required', 'integer', 'min:1']
        ];
    }
}

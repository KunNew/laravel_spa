<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStockItemRequest extends FormRequest
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
            'code' => ['required', Rule::unique('stock_items', 'code')->ignore(request('stock_item')->id)],
            'name' => ['required', 'string'],
            'avatar' => ['nullable', 'image'],
            'stock' => ['required', 'integer'],
        ];
    }
}

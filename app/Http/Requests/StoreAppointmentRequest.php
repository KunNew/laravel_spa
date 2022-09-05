<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
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
            'patient_id' => ['required', Rule::exists('patients', 'id')],
            'doctor_id' => ['nullable', Rule::exists('doctors', 'id')],
            'appoint_date' => ['required', 'date_format:d/m/Y H:i'],
        ];
    }
}

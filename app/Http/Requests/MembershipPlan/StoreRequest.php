<?php

namespace App\Http\Requests\MembershipPlan;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'rate' => 'required|numeric|min:0',
            'validity' => 'required|integer|min:1',
            'details' => 'nullable|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'rate.required' => 'The rate field is required.',
            'rate.numeric' => 'The rate must be a number.',
            'rate.min' => 'The rate must be at least :min.',
            'validity.required' => 'The validity field is required.',
            'validity.integer' => 'The validity must be an integer.',
            'validity.min' => 'The validity must be at least :min.',
            'details.string' => 'The details must be a string.',
        ];
    }
}

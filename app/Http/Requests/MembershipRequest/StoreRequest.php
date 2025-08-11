<?php

namespace App\Http\Requests\MembershipRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:temporary_members,email',
            'gender' => 'required|string|in:MALE,FEMALE',
            'age' => 'required|integer|min:0',
            'contact_number' => 'required|string|max:10|unique:temporary_members,contact_number',
            'height' => 'required|numeric|between:0.01,999.99',
            'weight' => 'required|numeric|between:0.01,999.99',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_personal_training' => 'required|in:YES,NO',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than :max characters.',

            'email.email' => 'The email must be a valid email address.',
            'email.max' => 'The email may not be greater than :max characters.',
            'email.unique' => 'The email has already been taken.',

            'gender.required' => 'Please select a gender.',
            'gender.string' => 'Invalid input for gender.',
            'gender.in' => 'Invalid selection for gender.',

            'age.required' => 'Please provide the age.',
            'age.integer' => 'The age must be a valid integer.',
            'age.min' => 'The age must be at least 0.',

            'contact_number.required' => 'The contact number field is required.',
            'contact_number.string' => 'The contact number must be a string.',
            'contact_number.max' => 'The contact number may not be greater than :max characters.',
            'contact_number.unique' => 'The contact number has already been taken.',

            'height.required' => 'The height field is required.',
            'height.numeric' => 'The height must be a number.',
            'height.between' => 'The height must be between :min and :max.',

            'weight.required' => 'The weight field is required.',
            'weight.numeric' => 'The weight must be a number.',
            'weight.between' => 'The weight must be between :min and :max.',

            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: :values.',
            'image.max' => 'The image may not be greater than :max kilobytes.',

            'is_personal_training.required' => 'The personal training field is required.',
            'is_personal_training.in' => 'Invalid selection for personal training.',
        ];
    }
}

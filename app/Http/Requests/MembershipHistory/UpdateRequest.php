<?php

namespace App\Http\Requests\MembershipHistory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'start_date' => $this->joining_date,
            'end_date' => $this->end_date,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'member_id' => 'required|uuid|exists:members,id',
            'membership_plan_id' => 'required|uuid|exists:membership_plans,id',
            'joining_date' => 'required|date',
            'end_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'due_amount' => 'nullable|numeric|min:0',
        ];
    }

    /**
     * Get the validation messages that apply to the request error.
     *
     * @return array<string, mixed>
     */
    public function messages(): array
    {
        return [
            'member_id.required' => 'The member selection is required.',
            'member_id.uuid' => 'The member ID must be a valid UUID.',
            'member_id.exists' => 'The selected member does not exist.',
            'membership_plan_id.required' => 'A membership plan must be selected.',
            'membership_plan_id.uuid' => 'The membership plan ID must be a valid UUID.',
            'membership_plan_id.exists' => 'The selected membership plan does not exist.',
            'joining_date.required' => 'The joining date is required.',
            'joining_date.date' => 'The joining date must be a valid date.',
            'end_date.required' => 'The end date is required.',  // If end_date can be nullable, adjust the message
            'end_date.date' => 'The end date must be a valid date.',
            'amount.required' => 'The amount is required.',
            'amount.numeric' => 'The amount must be a number.',
            'amount.min' => 'The amount cannot be less than zero.',
            'due_amount.numeric' => 'The due amount must be a number.',
            'due_amount.min' => 'The due amount cannot be less than zero.',
        ];
    }
}

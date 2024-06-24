<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'first_name' => ['required', 'string', 'max:255'],
            'first_name_kana' => ['required', 'string', 'max:255'],
            'last_name_kana' => ['required', 'string', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:10'],
            'prefecture' => ['required', 'string', 'max:50'],
            'address1' => ['required', 'string', 'max:100'],
            'address2' => ['nullable', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:20'],
            'user_type' => ['required', 'string', 'in:personal,corporate'],
        ];
    }
}

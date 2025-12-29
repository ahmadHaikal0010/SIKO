<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $account = $this->route('account') ?? $this->route('id');
        return Gate::allows('update', $account);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users,email'],
            // password optional when admin edits; must be confirmed when present
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            // allow admin to set account status
            'status' => ['nullable', 'in:active,disabled'],
            'role' => ['nullable', 'in:admin,penghuni,user'],
        ];
    }
}

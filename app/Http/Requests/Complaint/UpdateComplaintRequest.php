<?php

namespace App\Http\Requests\Complaint;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateComplaintRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()?->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'status' => ['nullable', 'in:menunggu,ditanggapi,selesai'],
            'tanggapan' => ['nullable', 'string'],
            'tanggal_tanggapan' => ['nullable', 'date'],
        ];
    }
}

<?php

namespace App\Http\Requests\Tenant;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateTenantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $tenant = $this->route('tenant') ?? $this->route('id');
        return Auth::user()->can('update', $tenant);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'room_id' => ['required', 'exists:rooms,id'],
            'nama_penghuni' => ['required', 'string', 'max:255'],
            'telpon' => ['required', 'string', 'max:20'],
            'jenis_kelamin' => ['required', 'in:laki-laki,perempuan'],
            'pekerjaan' => ['required', 'in:pelajar,karyawan,wirausaha,lainnya'],
            'nama_wali' => ['nullable', 'string', 'max:255'],
            'telpon_wali' => ['nullable', 'string', 'max:20'],
            'tanggal_masuk' => ['required', 'date'],
            'tanggal_keluar' => ['nullable', 'date', 'after_or_equal:tanggal_masuk'],
            'status' => ['required', 'in:active,inactive'],
        ];
    }
}

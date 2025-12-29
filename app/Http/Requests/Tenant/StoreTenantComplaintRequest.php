<?php

namespace App\Http\Requests\Tenant;

use App\Models\Complaint;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreTenantComplaintRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('create', Complaint::class);
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
            'judul_keluhan' => ['required', 'string', 'max:255'],
            'isi_keluhan' => ['required', 'string'],
            'tanggal_ajukan' => ['required', 'date'],
            'status' => ['required', 'in:menunggu,ditanggapi,selesai'],
            'tanggapan' => ['nullable', 'string'],
            'tanggal_tanggapan' => ['nullable', 'date'],
            'attachment' => ['nullable', 'file', 'max:10240'],
        ];
    }
}

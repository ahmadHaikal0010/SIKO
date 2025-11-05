<?php

namespace App\Http\Requests\Kost;

use App\Models\Kost;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateKostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $kost = $this->route('kost') ?? $this->route('id');
        return Auth::user()->can('update', $kost);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_kost' => 'sometimes|required|string|max:255',
            'deskripsi' => 'sometimes|nullable|string',
            'fasilitas' => 'sometimes|nullable|string',
            'alamat' => 'sometimes|required|string|max:500',
            'total_kamar' => 'sometimes|required|integer|min:1',
            'harga_kost' => 'sometimes|required|numeric|min:0',
            'kategori' => 'sometimes|required',
        ];
    }
}

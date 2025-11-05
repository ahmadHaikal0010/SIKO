<?php

namespace App\Http\Requests\Kost;

use App\Models\Kost;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreKostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->can('create', Kost::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_kost' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'fasilitas' => 'nullable|string',
            'alamat' => 'required|string|max:500',
            'total_kamar' => 'required|integer|min:1',
            'harga_kost' => 'required|numeric|min:0',
            'kategori' => 'required',
        ];
    }
}

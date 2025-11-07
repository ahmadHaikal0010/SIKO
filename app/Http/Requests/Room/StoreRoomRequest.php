<?php

namespace App\Http\Requests\Room;

use App\Models\Room;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->can('create', Room::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'kost_id' => ['required', 'exists:kosts,id'],
            'nomor_kamar' => ['required', 'string', 'unique:rooms,nomor_kamar'],
            'status' => ['required', 'in:available,occupied'],
        ];
    }
}

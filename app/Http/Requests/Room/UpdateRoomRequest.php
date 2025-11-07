<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $room = $this->route('room') ?? $this->route('id');
        return Auth::user()->can('update', $room);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'kost_id' => ['sometimes', 'required', 'exists:kosts,id'],
            'nomor_kamar' => ['sometimes', 'required', 'string', 'unique:rooms,nomor_kamar'],
            'status' => ['sometimes', 'required', 'in:available,occupied'],
        ];
    }
}

<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;


class UpdateRoomRequest extends FormRequest
{
    /**
     * Authorization menggunakan Policy RoomPolicy.
     */
    public function authorize(): bool
    {
        $room = $this->route('room') ?? $this->route('id');
        return Gate::allows('update', $room);

    }

    /**
     * Validasi update kamar.
     */
    public function rules(): array
    {
        $room = $this->route('room');  // Model binding

        return [
            'kost_id' => [
                'required',
                'exists:kosts,id'
            ],

            'nomor_kamar' => [
                'required',
                'string',
                'max:50',

                // ✅ UNIQUE per kost, abaikan kamar sendiri
                Rule::unique('rooms', 'nomor_kamar')
                    ->ignore($room->id)
                    ->where(fn ($q) => $q->where('kost_id', $this->input('kost_id')))
            ],

            'status' => [
                'required',
                Rule::in(['available', 'occupied'])
            ],
        ];
    }

    public function messages()
    {
        return [
            'kost_id.required' => 'Kost harus dipilih.',
            'nomor_kamar.required' => 'Nomor kamar wajib diisi.',
            'nomor_kamar.unique' => 'Nomor kamar sudah digunakan pada kost ini.',
            'status.required' => 'Status wajib diisi.',
        ];
    }
}

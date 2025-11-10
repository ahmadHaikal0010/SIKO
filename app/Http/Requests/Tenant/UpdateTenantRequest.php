<?php

namespace App\Http\Requests\Tenant;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateTenantRequest extends FormRequest
{
    public function authorize(): bool
    {
        $tenant = $this->route('tenant') ?? $this->route('id');
        return Gate::allows('update', $tenant);
    }

    /**
     * Samakan label dari UI ke kode yang divalidasi.
     */
    protected function prepareForValidation(): void
    {
        $jk = strtolower(trim((string) $this->input('jenis_kelamin')));
        $pk = strtolower(trim((string) $this->input('pekerjaan')));
        $st = strtolower(trim((string) $this->input('status')));

        $mapJK = [
            'laki-laki' => 'laki-laki',
            'laki laki' => 'laki-laki',
            'l'         => 'laki-laki',
            'perempuan' => 'perempuan',
            'p'         => 'perempuan',
        ];

        $mapPK = [
            'pelajar'   => 'pelajar',
            'karyawan'  => 'karyawan',
            'wirausaha' => 'wirausaha',
            'lainnya'   => 'lainnya',
        ];

        $mapST = [
            'aktif'     => 'active',
            'nonaktif'  => 'inactive',
            'active'    => 'active',
            'inactive'  => 'inactive',
        ];

        $this->merge([
            'jenis_kelamin' => $mapJK[$jk] ?? $jk,
            'pekerjaan'     => $mapPK[$pk] ?? $pk,
            'status'        => $mapST[$st] ?? $st,
        ]);
    }

    public function rules(): array
    {
        $tenant      = $this->route('tenant');           // model dari route model binding
        $currentRoom = $tenant?->room_id ?? 0;           // id kamar saat ini

        return [
            // Jika pengikatan akun tidak wajib, boleh ubah ke ['nullable','exists:users,id']
            'user_id'        => ['required', 'exists:users,id'],

            // Boleh pilih kamar yang available ATAU kamar yang sedang ditempati tenant ini
            'room_id'        => [
                'required',
                Rule::exists('rooms', 'id')->where(function ($q) use ($currentRoom) {
                    $q->where('status', 'available')->orWhere('id', $currentRoom);
                }),
            ],

            'nama_penghuni'  => ['required', 'string', 'max:255'],
            'telpon'         => ['required', 'regex:/^[0-9 +()-]{6,20}$/'],

            'jenis_kelamin'  => [Rule::in(['laki-laki','perempuan'])],
            'pekerjaan'      => [Rule::in(['pelajar','karyawan','wirausaha','lainnya'])],

            'nama_wali'      => ['nullable', 'string', 'max:255'],
            'telpon_wali'    => ['nullable', 'regex:/^[0-9 +()-]{6,20}$/'],

            'tanggal_masuk'  => ['required', 'date'],
            'tanggal_keluar' => ['nullable', 'date', 'after_or_equal:tanggal_masuk'],

            'status'         => [Rule::in(['active','inactive'])],
        ];
    }

    public function messages(): array
    {
        return [
            'room_id.exists'        => 'Kamar tidak tersedia atau sudah ditempati.',
            'jenis_kelamin.in'      => 'Pilih jenis kelamin yang valid.',
            'pekerjaan.in'          => 'Pilih pekerjaan yang valid.',
            'status.in'             => 'Pilih status yang valid.',
            'telpon.regex'          => 'Format telepon tidak valid.',
            'telpon_wali.regex'     => 'Format telepon wali tidak valid.',
        ];
    }

    public function attributes(): array
    {
        return [
            'room_id'        => 'kamar',
            'nama_penghuni'  => 'nama penghuni',
            'telpon'         => 'telepon',
            'telpon_wali'    => 'telepon wali',
            'tanggal_masuk'  => 'tanggal masuk',
            'tanggal_keluar' => 'tanggal keluar',
        ];
    }
}

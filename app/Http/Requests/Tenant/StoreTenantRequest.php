<?php

namespace App\Http\Requests\Tenant;

use App\Models\Tenant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreTenantRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();
        // Admins may create tenants; a penghuni may create only if they don't already have a tenant record
        if ($user->role === 'admin') {
            return true;
        }
        if ($user->role === 'penghuni') {
            return $user->tenant === null;
        }
        return false;
    }

    /**
     * Samakan dulu nilai dari form ke "kode" yang divalidasi.
     * Contoh: "Laki-laki" -> "laki-laki", "Aktif" -> "active", dst.
     */
    protected function prepareForValidation(): void
    {
        $jk = strtolower(trim((string) $this->input('jenis_kelamin')));
        $pk = strtolower(trim((string) $this->input('pekerjaan')));
        $st = strtolower(trim((string) $this->input('status')));

        // map variasi penulisan ke kode yang konsisten
        $mapJK = [
            'laki-laki' => 'laki-laki',
            'laki laki' => 'laki-laki',
            'l'         => 'laki-laki',
            'perempuan' => 'perempuan',
            'p'         => 'perempuan',
        ];

        $mapPK = [
            'pelajar'   => 'pelajar',
            'mahasiswa' => 'mahasiswa', // kalau kamu tidak pakai, hapus juga dari rules
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
            // kalau tidak ada di map biarkan nilai aslinya (supaya validator yang menolak)
            'jenis_kelamin' => $mapJK[$jk] ?? $jk,
            'pekerjaan'     => $mapPK[$pk] ?? $pk,
            'status'        => $mapST[$st] ?? $st,
        ]);
    }

    public function rules(): array
    {
        return [
            // kalau pengikatan ke akun user belum wajib, jadikan nullable
            'user_id'        => ['nullable', 'exists:users,id'],

            // kamar harus ada dan statusnya "available"
            'room_id'        => [
                'required',
                Rule::exists('rooms', 'id')->where(fn ($q) => $q->where('status', 'available')),
            ],

            'nama_penghuni'  => ['required', 'string', 'max:255'],

            // longgar dulu: angka/plus/spasi (ubah sesuai kebutuhan)
            'telpon'         => ['required', 'regex:/^[0-9 +()-]{6,20}$/'],

            'jenis_kelamin'  => ['required', Rule::in(['laki-laki','perempuan'])],
            'pekerjaan'      => ['required', Rule::in(['pelajar','karyawan','wirausaha','lainnya'])],

            'nama_wali'      => ['nullable', 'string', 'max:255'],
            'telpon_wali'    => ['nullable', 'regex:/^[0-9 +()-]{6,20}$/'],

            'tanggal_masuk'  => ['required', 'date'],
            'tanggal_keluar' => ['nullable', 'date', 'after_or_equal:tanggal_masuk'],

            'status'         => ['required', Rule::in(['active','inactive'])],
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

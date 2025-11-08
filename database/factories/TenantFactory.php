<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant>
 */
class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'room_id' => Room::factory(),
            'nama_penghuni' => $this->faker->name(),
            'telpon' => $this->faker->phoneNumber(),
            'jenis_kelamin' => $this->faker->randomElement(['laki-laki', 'perempuan']),
            'pekerjaan' => $this->faker->randomElement(['pelajar', 'karyawan', 'wirausaha', 'lainnya']),
            'nama_wali' => $this->faker->name(),
            'telpon_wali' => $this->faker->phoneNumber(),
            'tanggal_masuk' => $this->faker->date(),
            'tanggal_keluar' => null,
            'status' => 'active',
        ];
    }
}

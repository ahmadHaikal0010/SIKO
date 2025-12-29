<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Complaint>
 */
class ComplaintFactory extends Factory
{
    public function definition(): array
    {
        $status = $this->faker->randomElement(['menunggu', 'ditanggapi', 'selesai']);

        return [
            'user_id' => User::factory(),
            'judul_keluhan' => $this->faker->sentence(4),
            'isi_keluhan' => $this->faker->paragraph(),
            'tanggal_ajukan' => $this->faker->date(),
            'status' => $status,
            'tanggapan' => $status !== 'menunggu' ? $this->faker->sentence() : null,
            'tanggal_tanggapan' => $status !== 'menunggu' ? $this->faker->date() : null,
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kost>
 */
class KostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_kost' => $this->faker->company(),
            'deskripsi' => $this->faker->paragraph(),
            'fasilitas' => $this->faker->sentence(),
            'alamat' => $this->faker->address(),
            'total_kamar' => $this->faker->numberBetween(1, 10),
            'harga_kost' => $this->faker->numberBetween(500000, 5000000),
            'kategori' => $this->faker->randomElement(['putra', 'putri']),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tenant_id' => Tenant::factory(),
            'jumlah_bayar' => $this->faker->randomFloat(2, 100000, 5000000),
            'tanggal_bayar' => $this->faker->date(),
            'periode_mulai' => $this->faker->date(),
            'periode_selesai' => $this->faker->date(),
            'metode_pembayaran' => $this->faker->randomElement(['cash', 'bank_transfer', 'e_wallet', 'cicilan']),
        ];
    }
}

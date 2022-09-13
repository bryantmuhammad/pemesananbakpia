<?php

namespace Database\Factories;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_kategori' => Kategori::factory(),
            'nama_produk' => $this->faker->name(),
            'harga' => 20000,
            'berat' => 200,
            'keterangan' => 'Keterangan',
            'foto' => 'foto-produk/' . $this->faker->image('public/storage/foto-produk', 640, 480, null, false)
        ];
    }
}

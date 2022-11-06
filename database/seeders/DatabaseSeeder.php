<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'      => 1
        ]);
        User::create([
            'name'              => 'Customer',
            'email'             => 'customer@gmail.com',
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'              => 3
        ]);

        $this->makeCategory();
    }

    public function makeCategory()
    {
        $kategoris = [
            'Bakpia isi 10',
            'Bakpia isi 20',
            'Bakpia isi 30'
        ];

        foreach ($kategoris as $kategori) {
            Kategori::factory()->has(Produk::factory()->count(5))->create([
                'nama_kategori' => $kategori
            ]);
        }
    }
}

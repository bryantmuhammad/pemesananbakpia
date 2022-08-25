<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => 1
        ]);

        Kategori::create([
            'nama_kategori' => 'Bakpia isi 10'
        ]);

        Kategori::create([
            'nama_kategori' => 'Bakpia isi 20'
        ]);

        Kategori::create([
            'nama_kategori' => 'Bakpia isi 30'
        ]);
    }
}

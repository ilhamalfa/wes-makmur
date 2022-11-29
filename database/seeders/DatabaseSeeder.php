<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Seeder;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $faker = fake('id_ID');

        for($i = 0; $i < 3; $i++){
            Kategori::create([
                'name' => $faker->name(),
                'desc' => $faker->text()
            ]);
        }

        User::create([
            'name' => 'admin-'.$faker->name(),
            'email' => 'adm@c.m',
            'password' => Hash::make(12345),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'editor-'.$faker->name(),
            'email' => 'edt@c.m',
            'password' => Hash::make(12345),
            'role' => 'editor'
        ]);
    }
}

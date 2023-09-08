<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Emails;
use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::truncate();
        User::factory(3)
            ->sequence(fn ($sequence) => ['email' => 'test'.$sequence->index.'@web.com'])
            ->create();

        Proyecto::truncate();
        Proyecto::factory(11)
            ->sequence(fn ($sequence) => ['user_id' => rand(1,3)])
            ->create();

        Emails::truncate();
        Emails::create(['envio_en_espera' => 0]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

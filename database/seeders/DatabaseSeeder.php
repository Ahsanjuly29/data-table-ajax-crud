<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // User::factory(10)->create();

        ini_set('memory_limit', '5120M');
        $k = 0;
        // 13107
        for ($j = 1; $j <= ceil(1000000 / (65535 / 3)); $j++) {
            echo 'J: ' . $j;
            for ($i = 1; $i <= (65535 / 3); $i++) {
                echo ++$k . "\n";
                $data[] = [
                    'name' => fake()->name(),
                    'email' => $k . fake()->unique()->safeEmail(),
                    'password' => '$2y$12$iURG7b1bm/g8OGGrr7WOmeGT.vCTP/Tgt/W1O2djkif2SMUR8GP0i',
                    // 'email_verified_at' => now(),
                    // 'remember_token' => Str::random(10),
                ];
            }
            User::insert($data);
            $data = [];
        }
    }
}

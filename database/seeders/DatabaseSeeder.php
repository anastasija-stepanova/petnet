<?php

namespace Database\Seeders;

use App\Models\PetBreed;
use App\Models\PetType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            GenderSeeder::class,
            PetTypeSeeder::class,
            PetBreedSeeder::class,
        ]);
    }
}

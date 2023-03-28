<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PetTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $petTypes = [
            'Cat',
            'Dog',
            'Mouse',
            'Parrot',
            'Fish',
        ];
        foreach ($petTypes as $petType) {
            DB::table('pet_types')->insert([
                'name' => $petType,
            ]);
        }
    }
}

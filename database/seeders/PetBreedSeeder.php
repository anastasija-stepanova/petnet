<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PetBreedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $breeds = [
            'Golden Retrievers',
            'Boston Terriers',
            'Labrador Retrievers',
            'Poodles',
            'Border Collie',
            'Beagle',
            'Irish Setter',
        ];
        foreach ($breeds as $breed) {
            DB::table('pet_breeds')->insert([
                'name' => $breed,
            ]);
        }
    }
}

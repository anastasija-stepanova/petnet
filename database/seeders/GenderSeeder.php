<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genders = [
            'male',
            'female',
        ];
        foreach ($genders as $gender) {
            DB::table('genders')->insert([
                'type' => $gender,
            ]);
        }
    }
}

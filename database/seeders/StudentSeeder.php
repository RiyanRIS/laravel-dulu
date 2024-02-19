<?php

namespace Database\Seeders;

use App\Models\Student;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $length = 15;
        $faker = Faker::create();
        for ($i=0; $i < $length; $i++) { 
            Student::create([
                'nama_lengkap' => $faker->name,
                'kelas' => "Kelas 5",
                'no_absen' => $faker->numberBetween(0,60),
                'tanggal_lahir' => $faker->date()
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Divisi;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Divisi::create(['nama_divisi' => 'Ketum']);
        Divisi::create(['nama_divisi' => 'Sekretaris']);
        Divisi::create(['nama_divisi' => 'Bendahara']);
        Divisi::create(['nama_divisi' => 'Keanggotaan']);
        Divisi::create(['nama_divisi' => 'Bag. Pendidikan & Riset']);

    }
}

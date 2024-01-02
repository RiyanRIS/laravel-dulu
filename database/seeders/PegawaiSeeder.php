<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pegawai::create(
            [
                'nama_pegawai' => 'Anton Hilaludin. S.Pd, MM',
                'jabatan' => 'Ketua Umum',
                'id_divisi' => 1 // divisi ketua umum
            ]
        );
        Pegawai::create(
            [
                'nama_pegawai' => 'Benny Sirojudin. SH',
                'jabatan' => 'Sekretaris',
                'id_divisi' => 2
            ]
        );
        Pegawai::create(
            [
                'nama_pegawai' => 'Syaeful Bahri, ST, MT.',
                'jabatan' => 'Bendahara',
                'id_divisi' => 3
            ]
        );
    }
}

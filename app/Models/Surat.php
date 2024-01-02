<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Surat extends Model
{
    use SoftDeletes;

    protected $table = 'surat';
    protected $fillable = [
        'nomor_surat', 'tanggal_kirim', 'perihal', 'id_pengirim', 'id_penerima', 'status'
    ];

    public function pengirim()
    {
        return $this->belongsTo(Pegawai::class, 'id_pengirim');
    }

    public function penerima()
    {
        return $this->belongsTo(Pegawai::class, 'id_penerima');
    }

    public function saveFile($file)
    {
        $filePath = $file->store('surat', 'surat');
        $this->file_path = $filePath;
        $this->save();
    }

    public function updateFile($surat, $request)
    {
        if ($surat->file_path) {
            Storage::disk('surat')->delete($surat->file_path);
        }

        $file = $request->file('file');
        $filePath = $file->store('surat', 'surat');
        $surat->file_path = $filePath;
        $surat->save();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pegawai';
    protected $fillable = ['nama_pegawai', 'jabatan', 'id_divisi'];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi');
    }

}

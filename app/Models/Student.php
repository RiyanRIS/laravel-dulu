<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $table = 'student';
    protected $fillable = ['nama_lengkap', 'kelas', 'no_absen', 'tanggal_lahir'];
}

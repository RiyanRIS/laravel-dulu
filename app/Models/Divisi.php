<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Divisi extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'divisi';
    protected $fillable = ['nama_divisi', 'deskripsi_divisi'];

}

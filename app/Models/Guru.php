<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $fillable = [
        'nama_guru',
        'nip',
        'mata_pelajaran',
        'jenis_kelamin',
        'email',
        'foto'
    ];
}

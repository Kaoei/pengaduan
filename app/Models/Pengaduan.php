<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{

    protected $table = 'pengaduans';
    protected $fillable = ['tgl_pengaduan', 'user_id', 'isi_laporan', 'status','foto'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

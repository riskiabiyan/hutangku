<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Penghutang extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'penghutang';

    protected $fillable = [
        'user_id',
        'nama_penghutang',
        'alamat_penghutang',
        'no_wa',
    ];

    public function hutang()
    {
        return $this->hasMany(Hutang::class, 'penghutang_id');
    }

    public function hutang_masuk()
    {
        return $this->hasMany(Hutang_masuk::class, 'penghutang_id');
    }

    public function hutang_dibayar()
    {
        return $this->hasMany(Hutang_dibayar::class, 'penghutang_id');
    }

}

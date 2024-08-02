<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Hutang_dibayar extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'hutang_dibayar';

    protected $fillable = [
        'user_id',
        'penghutang_id',
        'keterangan',
        'jumlah_dibayar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function penghutang()
    {
        return $this->belongsTo(Penghutang::class, 'penghutang_id');
    }
}

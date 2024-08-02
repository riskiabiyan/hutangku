<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Hutang extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'hutang';

    protected $fillable = [
        'user_id',
        'penghutang_id',
        'jumlah_hutang',
        'tgl_jatuh_tempo',
        'status_hutang',
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

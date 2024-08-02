<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     * 
     */

    protected $table = 'user';

    protected $fillable = [
        'nama_lengkap',
        'no_hp',
        'email',
        'password',
    ];

    public function hutang()
    {
        return $this->hasMany(Hutang::class, 'user_id');
    }

    public function hutang_masuk()
    {
        return $this->hasMany(Hutang_masuk::class, 'user_id');
    }

    public function hutang_dibayar()
    {
        return $this->hasMany(Hutang_dibayar::class, 'user_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

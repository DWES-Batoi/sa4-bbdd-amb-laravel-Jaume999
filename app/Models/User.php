<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// 1. Importamos el Trait de Sanctum
use Laravel\Sanctum\HasApiTokens; 

class User extends Authenticatable
{
    // 2. Añadimos HasApiTokens aquí junto a los demás
    use HasApiTokens, HasFactory, Notifiable;

    public const ROLE_ADMIN = 'administrador';
    public const ROLE_CONVIDAT = 'convidat';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'equip_id',
        'google_id',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function equip()
    {
        return $this->belongsTo(Equip::class, 'equip_id');
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
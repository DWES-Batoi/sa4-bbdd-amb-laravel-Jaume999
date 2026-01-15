<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equip extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'estadi_id', 'titols', 'escut'];

    public function estadi()
    {
        return $this->belongsTo(Estadi::class);
    }

    public function manager()
    {
        return $this->hasOne(User::class, 'equip_id')
            ->where('role', 'manager');
    }
}
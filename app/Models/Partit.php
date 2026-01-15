<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partit extends Model
{
    use HasFactory;
    protected $fillable = ['local_id', 'visitant_id', 'estadi_id', 'data', 'jornada', 'gols_local', 'gols_visitant'];

    public function local() {
        return $this->belongsTo(Equip::class, 'local_id');
    }

    public function visitant() {
        return $this->belongsTo(Equip::class, 'visitant_id');
    }

    public function estadi() {
        return $this->belongsTo(Estadi::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\EquipFactory;
use Carbon\Carbon;

/**
 * Model EQUIP
 */
class Equip extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'estadi_id', 'titols', 'escut'];

    /**
     * Un equip pertany a un estadi
     */
    public function estadi()
    {
        return $this->belongsTo(Estadi::class);
    }

    /**
     * (Opcional) relació amb un usuari manager
     */
    public function manager()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Enllacem explícitament amb la factory
     */
    protected static function newFactory()
    {
        return EquipFactory::new();
    }

    // En app/Models/Equip.php
    public function jugadoras() {
        return $this->hasMany(Jugadora::class);
    }

    public function partitsComLocal() {
        return $this->hasMany(Partit::class, 'local_id');
    }

    public function partitsComVisitant() {
        return $this->hasMany(Partit::class, 'visitant_id');
    }

    public function edadMedia()
    {
        $jugadoras = $this->jugadoras;

        if ($jugadoras->isEmpty()) {
            return 0;
        }

        $media = $jugadoras->avg(function($jugadora) {
            return Carbon::parse($jugadora->data_naixement)->age;
        });

        return round($media, 1);
    }

    public function ultimsPartits()
    {
        return \App\Models\Partit::where(function($query) {
                $query->where('local_id', $this->id)
                    ->orWhere('visitant_id', $this->id);
            })
            ->where('data', '<', now())
            ->orderBy('data', 'desc')
            ->take(5)
            ->get();
    }

}

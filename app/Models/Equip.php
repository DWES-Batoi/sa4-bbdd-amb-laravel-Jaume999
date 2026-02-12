<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Equip extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'estadi_id', 'titols', 'escut', 'ciutat'];

    /**
     * Relación con el Estadio
     */
    public function estadi()
    {
        return $this->belongsTo(Estadi::class);
    }

    /**
     * Relación con las Jugadoras (Usando equip_id de tu migración)
     */
    public function jugadoras()
    {
        return $this->hasMany(Jugadora::class, 'equip_id');
    }

    /**
     * Calcula la edad media basándose en 'data_naixement'
     */
    public function edadMedia()
    {
        $promedio = $this->jugadoras->avg(function($jugadora) {
            return Carbon::parse($jugadora->data_naixement)->age;
        });

        return round($promedio ?? 0, 1);
    }

    /**
     * Obtiene los últimos partidos usando los nombres de columna de tu migración:
     * 'local_id', 'visitant_id' y 'data'
     */
    public function ultimsPartits($limit = 5)
    {
        // Usamos 'with' para traer los datos completos de los equipos y asegurar la carga de columnas
        return Partit::with(['local', 'visitant'])
            ->where(function($query) {
                $query->where('local_id', $this->id)
                    ->orWhere('visitant_id', $this->id);
            })
            ->orderBy('data', 'desc') 
            ->take($limit)
            ->get();
    }

    /**
     * Relaciones de partidos (Local y Visitante)
     */
    public function partitsHome()
    {
        return $this->hasMany(Partit::class, 'local_id');
    }

    public function partitsAway()
    {
        return $this->hasMany(Partit::class, 'visitant_id');
    }

    public function manager()
    {
        return $this->hasOne(User::class, 'equip_id')
            ->where('role', 'manager');
    }
}
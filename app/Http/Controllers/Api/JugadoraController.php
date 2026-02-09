<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JugadoraRequest;
use App\Http\Resources\JugadoraResource;
use App\Models\Jugadora;
use Illuminate\Http\Request;

class JugadoraController extends Controller
{
    /**
     * Llistat amb paginació (Punt 9)
     */
    public function index()
    {
        // Paginem de 10 en 10. El Resource s'encarrega d'afegir els links de navegació.
        return JugadoraResource::collection(
            Jugadora::with('equip')->paginate(10)
        );
    }

    /**
     * Detall d'una jugadora (Punt 8.3)
     */
    public function show(Jugadora $jugadora)
    {
        return new JugadoraResource($jugadora->load('equip'));
    }

    /**
     * Crear jugadora usant el teu JugadoraRequest
     */
    public function store(JugadoraRequest $request)
    {
        if (!in_array(auth()->user()->role, ['administrador'])){
            return response()->json(
                ['success' => false,
                'message' => 'Solo administradores',
                ],403
            );
        }

        $jugadora = Jugadora::create($request->validated());

        // Retornem el Resource per mantenir el format JSON consistent
        return (new JugadoraResource($jugadora->load('equip')))
                ->response()
                ->setStatusCode(201);
    }

    /**
     * Actualitzar jugadora
     */
    public function update(JugadoraRequest $request, Jugadora $jugadora)
    {
        if (!in_array(auth()->user()->role, ['administrador'])){
            return response()->json(
                ['success' => false,
                'message' => 'Solo administradores',
                ],403
            );
        }

        $jugadora->update($request->validated());

        return new JugadoraResource($jugadora->load('equip'));
    }

    /**
     * Eliminar jugadora
     */
    public function destroy(Jugadora $jugadora)
    {
        if (!in_array(auth()->user()->role, ['administrador'])){
            return response()->json(
                ['success' => false,
                'message' => 'Solo administradores',
                ],403
            );
        }
        
        $jugadora->delete();

        return response()->noContent(); // Retorna 204
    }
}
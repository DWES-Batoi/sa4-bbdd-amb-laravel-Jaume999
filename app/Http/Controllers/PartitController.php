<?php

namespace App\Http\Controllers;

use App\Models\Partit;
use App\Models\Equip;
use App\Models\Estadi;
use Illuminate\Http\Request;

class PartitController extends Controller
{
    // GET /partits - Llistat de partits
    public function index() {
        $partits = Partit::with(['local', 'visitant', 'estadi'])
                         ->orderBy('jornada')
                         ->orderBy('data')
                         ->get();
        return view('partits.index', compact('partits'));
    }

    // GET /partits/create - Formulari nou partit
    public function create() {
        $equips = Equip::all();
        $estadis = Estadi::all();
        return view('partits.create', compact('equips', 'estadis'));
    }

    // POST /partits - Guardar en BBDD
    public function store(Request $request) {
        $validated = $request->validate([
            'local_id'    => 'required|exists:equips,id',
            'visitant_id' => 'required|exists:equips,id|different:local_id',
            'estadi_id'   => 'required|exists:estadis,id',
            'data'        => 'required|date',
            'jornada'     => 'required|integer|min:1',
            'gols_local'  => 'nullable|integer|min:0',
            'gols_visitant' => 'nullable|integer|min:0',
        ]);

        Partit::create($validated);

        return redirect()->route('partits.index')->with('success', 'Partit programat correctament!');
    }

    // GET /partits/{partit} - Detall d'un partit
    public function show(Partit $partit) {
        $partit->load(['local', 'visitant', 'estadi']);
        return view('partits.show', compact('partit'));
    }

    // GET /partits/{partit}/edit - Formulari d'edició
    public function edit(Partit $partit) {
        $equips = Equip::all();
        $estadis = Estadi::all();
        return view('partits.edit', compact('partit', 'equips', 'estadis'));
    }

    // PUT /partits/{partit} - Actualitzar
    public function update(Request $request, Partit $partit) {
        $validated = $request->validate([
            'local_id'    => 'required|exists:equips,id',
            'visitant_id' => 'required|exists:equips,id|different:local_id',
            'estadi_id'   => 'required|exists:estadis,id',
            'data'        => 'required|date',
            'jornada'     => 'required|integer|min:1',
            'gols_local'  => 'integer|min:0',
            'gols_visitant' => 'integer|min:0',
        ]);

        $partit->update($validated);

        return redirect()->route('partits.index')->with('success', 'Resultat/Dades actualitzades!');
    }

    // DELETE /partits/{partit}
    public function destroy(Partit $partit) {
        $partit->delete();
        return redirect()->route('partits.index')->with('success', 'Partit eliminat');
    }
}

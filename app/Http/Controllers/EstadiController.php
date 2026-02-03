<?php

namespace App\Http\Controllers;

use App\Models\Estadi;
use Illuminate\Http\Request;

class EstadiController extends Controller
{
    /**
     * Llista tots els estadis.
     */
    public function index()
    {
        $estadis = Estadi::all();
        return view('estadis.index', compact('estadis'));
    }

    /**
     * Mostra el detall d'un estadi.
     */
    public function show(Estadi $estadi)
    {
        return view('estadis.show', compact('estadi'));
    }

    /**
     * Mostra el formulari per crear un nou estadi.
     */
    public function create()
    {
        return view('estadis.create');
    }

    /**
     * Guarda un nou estadi a la base de dades amb validació.
     */
    public function store(Request $request)
    {
        // Validació: si falla, Laravel torna a la vista anterior amb els errors
        $request->validate([
            'nom' => 'required|min:3|max:255',
            'capacitat' => 'required|integer|min:0',
        ], [
            // Missatges d'error personalitzats
            'nom.required' => 'El camp Nom de l’estadi és obligatori.',
            'nom.min' => 'El nom ha de tenir almenys 3 caràcters.',
            'capacitat.required' => 'Has d’indicar la capacitat de l’estadi.',
            'capacitat.integer' => 'La capacitat ha de ser un número sencer.',
            'capacitat.min' => 'La capacitat no pot ser un número negatiu.',
        ]);

        // Guardar l'estadi (Només si la validació ha passat)
        Estadi::create($request->all());

        return redirect()
            ->route('estadis.index')
            ->with('success', 'Estadi afegit correctament!');
    }

    /**
     * Mostra el formulari per editar un estadi existent.
     */
    public function edit(Estadi $estadi)
    {
        return view('estadis.edit', compact('estadi'));
    }

    /**
     * Actualitza un estadi a la base de dades amb validació.
     */
    public function update(Request $request, Estadi $estadi)
    {
        // Validació per a l'actualització
        $request->validate([
            'nom' => 'required|min:3|max:255',
            'capacitat' => 'required|integer|min:0',
        ], [
            'nom.required' => 'El camp Nom no pot estar buit.',
            'capacitat.required' => 'La capacitat és obligatòria.',
        ]);

        $estadi->update($request->all());

        return redirect()
            ->route('estadis.index')
            ->with('success', 'Estadi actualitzat correctament!');
    }

    /**
     * Elimina un estadi de la base de dades.
     */
    public function destroy(Estadi $estadi)
    {
        $estadi->delete();

        return redirect()
            ->route('estadis.index')
            ->with('success', 'Estadi esborrat correctament!');
    }
}
<?php
namespace App\Repositories;
use App\Models\Jugadora;

class JugadoraRepository implements BaseRepository {
    public function getAll() { return Jugadora::with('equip')->get(); }
    public function find($id) { return Jugadora::findOrFail($id); }
    public function create(array $data) { return Jugadora::create($data); }
    public function update($id, array $data) {
        $j = $this->find($id);
        $j->update($data);
        return $j;
    }
    public function delete($id) { return Jugadora::destroy($id); }
}

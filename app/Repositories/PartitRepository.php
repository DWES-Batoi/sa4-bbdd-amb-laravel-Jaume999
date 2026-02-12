<?php
namespace App\Repositories;
use App\Models\Partit;

class PartitRepository implements BaseRepository {
    public function getAll() { return Partit::with(['local', 'visitant', 'estadi'])->get(); }
    public function find($id) { return Partit::findOrFail($id); }
    public function create(array $data) { return Partit::create($data); }
    public function update($id, array $data) {
        $p = $this->find($id);
        $p->update($data);
        return $p;
    }
    public function delete($id) { return Partit::destroy($id); }
}
?>

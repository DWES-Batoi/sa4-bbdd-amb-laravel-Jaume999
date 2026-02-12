<?php

namespace App\Http\Controllers\Api;

use App\Models\Equip;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\EquipResource;

class EquipController extends BaseController
{
    /**
     * GET /api/equips
     */
    public function index()
    {
        $equips = Equip::all();
        return $this->sendResponse(EquipResource::collection($equips), 'Llistat d\'equips recuperat.');
    }

    /**
     * POST /api/equips
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'nom'       => 'required|string|unique:equips,nom',
            'ciutat'    => 'required|string',
            'estadi_id' => 'required|exists:estadis,id',
            'titols'    => 'integer',
            'escut'     => 'nullable|string'
        ]);

        if($validator->fails()){
            return $this->sendError('Error de validació.', $validator->errors());       
        }

        $equip = Equip::create($input);

        return $this->sendResponse(new EquipResource($equip), 'Equip creat correctament.', 201);
    }

    /**
     * GET /api/equips/{id}
     */
    public function show($id)
    {
        $equip = Equip::find($id);

        if (is_null($equip)) {
            return $this->sendError('Equip no trobat.');
        }

        return $this->sendResponse(new EquipResource($equip), 'Equip recuperat correctament.');
    }


    /**
     * UPDATE /api/equips/{id}
     */
    public function update(Request $request, $id)
    {
        $equip = Equip::find($id);

        if (is_null($equip)) {
            return $this->sendError('Equip no trobat.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'nom'       => 'required|string|unique:equips,nom,' . $id,
            'ciutat'    => 'required|string',
            'estadi_id' => 'required|exists:estadis,id',
            'titols'    => 'integer',
            'escut'     => 'nullable|string'
        ]);

        if($validator->fails()){
            return $this->sendError('Error de validació.', $validator->errors());       
        }

        $equip->nom = $input['nom'];
        $equip->ciutat = $input['ciutat'];
        $equip->estadi_id = $input['estadi_id'];
        $equip->titols = $input['titols'] ?? $equip->titols;
        $equip->escut = $input['escut'] ?? $equip->escut;
        
        $equip->save();

        return $this->sendResponse(new EquipResource($equip), 'Equip actualitzat correctament.');
    }

    /**
     * DELETE /api/equips/{id}
     */
    public function destroy($id)
    {
        $equip = Equip::find($id);

        if (is_null($equip)) {
            return $this->sendError('Equip no trobat.');
        }

        $equip->delete();

        return $this->sendResponse([], 'Equip eliminat correctament.');
    }
}
@extends('layouts.app')
@section('title', 'Nova Jugadora')

@section('content')
<h1 class="text-2xl font-bold mb-4">Inscriure nova jugadora</h1>

@if ($errors->any())
  <div class="bg-red-100 text-red-700 p-2 mb-4">
    <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
  </div>
@endif

<form action="{{ route('jugadoras.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
  @csrf
  <div>
    <label class="block font-bold">Nom:</label>
    <input type="text" name="nom" value="{{ old('nom') }}" class="border p-2 w-full">
  </div>

  <div>
    <label class="block font-bold">Equip:</label>
    <select name="equip_id" class="border p-2 w-full">
      @foreach ($equips as $equip)
        <option value="{{ $equip->id }}" {{ old('equip_id') == $equip->id ? 'selected' : '' }}>{{ $equip->nom }}</option>
      @endforeach
    </select>
  </div>

  <div class="flex gap-4">
    <div class="w-1/2">
        <label class="block font-bold">Data Naixement:</label>
        <input type="date" name="data_naixement" value="{{ old('data_naixement') }}" class="border p-2 w-full">
    </div>
    <div class="w-1/2">
        <label class="block font-bold">Dorsal:</label>
        <input type="number" name="dorsal" value="{{ old('dorsal') }}" class="border p-2 w-full">
    </div>
  </div>

  <div>
    <label class="block font-bold">Foto (PNG):</label>
    <input type="file" name="foto" class="border p-2 w-full">
  </div>

  <button type="submit" class="btn btn--primary">Registrar Jugadora</button>
</form>
@endsection

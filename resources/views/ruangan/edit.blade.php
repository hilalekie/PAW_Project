@extends('layouts.app')

@section('title', 'Edit Ruangan')

@section('content')
<h3>Edit Ruangan</h3>

<form action="{{ route('ruangan.update', $ruangan) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Ruangan</label>
        <input type="text"
               name="nama_ruangan"
               class="form-control"
               value="{{ old('nama_ruangan', $ruangan->nama_ruangan) }}"
               required>

        @error('nama_ruangan')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label>Harga per Jam</label>
        <input type="number"
               name="harga_per_jam"
               class="form-control"
               value="{{ old('harga_per_jam', $ruangan->harga_per_jam) }}"
               min="0"
               required>

        @error('harga_per_jam')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-select" required>
            <option value="tersedia" {{ old('status', $ruangan->status) == 'tersedia' ? 'selected' : '' }}>
                Tersedia
            </option>
            <option value="dipakai" {{ old('status', $ruangan->status) == 'dipakai' ? 'selected' : '' }}>
                Dipakai
            </option>
        </select>

        @error('status')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('ruangan.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
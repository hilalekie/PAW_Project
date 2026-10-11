<div class="mb-3">
    <label for="nama" class="form-label">Nama Pelanggan</label>
    <input
        type="text"
        id="nama"
        name="nama"
        class="form-control"
        value="{{ old('nama', $pelanggan->nama ?? '') }}"
        required
    >
    @error('nama')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label for="no_hp" class="form-label">Nomor HP</label>
    <input
        type="text"
        id="no_hp"
        name="no_hp"
        class="form-control"
        value="{{ old('no_hp', $pelanggan->no_hp ?? '') }}"
        required
    >
    @error('no_hp')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label for="alamat" class="form-label">Alamat</label>
    <textarea
        id="alamat"
        name="alamat"
        class="form-control"
        rows="3"
    >{{ old('alamat', $pelanggan->alamat ?? '') }}</textarea>
    @error('alamat')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Batal</a>
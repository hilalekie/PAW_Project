<div class="mb-3">
    <label>Pelanggan</label>
    <select name="pelanggan_id" class="form-select">
        <option value="">-- Pilih pelanggan --</option>
        @foreach ($pelanggans as $p)
            <option value="{{ $p->id }}" {{ old('pelanggan_id', $booking->pelanggan_id ?? '') == $p->id ? 'selected' : '' }}>
                {{ $p->nama }}
            </option>
        @endforeach
    </select>
    @error('pelanggan_id') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label>Konsol / Ruangan</label>
    <select name="konsol_id" class="form-select">
        <option value="">-- Pilih konsol --</option>
        @foreach ($konsols as $k)
            <option value="{{ $k->id }}" {{ old('konsol_id', $booking->konsol_id ?? '') == $k->id ? 'selected' : '' }}>
                {{ $k->nama_konsol }} - {{ $k->ruangan }} (Rp {{ number_format($k->harga_per_jam, 0, ',', '.') }}/jam)
            </option>
        @endforeach
    </select>
    @error('konsol_id') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label>Tanggal</label>
    <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $booking->tanggal ?? '') }}">
    @error('tanggal') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label>Jam Mulai</label>
    <input type="time" name="jam_mulai" class="form-control"
           value="{{ old('jam_mulai', isset($booking) ? substr($booking->jam_mulai, 0, 5) : '') }}">
    @error('jam_mulai') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label>Durasi (jam)</label>
    <input type="number" name="durasi" min="1" max="12" class="form-control" value="{{ old('durasi', $booking->durasi ?? 1) }}">
    @error('durasi') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-select">
        @foreach (['dipesan', 'selesai', 'batal'] as $s)
            <option value="{{ $s }}" {{ old('status', $booking->status ?? 'dipesan') == $s ? 'selected' : '' }}>
                {{ ucfirst($s) }}
            </option>
        @endforeach
    </select>
    @error('status') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<button class="btn btn-primary">Simpan</button>
<a href="{{ route('booking.index') }}" class="btn btn-secondary">Batal</a>
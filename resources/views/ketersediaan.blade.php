<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Rental PS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4" style="max-width: 720px;">
    <h3 class="text-center mb-1">Booking Rental PS</h3>
    <p class="text-center text-muted">Pilih tanggal dan jam dulu, nanti kami tampilkan ruangan yang kosong.</p>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $e)
                <div>{{ $e }}</div>
            @endforeach
        </div>
    @endif

    {{-- Langkah 1: pilih tanggal, jam, durasi --}}
    <form method="GET" action="{{ route('ketersediaan') }}" class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-2">
                <div class="col-md-4">
                    <label class="form-label small">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ $tanggal }}" min="{{ now()->toDateString() }}" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label small">Jam mulai</label>
                    <select name="jam" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        @foreach ($jamList as $j)
                            <option value="{{ $j }}" {{ $jam !== null && (int) $jam === $j ? 'selected' : '' }}>
                                {{ str_pad($j, 2, '0', STR_PAD_LEFT) }}:00
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label small">Durasi</label>
                    <select name="durasi" class="form-select" required>
                        @foreach (range(1, 8) as $d)
                            <option value="{{ $d }}" {{ (int) ($durasi ?? 1) === $d ? 'selected' : '' }}>
                                {{ $d }} jam
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn btn-primary w-100">Cari</button>
                </div>
            </div>
        </div>
    </form>

    {{-- Langkah 2: hasil pencarian ruangan --}}
    @if ($pesan)
        <div class="alert alert-warning">{{ $pesan }}</div>
    @elseif ($hasil)
        @php
            $mulai = str_pad($jam, 2, '0', STR_PAD_LEFT);
            $selesai = str_pad($jam + $durasi, 2, '0', STR_PAD_LEFT);
        @endphp

        <h5 class="mb-3">
            Ruangan untuk {{ \Carbon\Carbon::parse($tanggal)->format('d-m-Y') }},
            {{ $mulai }}:00 - {{ $selesai }}:00 ({{ $durasi }} jam)
        </h5>

        @if ($hasil->where('kosong', true)->isEmpty())
            <div class="alert alert-danger">
                Maaf, semua ruangan sudah terisi di jam itu. Coba jam atau tanggal lain.
            </div>
        @else
            <form method="POST" action="{{ route('ketersediaan.store') }}">
                @csrf

                <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                <input type="hidden" name="jam_mulai" value="{{ $mulai }}:00">
                <input type="hidden" name="durasi" value="{{ $durasi }}">

                <div class="row g-3 mb-3">
                    @foreach ($hasil as $r)
                        <div class="col-md-6">
                            <input type="radio"
                                   class="btn-check"
                                   name="ruangan_id"
                                   id="r{{ $r->id }}"
                                   value="{{ $r->id }}"
                                   autocomplete="off"
                                   required
                                   {{ $r->kosong ? '' : 'disabled' }}>

                            <label for="r{{ $r->id }}"
                                   class="btn {{ $r->kosong ? 'btn-outline-success' : 'btn-outline-secondary' }} w-100 text-start p-3">

                                <div class="fw-bold">
                                    {{ $r->nama_ruangan }}
                                </div>

                                <div class="small">
                                    Rp {{ number_format($r->harga_per_jam, 0, ',', '.') }}/jam
                                </div>

                                @if ($r->kosong)
                                    <div class="small">
                                        Total: Rp {{ number_format($r->harga_per_jam * $durasi, 0, ',', '.') }}
                                    </div>
                                @else
                                    <div class="small">
                                        Sudah terisi
                                    </div>
                                @endif
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-md-5">
                                <input type="text"
                                       name="nama"
                                       class="form-control"
                                       placeholder="Nama kamu"
                                       value="{{ old('nama') }}"
                                       required>
                            </div>

                            <div class="col-md-4">
                                <input type="text"
                                       name="no_hp"
                                       class="form-control"
                                       placeholder="No HP / WhatsApp"
                                       value="{{ old('no_hp') }}"
                                       required>
                            </div>

                            <div class="col-md-3">
                                <button class="btn btn-primary w-100">Booking</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endif
    @endif

    <p class="text-center mt-4">
        <a href="{{ route('login') }}">Login Admin</a>
    </p>
</div>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mabarin - Booking Rental PlayStation</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .hero-banner {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            color: white;
            padding: 3rem 1rem 4rem;
            border-radius: 0 0 2rem 2rem;
        }
        .search-card {
            margin-top: -2.5rem;
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08);
        }
        .room-radio:checked + .room-card {
            border-color: #16a34a !important;
            background-color: #f0fdf4 !important;
            box-shadow: 0 4px 12px rgba(22, 163, 74, 0.15);
        }
        .room-card {
            border: 2px solid #e2e8f0;
            border-radius: 0.85rem;
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .room-card:hover:not(.disabled) {
            border-color: #22c55e;
            transform: translateY(-2px);
        }
        .room-card.disabled {
            background-color: #f1f5f9;
            opacity: 0.6;
            cursor: not-allowed;
        }
        .badge-status {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
            border-radius: 0.5rem;
        }
    </style>
</head>
<body>


<div class="hero-banner text-center">
    <div class="container" style="max-width: 720px;">
        <span class="badge bg-primary bg-opacity-25 text-info px-3 py-2 rounded-pill mb-2 fs-7">
            <i class="bi bi-controller me-1"></i> Rental PS & Game Room
        </span>
        <h2 class="fw-bold mb-2">Booking Ruangan "Mabarin"</h2>
        <p class="text-white-50 mb-0">Pilih tanggal dan jam main kamu, lalu booking ruangan yang tersedia secara online.</p>
    </div>
</div>

<div class="container pb-5" style="max-width: 760px;">
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3 rounded-3 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2 fs-5 align-middle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mt-3 rounded-3 shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2 fs-5 align-middle"></i>
            <strong>Perhatian:</strong>
            <ul class="mb-0 mt-1 ps-3">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    
    <form method="GET" action="{{ route('ketersediaan') }}" class="card search-card bg-white p-3 p-md-4 mb-4">
        <h6 class="fw-bold text-dark mb-3">
            <i class="bi bi-search text-primary me-2"></i>1. Cari Ketersediaan Jam
        </h6>
        <div class="row g-2">
            <div class="col-md-4">
                <label class="form-label fs-7 text-muted fw-semibold mb-1">Tanggal Main</label>
                <input type="date" name="tanggal" value="{{ $tanggal }}" min="{{ now()->toDateString() }}" class="form-control rounded-3" required>
            </div>

            <div class="col-md-3">
                <label class="form-label fs-7 text-muted fw-semibold mb-1">Jam Mulai</label>
                <select name="jam" class="form-select rounded-3" required>
                    <option value="">-- Jam --</option>
                    @foreach ($jamList as $j)
                        <option value="{{ $j }}" {{ $jam !== null && (int) $jam === $j ? 'selected' : '' }}>
                            {{ str_pad($j, 2, '0', STR_PAD_LEFT) }}:00 WIB
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label fs-7 text-muted fw-semibold mb-1">Durasi Main</label>
                <select name="durasi" class="form-select rounded-3" required>
                    @foreach (range(1, 8) as $d)
                        <option value="{{ $d }}" {{ (int) ($durasi ?? 1) === $d ? 'selected' : '' }}>
                            {{ $d }} Jam
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-primary w-100 rounded-3 fw-semibold py-2">
                    Cari
                </button>
            </div>
        </div>
    </form>

    
    @if ($pesan)
        <div class="alert alert-warning rounded-3 shadow-sm text-center py-3">
            <i class="bi bi-info-circle fs-4 d-block mb-1"></i> {{ $pesan }}
        </div>
    @elseif ($hasil)
        @php
            $mulai = str_pad($jam, 2, '0', STR_PAD_LEFT);
            $selesai = str_pad($jam + $durasi, 2, '0', STR_PAD_LEFT);
        @endphp

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold text-dark mb-0">
                <i class="bi bi-door-open text-primary me-2"></i>2. Pilih Ruangan Kosong
            </h6>
            <span class="badge bg-secondary bg-opacity-10 text-dark border px-2 py-1 fs-7">
                {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }} | {{ $mulai }}:00 - {{ $selesai }}:00 ({{ $durasi }} jam)
            </span>
        </div>

        @if ($hasil->where('kosong', true)->isEmpty())
            <div class="card border-danger bg-danger bg-opacity-10 rounded-3 text-center p-4">
                <i class="bi bi-emoji-frown fs-1 text-danger mb-2"></i>
                <h6 class="fw-bold text-danger">Maaf, Semua Ruangan Penuh!</h6>
                <p class="small text-muted mb-0">Seluruh ruangan sudah terisi di jam tersebut. Silakan pilih jam atau tanggal lain di atas.</p>
            </div>
        @else
            <form method="POST" action="{{ route('ketersediaan.store') }}">
                @csrf
                <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                <input type="hidden" name="jam_mulai" value="{{ $mulai }}:00">
                <input type="hidden" name="durasi" value="{{ $durasi }}">

                <div class="row g-3 mb-4">
                    @foreach ($hasil as $r)
                        <div class="col-md-6">
                            <input type="radio"
                                   class="btn-check room-radio"
                                   name="ruangan_id"
                                   id="r{{ $r->id }}"
                                   value="{{ $r->id }}"
                                   autocomplete="off"
                                   required
                                   {{ $r->kosong ? '' : 'disabled' }}>

                            <label for="r{{ $r->id }}" class="room-card d-block p-3 {{ $r->kosong ? '' : 'disabled' }}">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div class="fw-bold text-dark fs-6">{{ $r->nama_ruangan }}</div>
                                    @if ($r->kosong)
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 badge-status">Tersedia</span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-25 text-secondary badge-status">Terisi</span>
                                    @endif
                                </div>

                                <div class="text-muted small mb-1">
                                    Tarif: <strong class="text-dark">Rp {{ number_format($r->harga_per_jam, 0, ',', '.') }}</strong> / jam
                                </div>

                                @if ($r->kosong)
                                    <div class="text-primary fw-bold small">
                                        Total: Rp {{ number_format($r->harga_per_jam * $durasi, 0, ',', '.') }}
                                    </div>
                                @else
                                    <div class="text-muted small italic">Tidak dapat dibooking</div>
                                @endif
                            </label>
                        </div>
                    @endforeach
                </div>

                
                <div class="card border-0 shadow-sm rounded-3 p-3 p-md-4 bg-white mb-4">
                    <h6 class="fw-bold text-dark mb-3">
                        <i class="bi bi-person-vcard text-primary me-2"></i>3. Isikan Kontak Pemesan
                    </h6>
                    <div class="row g-2">
                        <div class="col-md-5">
                            <label class="form-label fs-7 text-muted fw-semibold mb-1">Nama Lengkap</label>
                            <input type="text"
                                   name="nama"
                                   class="form-control rounded-3"
                                   placeholder="Contoh: Budi Santoso"
                                   value="{{ old('nama') }}"
                                   required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fs-7 text-muted fw-semibold mb-1">No. HP / WhatsApp</label>
                            <input type="text"
                                   name="no_hp"
                                   class="form-control rounded-3"
                                   placeholder="081234567890"
                                   value="{{ old('no_hp') }}"
                                   required>
                        </div>

                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-success w-100 rounded-3 fw-bold py-2 shadow-sm">
                                <i class="bi bi-check2-circle me-1"></i> Confirm Booking
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        @endif
    @endif

    
    <div class="text-center mt-5">
        <p class="small text-muted mb-0">
            Pemilik / Pengelola Rental? 
            <a href="{{ route('login') }}" class="text-primary fw-semibold text-decoration-none">Login Admin</a>
        </p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
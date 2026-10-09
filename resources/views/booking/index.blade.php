@extends('layouts.app')

@section('title', 'Booking')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Data Booking</h3>
    <a href="{{ route('booking.create') }}" class="btn btn-primary">+ Tambah</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th><th>Pelanggan</th><th>Konsol</th><th>Tanggal</th>
            <th>Jam</th><th>Durasi</th><th>Total</th><th>Status</th><th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($bookings as $b)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $b->pelanggan->nama }}</td>
            <td>{{ $b->konsol->nama_konsol }} ({{ $b->konsol->ruangan }})</td>
            <td>{{ $b->tanggal }}</td>
            <td>{{ substr($b->jam_mulai, 0, 5) }}</td>
            <td>{{ $b->durasi }} jam</td>
            <td>Rp {{ number_format($b->total_harga, 0, ',', '.') }}</td>
            <td>
                @if ($b->status == 'dipesan')
                    <span class="badge bg-warning text-dark">Dipesan</span>
                @elseif ($b->status == 'selesai')
                    <span class="badge bg-success">Selesai</span>
                @else
                    <span class="badge bg-secondary">Batal</span>
                @endif
            </td>
            <td>
                <a href="{{ route('booking.edit', $b) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('booking.destroy', $b) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Yakin hapus?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="9" class="text-center">Belum ada data</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
@extends('layouts.app')

@section('title', 'Ruangan')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Data Ruangan</h3>
    <a href="{{ route('ruangan.create') }}" class="btn btn-primary">+ Tambah Ruangan</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Ruangan</th>
            <th>Harga per Jam</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($ruangans as $r)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $r->nama_ruangan }}</td>
            <td>Rp {{ number_format($r->harga_per_jam, 0, ',', '.') }}</td>
            <td>
                @if ($r->status == 'tersedia')
                    <span class="badge bg-success">Tersedia</span>
                @else
                    <span class="badge bg-warning text-dark">Dipakai</span>
                @endif
            </td>
            <td>
                <a href="{{ route('ruangan.edit', $r) }}" class="btn btn-warning btn-sm">
                    Edit
                </a>

                <form action="{{ route('ruangan.destroy', $r) }}"
                      method="POST"
                      class="d-inline"
                      onsubmit="return confirm('Yakin ingin menghapus ruangan ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>

        @empty
        <tr>
            <td colspan="5" class="text-center">
                Belum ada data ruangan
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
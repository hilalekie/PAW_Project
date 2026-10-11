@extends('layouts.app')

@section('title', 'Pelanggan')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Data Pelanggan</h3>
    <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">
        + Tambah Pelanggan
    </a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>No. HP</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($pelanggans as $p)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->no_hp }}</td>
            <td>{{ $p->alamat ?? '-' }}</td>
            <td>
                <a href="{{ route('pelanggan.edit', $p) }}"
                   class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('pelanggan.destroy', $p) }}"
                      method="POST" class="d-inline"
                      onsubmit="return confirm('Yakin hapus pelanggan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">Belum ada data pelanggan</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Data Users</h3>
    <a href="{{ route('users.create') }}" class="btn btn-primary">+ Tambah</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr><th>No</th><th>Nama</th><th>Email</th><th>Aksi</th></tr>
    </thead>
    <tbody>
        @forelse ($users as $u)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td>
                <a href="{{ route('users.edit', $u) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('users.destroy', $u) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Yakin hapus?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="4" class="text-center">Belum ada data</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
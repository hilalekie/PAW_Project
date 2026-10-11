@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

@section('content')
<h3>Tambah Pelanggan</h3>

<form action="{{ route('pelanggan.store') }}" method="POST">
    @csrf
    @include('pelanggan._form')
</form>
@endsection
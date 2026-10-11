@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')
<h3>Edit Pelanggan</h3>

<form action="{{ route('pelanggan.update', $pelanggan) }}" method="POST">
    @csrf
    @method('PUT')
    @include('pelanggan._form')
</form>
@endsection
@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<h3>Tambah User</h3>
<form action="{{ route('users.store') }}" method="POST">
    @csrf
    @include('users._form')
</form>
@endsection
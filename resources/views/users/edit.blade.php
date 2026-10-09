@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<h3>Edit User</h3>
<form action="{{ route('users.update', $user) }}" method="POST">
    @csrf @method('PUT')
    @include('users._form')
</form>
@endsection
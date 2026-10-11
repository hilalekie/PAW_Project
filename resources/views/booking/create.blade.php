@extends('layouts.app')

@section('title', 'Tambah Booking')

@section('content')
<h3>Tambah Booking</h3>
<form action="{{ route('booking.store') }}" method="POST">
    @csrf
    @include('booking._form')
</form>
@endsection
@extends('layouts.app')

@section('title', 'Edit Booking')

@section('content')
<h3>Edit Booking</h3>
<form action="{{ route('booking.update', $booking) }}" method="POST">
    @csrf @method('PUT')
    @include('booking._form')
</form>
@endsection
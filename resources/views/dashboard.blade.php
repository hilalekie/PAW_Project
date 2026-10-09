@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h3>Dashboard</h3>
    <p>Selamat datang, {{ auth()->user()->name }}!</p>
@endsection
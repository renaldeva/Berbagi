@extends('layouts.app')

@section('sidebar')
<ul class="list-group">
    <a href="/donator/dashboard" class="list-group-item">Dashboard</a>
    <a href="/donator/barang" class="list-group-item">Barang Donasi</a>
</ul>
@endsection

@section('content')
<div class="alert alert-success">
    Selamat datang <b>Donator</b>! Terima kasih sudah berdonasi.
</div>

<div class="card mb-3">
    <div class="card-header">Informasi Donasi</div>
    <div class="card-body">
        <p>Kamu bisa mengelola barang yang ingin didonasikan.</p>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('sidebar')
<ul class="list-group">
    <a href="/penerima/dashboard" class="list-group-item">Dashboard</a>
    <a href={{ route('penerima.requests.index') }} class="list-group-item">Permintaan Barang</a>
</ul>
@endsection

@section('content')
<div class="alert alert-warning">
    Selamat datang <b>Penerima</b>! Silakan ajukan permintaan bantuan.
</div>

<div class="card mb-3">
    <div class="card-header">Status Permintaan</div>
    <div class="card-body">
        <p>Lihat apakah permintaan kamu sudah disetujui.</p>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('sidebar')
<ul class="list-group">
    <a href="/admin/dashboard" class="list-group-item">Dashboard</a>
    <a href="{{ route('admin.items.index') }}" class="list-group-item">Kelola Barang</a>
    <a href="{{ route('admin.requests.index') }}" class="list-group-item">Kelola Permintaan</a>
</ul>
@endsection

@section('content')
<div class="alert alert-primary">
    Selamat datang <b>Admin</b>!
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card border-primary mb-3">
            <div class="card-header">Total Barang</div>
            <div class="card-body">
                <p class="card-text">Data barang yang tersedia.</p>
            </div>
        </div>
    </div>
</div>
@endsection

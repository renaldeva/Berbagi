@extends('layouts.app')

@section('sidebar')
@include('admin.sidebar')
@endsection

@section('content')
<h4>Tambah Kategori</h4>

<form action="{{ route('admin.categories.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nama Kategori</label>
        <input type="text" class="form-control" name="nama_kategori" required>
    </div>

    <button class="btn btn-success">Simpan</button>
</form>
@endsection

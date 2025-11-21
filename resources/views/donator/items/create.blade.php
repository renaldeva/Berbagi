@extends('layouts.app')
@section('title','Tambah Barang')
@section('content')
<h4>Tambah Barang</h4>
<form action="{{ route('donator.items.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3"><label>Nama</label><input name="nama_barang" class="form-control" required></div>
    <div class="mb-3"><label>Kategori</label>
        <select name="kategori" class="form-control">@foreach($categories as $c)<option value="{{ $c->nama_kategori }}">{{ $c->nama_kategori }}</option>@endforeach</select>
    </div>
    <div class="mb-3"><label>Kondisi</label><input name="kondisi" class="form-control" required></div>
    <div class="mb-3"><label>Deskripsi</label><textarea name="deskripsi" class="form-control"></textarea></div>
    <div class="mb-3"><label>Foto</label><input type="file" name="foto" class="form-control"></div>
    <button class="btn btn-primary">Simpan</button>
</form>
@endsection

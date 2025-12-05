@extends('layouts.app')

@section('sidebar')
@include('admin.sidebar')
@endsection

@section('content')
<h4>Edit Kategori</h4>

<form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nama Kategori</label>
        <input type="text" class="form-control" name="nama_kategori" 
               value="{{ $category->nama_kategori }}" required>
    </div>

    <button class="btn btn-primary">Update</button>
</form>
@endsection
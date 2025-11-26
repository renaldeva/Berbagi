@extends('layouts.app')

@section('sidebar')
@include('admin.sidebar')
@endsection

@section('content')

<h4>Kategori Barang</h4>

<a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($categories as $row)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $row->nama_kategori }}</td>
            <td>
                <a href="{{ route('admin.categories.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('admin.categories.destroy', $row->id) }}" 
                      method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus kategori?')" 
                            class="btn btn-danger btn-sm">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

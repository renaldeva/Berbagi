@extends('layouts.app')

@section('content')
<h1>Daftar Permintaan Barang</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Donatur</th>
            <th>Barang Diminta</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($requests as $req)
        <tr>
            <td>{{ $req->id }}</td>
            <td>{{ $req->donator->name ?? '-' }}</td>
            <td>{{ $req->item->name ?? '-' }}</td>
            <td>{{ $req->status }}</td>
            <td>
                <a href="{{ route('admin.requests.show', $req->id) }}" class="btn btn-info btn-sm">Detail</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@extends('layouts.app')
@section('title','Barang Saya')
@section('sidebar')
    <a href="{{ route('donator.items.create') }}" class="btn btn-primary btn-sm mb-3">Tambah Barang</a>
@endsection
@section('content')
    <h4>Barang Saya</h4>
    <div class="row">
        @foreach($items as $item)
        <div class="col-md-4 mb-3">
            <div class="card">
                @if($item->foto)
                    <img src="{{ asset($item->foto) }}" class="card-img-top" style="height:160px;object-fit:cover">
                @endif
                <div class="card-body">
                    <h5>{{ $item->nama_barang }}</h5>
                    <p>{{ Str::limit($item->deskripsi,80) }}</p>
                    <small class="badge bg-info">{{ $item->status }}</small>
                    <div class="mt-2">
                        <a href="{{ route('donator.items.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('donator.items.destroy', $item->id) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{ $items->links() }}
@endsection

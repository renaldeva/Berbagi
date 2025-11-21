@extends('layouts.app')
@section('content')
<h4>Semua Barang</h4>
<table class="table">
<thead><tr><th>#</th><th>Nama</th><th>Donatur</th><th>Status</th><th>Aksi</th></tr></thead>
<tbody>
@foreach($items as $i)
<tr>
<td>{{ $i->id }}</td>
<td>{{ $i->nama_barang }}</td>
<td>{{ $i->donatur->name ?? '-' }}</td>
<td>{{ $i->status }}</td>
<td>
<form method="POST" action="{{ route('admin.items.destroy', $i->id) }}">
    @csrf @method('DELETE')
    <button class="btn btn-sm btn-danger">Hapus</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>
{{ $items->links() }}
@endsection

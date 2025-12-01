@extends('layouts.app')

@section('sidebar')
@include('admin.sidebar')
@endsection

@section('content')
<h4 class="mb-3">Data Tip Masuk</h4>

<table class="table table-bordered table-striped align-middle">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Jumlah</th>
            <th>Pesan</th>
            <th>Bukti Transfer</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tips as $tip)
        <tr>
            <td>{{ $tip->id }}</td>
            <td>{{ $tip->user->name }}</td>
            <td><strong>Rp {{ number_format($tip->jumlah) }}</strong></td>
            <td>{{ $tip->pesan ?? '-' }}</td>

            {{-- BUkti transfer --}}
            <td>
                @if($tip->bukti_transfer)
                    <img src="{{ asset('storage/' . $tip->bukti_transfer) }}" 
                         alt="Bukti Transfer" 
                         width="70" 
                         class="rounded shadow-sm"
                         style="object-fit: cover;">
                @else
                    <span class="text-muted">Tidak ada bukti</span>
                @endif
            </td>                    

            <td>{{ $tip->created_at->format('d/m/Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- Pagination --}}
<div class="mt-3">
    {{ $tips->links() }}
</div>
@endsection

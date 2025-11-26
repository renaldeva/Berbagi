@extends('layouts.app')

@section('sidebar')
@include('admin.sidebar')
@endsection

@section('content')
<h3 class="mb-3">Manajemen Barang</h3>

<div class="card shadow-sm">
    <div class="card-body">

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Barang</th>
                    <th>Deskripsi</th>
                    <th>Kondisi</th>
                    <th>Kategori</th>
                    <th>Foto</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->deskripsi }}</td>

                    {{-- KONDISI --}}
                    <td>{{ $item->kondisi }}</td>

                    {{-- KATEGORI --}}
                    <td>{{ $item->kategori->nama ?? '-' }}</td>

                    {{-- FOTO --}}
                    <td>
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" 
                                 alt="foto" 
                                 width="70" 
                                 class="rounded shadow-sm">
                        @else
                            <span class="text-muted">Tidak ada foto</span>
                        @endif
                    </td>

                    {{-- STATUS --}}
                    <td>
                        @if($item->status == 'pending')
                            <span class="badge bg-warning">Menunggu ACC</span>
                        @elseif($item->status == 'approved')
                            <span class="badge bg-success">Disetujui</span>
                        @elseif($item->status == 'rejected')
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>

                    {{-- AKSI --}}
                    <td>
                        <form action="{{ route('admin.items.acc', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-success btn-sm">ACC</button>
                        </form>

                        <button class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#modalTolak{{ $item->id }}">
                            Tolak
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- ======================
            MODAL PENOLAKAN (DI LUAR TABLE)
        ======================= --}}
        @foreach($items as $item)
        <div class="modal fade" id="modalTolak{{ $item->id }}" tabindex="-1">
            <div class="modal-dialog">
                <form action="{{ route('admin.items.reject', $item->id) }}" method="POST" class="modal-content">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Alasan Penolakan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <textarea name="alasan" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-danger">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        @endforeach

    </div>
</div>

@endsection

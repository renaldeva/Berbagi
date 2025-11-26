@extends('layouts.app')

@section('sidebar')
@include('admin.sidebar')
@endsection

@section('content')
<h3 class="mb-3">Riwayat Barang</h3>

<div class="card shadow-sm">
    <div class="card-body">

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Barang</th>
                    <th>Status</th>
                    <th>Alasan (Jika Ditolak)</th>
                    <th>Tanggal</th>
                </tr>
            </thead>

            <tbody>
                @foreach($items as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->nama_barang }}</td>

                    <td>
                        @if($row->status == 'diterima')
                            <span class="badge bg-success">Diterima</span>
                        @else
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>

                    <td>{{ $row->alasan ?? '-' }}</td>

                    <td>{{ $row->updated_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>

@endsection

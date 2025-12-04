@extends('layouts.app')

@section('sidebar')
@include('admin.sidebar')
@endsection

@section('content')
<div class="card shadow border-0 rounded-3">
    <div class="card-header bg-gradient-primary text-white">
        <h5 class="mb-0"><i class="bi bi-list-check me-2"></i>Daftar Barang</h5>
    </div>
    <div class="card-body p-0">
        @if($items->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-inbox-fill text-primary" style="font-size: 3rem;"></i>
                <p class="text-muted mt-3">Belum ada barang yang diajukan.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-dark sticky-top">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Barang</th>
                            <th class="d-none d-md-table-cell">Deskripsi</th>
                            <th>Kondisi</th>
                            <th>Kategori</th>
                            <th class="d-none d-lg-table-cell">Foto</th>
                            <th>Status</th>
                            <th class="text-center" width="140">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr class="table-row-hover">
                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $item->nama_barang }}</td>
                            <td class="d-none d-md-table-cell" style="max-width: 250px; overflow: hidden; text-overflow: ellipsis;">
                                {{ $item->deskripsi }}
                            </td>
                            <td>
                                <span class="badge bg-info text-dark px-3 rounded-pill">
                                    <i class="bi bi-info-circle-fill me-1"></i>{{ $item->kondisi }}
                                </span>
                            </td>
                            <td>{{ $item->category->nama_kategori ?? '-' }}</td>
                            <td class="d-none d-lg-table-cell">
                                @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}"
                                         alt="Foto {{ $item->nama_barang }}"
                                         class="rounded border img-hover"
                                         style="width:70px; height:70px; object-fit:cover; cursor:pointer;"
                                         data-bs-toggle="modal"
                                         data-bs-target="#imageModal"
                                         onclick="showImage('{{ asset('storage/' . $item->foto) }}', '{{ $item->nama_barang }}')">
                                @else
                                    <div class="d-flex align-items-center justify-content-center bg-light rounded border" style="width:70px; height:70px;">
                                        <i class="bi bi-image text-muted" style="font-size: 1.5rem;"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                @switch($item->status)
                                    @case('pending')
                                        <span class="badge bg-warning text-dark rounded-pill">
                                            <i class="bi bi-clock-fill me-1"></i>Menunggu
                                        </span>
                                        @break
                                    @case('approved')
                                        <span class="badge bg-success rounded-pill">
                                            <i class="bi bi-check-circle-fill me-1"></i>Disetujui
                                        </span>
                                        @break
                                    @case('rejected')
                                        <span class="badge bg-danger rounded-pill">
                                            <i class="bi bi-x-circle-fill me-1"></i>Ditolak
                                        </span>
                                        @break
                                @endswitch
                            </td>
                            <td class="text-center">
                                <form action="{{ route('admin.items.acc', $item->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    <button class="btn btn-success btn-sm px-3 rounded-pill btn-hover"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="Setujui Barang">
                                        <i class="bi bi-check-circle-fill me-1"></i>ACC
                                    </button>
                                </form>
                                <button class="btn btn-outline-danger btn-sm px-3 rounded-pill ms-1 btn-hover"
                                        onclick="openRejectModal({{ $item->id }}, '{{ $item->nama_barang }}')"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Tolak Barang">
                                    <i class="bi bi-x-circle-fill me-1"></i>Tolak
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

{{-- Modal untuk Melihat Gambar Besar --}}
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="" class="img-fluid rounded">
            </div>
        </div>
    </div>
</div>

{{-- Modal Tolak --}}
<div class="modal fade" id="modalTolak" tabindex="-1">
    <div class="modal-dialog">
        <form id="formReject" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Alasan Penolakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="fw-semibold mb-2" id="rejectItemName"></p>
                <textarea name="alasan" class="form-control" rows="3" required></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger px-4">Kirim</button>
            </div>
        </form>
    </div>
</div>

{{-- CSS Tambahan untuk Efek Menarik --}}
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.03);
    }
    .table-row-hover:hover {
        background-color: rgba(0, 123, 255, 0.1) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    .img-hover:hover {
        transform: scale(1.1);
        transition: transform 0.3s ease;
    }
    .btn-hover:hover {
        transform: scale(1.05);
        transition: transform 0.2s ease;
    }
    .badge {
        font-size: 0.85rem;
    }
</style>

{{-- JS untuk Modal dan Tooltip --}}
<script>
function openRejectModal(id, nama) {
    const modal = new bootstrap.Modal(document.getElementById('modalTolak'));
    document.getElementById('rejectItemName').innerText = "Barang: " + nama;
    document.getElementById('formReject').action = "/admin/items/" + id + "/reject";
    modal.show();
}

function showImage(src, alt) {
    document.getElementById('modalImage').src = src;
    document.getElementById('modalImage').alt = alt;
    document.getElementById('imageModalLabel').innerText = alt;
}

// Initialize tooltips
document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>

@endsection
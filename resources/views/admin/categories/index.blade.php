@extends('layouts.app')

@section('sidebar')
@include('admin.sidebar')
@endsection

@section('content')
<div class="card shadow-lg border-0 rounded-3">
    <div class="card-header bg-gradient-primary text-white">
        <h4 class="mb-0"><i class="bi bi-tags me-2"></i>Kategori Barang</h4>
    </div>
    <div class="card-body">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-attractive mb-3">
            <i class="bi bi-plus-circle-fill me-2"></i>Tambah Kategori
        </a>

        @if($categories->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-inbox-fill text-muted" style="font-size: 3rem;"></i>
                <p class="text-muted mt-3">Belum ada kategori yang dibuat.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-dark sticky-top">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nama Kategori</th>
                            <th class="text-center" width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $row)
                        <tr class="table-row-hover">
                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $row->nama_kategori }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.categories.edit', $row->id) }}" 
                                   class="btn btn-warning btn-sm rounded-pill me-1 btn-hover-attractive"
                                   data-bs-toggle="tooltip"
                                   data-bs-placement="top"
                                   title="Edit Kategori">
                                    <i class="bi bi-pencil-square-fill me-1"></i>Edit
                                </a>
                                <button class="btn btn-danger btn-sm rounded-pill btn-hover-attractive"
                                        onclick="openDeleteModal({{ $row->id }}, '{{ $row->nama_kategori }}')"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Hapus Kategori">
                                    <i class="bi bi-trash-fill me-1"></i>Hapus
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

{{-- Modal Konfirmasi Hapus --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus kategori: <strong id="deleteCategoryName"></strong>?</p>
                <small class="text-muted">Tindakan ini tidak dapat dibatalkan.</small>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- CSS Tambahan untuk Efek Modern --}}
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
    /* Efek Menarik untuk Tombol Tambah Kategori */
    .btn-attractive {
        background: linear-gradient(135deg, #007bff, #6610f2);
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 25px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
        transition: all 0.3s ease;
        animation: pulse 2s infinite;
    }
    .btn-attractive:hover {
        background: linear-gradient(135deg, #0056b3, #5a0fc8);
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(0, 123, 255, 0.5);
        color: white;
    }
    .btn-attractive i {
        font-size: 1.2rem;
    }
    /* Efek Hover untuk Tombol Edit dan Hapus */
    .btn-hover-attractive {
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .btn-hover-attractive:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
    .btn-hover-attractive i {
        font-size: 1rem;
    }
    @keyframes pulse {
        0%, 100% {
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
        }
        50% {
            box-shadow: 0 4px 20px rgba(0, 123, 255, 0.6);
        }
    }
</style>

{{-- JS untuk Modal dan Tooltip --}}
<script>
function openDeleteModal(id, nama) {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    document.getElementById('deleteCategoryName').innerText = nama;
    document.getElementById('deleteForm').action = "/admin/categories/" + id;
    modal.show();
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
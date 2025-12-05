@extends('layouts.app')

@section('sidebar')
@include('admin.sidebar')
@endsection

@section('content')
<h4 class="mb-3">Data Tip Masuk</h4>

<div class="table-responsive">
    <table class="table table-hover align-middle shadow-sm rounded">
        <thead class="table-primary text-white">
            <tr>
                <th class="py-3 px-4">ID</th>
                <th class="py-3 px-4">User</th>
                <th class="py-3 px-4">Jumlah</th>
                <th class="py-3 px-4">Pesan</th>
                <th class="py-3 px-4">Bukti Transfer</th>
                <th class="py-3 px-4">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tips as $tip)
            <tr class="border-bottom">
                <td class="py-3 px-4 fw-bold">{{ $tip->id }}</td>
                <td class="py-3 px-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary text-white rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; font-weight: bold; font-size: 0.9rem;">
                            {{ strtoupper(substr($tip->user->name, 0, 1)) }}
                        </div>
                        {{ $tip->user->name }}
                    </div>
                </td>
                <td class="py-3 px-4">
                    <span class="badge bg-success px-3 py-2 rounded-pill">
                        Rp {{ number_format($tip->jumlah) }}
                    </span>
                </td>
                <td class="py-3 px-4">{{ $tip->pesan ?? '<span class="text-muted">Tidak ada pesan</span>' }}</td>
                <td class="py-3 px-4">
                    @if($tip->bukti_transfer)
                        <img src="{{ asset('storage/' . $tip->bukti_transfer) }}" 
                             alt="Bukti Transfer" 
                             width="60" 
                             height="60" 
                             class="rounded shadow-sm cursor-pointer" 
                             style="object-fit: cover;" 
                             data-bs-toggle="modal" 
                             data-bs-target="#imageModal" 
                             data-src="{{ asset('storage/' . $tip->bukti_transfer) }}">
                    @else
                        <span class="text-muted">Tidak ada bukti</span>
                    @endif
                </td>
                <td class="py-3 px-4">{{ $tip->created_at->format('d/m/Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-5 text-muted">
                    <i class="fas fa-inbox fa-2x mb-2"></i>
                    <p class="mb-0">Belum ada data tip masuk.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Pagination --}}
<div class="mt-3">
    {{ $tips->links() }}
</div>

<!-- Modal for Image Preview -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body text-center p-0">
                <img id="modalImage" src="" alt="Bukti Transfer" class="img-fluid rounded">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<style>
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
        transition: background-color 0.3s ease;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .cursor-pointer:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .table-responsive {
            font-size: 0.9rem;
        }
        .bg-primary {
            width: 30px !important;
            height: 30px !important;
        }
        .badge {
            font-size: 0.8rem !important;
        }
    }
</style>

<script>
    // Modal image preview
    const imageModal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    
    imageModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const src = button.getAttribute('data-src');
        modalImage.src = src;
    });
</script>
@endsection
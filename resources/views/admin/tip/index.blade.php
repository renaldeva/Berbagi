@extends('layouts.app')

@section('sidebar')
@include('admin.sidebar')
@endsection

@section('content')

<div class="card shadow-lg border-0 rounded-3">
    <div class="card-header bg-gradient-primary text-white">
        <h4 class="mb-0"><i class="bi bi-cash-stack me-2"></i>Data Tip Masuk</h4>
    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark sticky-top">
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
                    <tr class="table-row-hover border-bottom">
                        <td class="py-3 px-4 fw-bold">{{ $tip->id }}</td>

                        <td class="py-3 px-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle bg-gradient-primary text-white rounded-circle me-2 d-flex align-items-center justify-content-center">
                                    {{ strtoupper(substr($tip->user->name, 0, 1)) }}
                                </div>
                                <span class="fw-semibold">{{ $tip->user->name }}</span>
                            </div>
                        </td>

                        <td class="py-3 px-4">
                            <span class="badge bg-success px-3 py-2 rounded-pill shadow-sm">
                                Rp {{ number_format($tip->jumlah) }}
                            </span>
                        </td>

                        <td class="py-3 px-4">
                            {!! $tip->pesan ? e($tip->pesan) : '<span class="text-muted">Tidak ada pesan</span>' !!}
                        </td>

                        <td class="py-3 px-4">
                            @if($tip->bukti_transfer)
                                <img src="{{ asset('storage/' . $tip->bukti_transfer) }}"
                                     alt="Bukti Transfer"
                                     width="65"
                                     height="65"
                                     class="rounded shadow-sm cursor-pointer hover-zoom"
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
                            <i class="bi bi-inbox-fill fs-1 mb-2"></i>
                            <p class="mb-0">Belum ada data tip masuk.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $tips->links() }}
        </div>

    </div>
</div>

{{-- Modal Preview Gambar --}}
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title"><i class="bi bi-image me-2"></i>Bukti Transfer</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <img id="modalImage" src="" class="img-fluid w-100 rounded-bottom">
            </div>
        </div>
    </div>
</div>

{{-- CSS Tema Seragam --}}
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #007bff, #6610f2);
    }

    .table-row-hover:hover {
        background-color: rgba(0, 123, 255, 0.08) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .avatar-circle {
        width: 40px;
        height: 40px;
        font-weight: 600;
        font-size: 0.9rem;
        background: linear-gradient(135deg, #007bff, #6610f2);
    }

    .hover-zoom {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-zoom:hover {
        transform: scale(1.07);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.25);
    }

    @media (max-width: 768px) {
        .avatar-circle {
            width: 32px !important;
            height: 32px !important;
        }
    }
</style>

<script>
    const imageModal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');

    imageModal.addEventListener('show.bs.modal', function (event) {
        const trigger = event.relatedTarget;
        modalImage.src = trigger.getAttribute('data-src');
    });
</script>

@endsection

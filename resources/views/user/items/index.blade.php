<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang Saya</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts untuk font modern -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #e8d5ff, #f8f9fa, #d4bfff);
            font-family: 'Inter', sans-serif;
            color: #4a148c;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
        }

        .card {
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(138, 43, 226, 0.2);
            box-shadow: 0 16px 40px rgba(138, 43, 226, 0.1);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            overflow: hidden;
            position: relative;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #8a2be2, #ba55d3, #dda0dd);
        }

        .card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 24px 60px rgba(138, 43, 226, 0.2);
        }

        .card-img-top {
            border-radius: 24px 24px 0 0;
            transition: transform 0.3s ease;
        }

        .card:hover .card-img-top {
            transform: scale(1.05);
        }

        .btn-back {
            background: linear-gradient(135deg, #6a1b9a, #9c27b0);
            color: white;
            padding: 10px 24px;
            border-radius: 50px;
            box-shadow: 0 6px 20px rgba(106, 27, 154, 0.3);
            transition: all 0.3s ease;
            font-weight: 600;
            border: none;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(106, 27, 154, 0.4);
            background: linear-gradient(135deg, #7b1fa2, #ba68c8);
        }

        .btn-add {
            background: linear-gradient(135deg, #8e24aa, #ce93d8);
            color: white;
            padding: 8px 18px;
            border-radius: 16px;
            font-weight: 600;
            box-shadow: 0 4px 16px rgba(142, 36, 170, 0.3);
            transition: all 0.3s ease;
            border: none;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(142, 36, 170, 0.4);
            background: linear-gradient(135deg, #ab47bc, #e1bee7);
        }

        .btn-edit {
            background: linear-gradient(135deg, #9c27b0, #ba68c8);
            color: white;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-edit:hover {
            background: linear-gradient(135deg, #ba68c8, #ce93d8);
            transform: scale(1.05);
        }

        .btn-delete {
            background: linear-gradient(135deg, #e91e63, #f48fb1);
            color: white;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-delete:hover {
            background: linear-gradient(135deg, #f48fb1, #fce4ec);
            transform: scale(1.05);
        }

        .status-pending {
            background: rgba(255, 193, 7, 0.2);
            color: #f57f17;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            border: 1px solid rgba(255, 193, 7, 0.3);
        }

        .status-approved {
            background: rgba(76, 175, 80, 0.2);
            color: #2e7d32;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            border: 1px solid rgba(76, 175, 80, 0.3);
        }

        .status-rejected {
            background: rgba(244, 67, 54, 0.2);
            color: #c62828;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            border: 1px solid rgba(244, 67, 54, 0.3);
        }

        .text-purple {
            color: #6a1b9a !important;
        }

        .fw-bold {
            font-weight: 700;
        }

        .card-body h5 {
            color: #4a148c;
            margin-bottom: 8px;
        }

        .card-body p {
            color: #666;
            line-height: 1.5;
        }

        .pagination {
            justify-content: center;
        }

        .pagination .page-link {
            color: #8a2be2;
            border-color: #ce93d8;
            border-radius: 50%;
            margin: 0 4px;
            transition: all 0.3s ease;
        }

        .pagination .page-link:hover {
            background-color: #ce93d8;
            border-color: #ba68c8;
            color: white;
        }

        .pagination .page-item.active .page-link {
            background-color: #8a2be2;
            border-color: #8a2be2;
        }

        /* Animasi fade-in untuk card */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Responsivitas tambahan */
        @media (max-width: 768px) {
            .col-md-4 {
                margin-bottom: 20px;
            }
            .d-flex.justify-content-between {
                flex-direction: column;
                align-items: flex-start !important;
            }
            .btn-add {
                margin-top: 10px;
            }
        }
    </style>
</head>

<body>

<div class="container py-5">

    <a href="{{ route('user.dashboard') }}" class="btn btn-back mb-4">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>

    <div class="d-flex justify-content-between align-items-center mb-5">
        <h3 class="fw-bold text-purple mb-0">
            <i class="fas fa-box me-3"></i>Barang Saya
        </h3>

        <a href="{{ route('user.items.create') }}" class="btn btn-add">
            <i class="fas fa-plus me-2"></i>Tambah Barang
        </a>
    </div>

    <div class="row">
        @foreach($items as $item)
        <div class="col-lg-4 col-md-6 mb-4">

            <div class="card h-100">

                {{-- FOTO BARANG --}}
                @if($item->foto)
                    <img src="{{ asset('storage/' . $item->foto) }}"
                         class="card-img-top"
                         alt="{{ $item->nama_barang }}"
                         style="height:240px; object-fit:cover;">
                @else
                    <div class="bg-light text-muted d-flex justify-content-center align-items-center"
                         style="height:240px; border-radius: 24px 24px 0 0;">
                        <i class="fas fa-image fa-3x"></i>
                        <span class="ms-2">Tidak ada foto</span>
                    </div>
                @endif

                <div class="card-body d-flex flex-column">

                    <h5 class="fw-bold mb-2">{{ $item->nama_barang }}</h5>

                    <p class="text-muted small mb-3 flex-grow-1">{{ Str::limit($item->deskripsi, 100) }}</p>

                    {{-- STATUS --}}
                    <div class="mb-3">
                        <span class="
                            @if($item->status=='pending') status-pending
                            @elseif($item->status=='approved') status-approved
                            @else status-rejected
                            @endif
                        ">
                            <i class="fas fa-circle me-1"></i>{{ ucfirst($item->status) }}
                        </span>
                    </div>

                    <div class="mt-auto d-flex gap-2">
                        <a href="{{ route('user.items.edit', $item->id) }}" 
                           class="btn btn-edit btn-sm flex-fill">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>

                        <form action="{{ route('user.items.destroy', $item->id) }}" method="POST" class="flex-fill">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-delete btn-sm w-100"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">
                                <i class="fas fa-trash me-1"></i>Hapus
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
        @endforeach
    </div>

    @if($items->hasPages())
    <div class="mt-5 d-flex justify-content-center">
        {{ $items->links() }}
    </div>
    @endif

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
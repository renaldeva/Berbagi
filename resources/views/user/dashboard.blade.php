<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berbagi</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts untuk font modern -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #f6f4ff 0%, #e8e2ff 100%);
            font-family: 'Poppins', sans-serif;
            color: #333;
            overflow-x: hidden;
        }

        /* Navbar dengan efek glassmorphism */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 2px solid rgba(106, 13, 173, 0.2);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
            color: #6a0dad !important;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .navbar-brand i {
            color: #8a2be2;
        }
        .navbar-nav .nav-link {
            color: #6a0dad;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .navbar-nav .nav-link:hover {
            color: #8a2be2;
        }
        .badge {
            font-size: 0.75rem;
        }

        /* Search box dengan efek modern */
        .search-box {
            border-radius: 50px;
            background: rgba(240, 232, 255, 0.8);
            border: 2px solid rgba(216, 199, 255, 0.5);
            padding: 12px 20px;
            transition: all 0.3s ease;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .search-box:focus {
            background: #fff;
            border-color: #9c5aff;
            box-shadow: 0 0 15px rgba(155, 90, 255, 0.4), inset 0 1px 3px rgba(0, 0, 0, 0.1);
            transform: scale(1.02);
        }

        /* Hero section dengan animasi dan overlay */
        .hero {
            background: linear-gradient(135deg, #6a0dad 0%, #8a2be2 50%, #ba55d3 100%);
            border-radius: 20px;
            padding: 50px 40px;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(106, 13, 173, 0.3);
            animation: fadeInUp 1s ease-out;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }
        .hero h3 {
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        .hero p {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Filter card dengan efek modern */
        .filter-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 25px;
            border: 1px solid rgba(231, 219, 255, 0.5);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .filter-card:hover {
            transform: translateY(-5px);
        }
        .form-select, .form-control {
            border-radius: 10px;
            border: 2px solid #e7dbff;
            transition: all 0.3s ease;
        }
        .form-select:focus, .form-control:focus {
            border-color: #9c5aff;
            box-shadow: 0 0 10px rgba(155, 90, 255, 0.3);
        }

        /* Product cards dengan efek hover canggih */
        .product-card {
            border-radius: 20px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            border: none;
            background: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .product-card:hover {
            transform: translateY(-15px) scale(1.05);
            box-shadow: 0 20px 40px rgba(106, 13, 173, 0.2);
        }
        .product-img {
            height: 200px;
            object-fit: cover;
            width: 100%;
            transition: transform 0.4s ease;
        }
        .product-card:hover .product-img {
            transform: scale(1.1);
        }
        .card-body {
            padding: 20px;
        }
        .card-body h5 {
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }
        .kategori-text {
            background: linear-gradient(135deg, #f0e5ff, #e8d9ff);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            color: #6a0dad;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 15px;
        }

        /* Button dengan efek modern */
        .btn-purple {
            background: linear-gradient(135deg, #7a21cf, #9c5aff);
            color: white;
            border-radius: 25px;
            padding: 12px 20px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(122, 33, 207, 0.3);
        }
        .btn-purple:hover {
            background: linear-gradient(135deg, #5c0ea8, #7a21cf);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(122, 33, 207, 0.4);
        }

        /* Alert dengan styling modern */
        .alert {
            border-radius: 15px;
            border: none;
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            color: #856404;
        }

        /* Judul section */
        h4.fw-bold {
            color: #6a0dad;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
            position: relative;
        }
        h4.fw-bold::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(135deg, #6a0dad, #8a2be2);
            border-radius: 2px;
        }

        /* Responsivitas tambahan */
        @media (max-width: 768px) {
            .hero {
                padding: 30px 20px;
            }
            .hero h3 {
                font-size: 2rem;
            }
            .product-card:hover {
                transform: translateY(-10px) scale(1.02);
            }
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('user.dashboard') }}">
            <i class="fas fa-hand-holding-heart"></i> Berbagi
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navUser">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navUser">
            @auth
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item me-3">
                    <a href="{{ route('user.items.index') }}" class="nav-link fw-semibold">
                        <i class="fas fa-plus-circle me-1"></i> Tambah Barang
                    </a>
                </li>
                <li class="nav-item me-3">
                    <a href="{{ route('user.inbox.index') }}" class="nav-link fw-semibold position-relative">
                        <i class="fas fa-inbox me-1"></i> Inbox
                        @php
                            $jumlahInbox = \App\Models\Request::where('user_id', auth()->id())->count();
                        @endphp
                        @if($jumlahInbox > 0)
                        <span class="badge bg-danger position-absolute top-0 start-100 translate-middle rounded-pill">
                            {{ $jumlahInbox }}
                        </span>
                        @endif
                    </a>
                </li>
                <li class="nav-item me-3">
                    <a href="{{ route('user.tip.index') }}" class="nav-link fw-semibold">
                        <i class="fas fa-dollar-sign me-1"></i> Beri Tip
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold d-flex align-items-center" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-2"></i> {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li><a class="dropdown-item" href="{{ route('user.profil.index') }}">
                            <i class="fas fa-user me-2"></i>Profil
                        </a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            @endauth
        </div>
    </div>
</nav>

<!-- HERO -->
<div class="container mt-5">
    <div class="hero text-center">
        <h3>Temukan Barang Donasi</h3>
        <p>Cari atau filter barang sesuai kategori dan mulai berbagi kebaikan!</p>
    </div>
</div>

<!-- FILTER KATEGORI -->
<div class="container mt-5">
    <div class="filter-card">
        <form action="{{ route('user.dashboard') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="kategori" class="form-label fw-semibold text-muted">Kategori</label>
                <select class="form-select" name="kategori" id="kategori">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('kategori') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="search" class="form-label fw-semibold text-muted">Cari Barang</label>
                <input type="text" name="q" class="form-control search-box" id="search" placeholder="Cari nama barang..." value="{{ request('q') }}">
            </div>

            <div class="col-md-2">
                <button class="btn btn-purple w-100">
                    <i class="fas fa-search me-1"></i> Filter
                </button>
            </div>
        </form>
    </div>
</div>

<!-- LIST BARANG -->
<div class="container mt-5">
    <h4 class="fw-bold mb-4">Barang Donasi Terbaru</h4>

    @if($items->count() == 0)
        <div class="alert alert-warning text-center">
            <i class="fas fa-exclamation-triangle me-2"></i> Tidak ada barang ditemukan. Coba ubah filter pencarian.
        </div>
    @endif

    <div class="row">
        @foreach($items as $item)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card product-card h-100">
                <img src="{{ $item->foto ? asset('storage/' . $item->foto) : 'https://via.placeholder.com/400x250/6a0dad/ffffff?text=No+Image' }}" 
                     class="product-img" alt="{{ $item->nama_barang }}">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $item->nama_barang }}</h5>
                    <span class="kategori-text mb-3">
                        <i class="fas fa-tag me-1"></i> {{ $item->category->nama_kategori ?? 'Tidak ada kategori' }}
                    </span>
                    <p class="card-text text-muted flex-grow-1">{{ Str::limit($item->deskripsi ?? 'Deskripsi tidak tersedia.', 80) }}</p>
                    <a href="#" class="btn btn-purple mt-auto" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                        <i class="fas fa-eye me-1"></i> Lihat Detail
                    </a>                                   
                </div>
            </div>
        </div>
        <!-- MODAL DETAIL -->
        <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content rounded-4 shadow-lg">
                    <div class="modal-header" style="background: linear-gradient(135deg, #7a21cf, #9c5aff); color:white;">
                        <h5 class="modal-title fw-semibold">
                            <i class="fas fa-box-open me-2"></i> Detail Barang: {{ $item->nama_barang }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <!-- Foto -->
                        <div class="text-center mb-4">
                            <img src="{{ $item->foto ? asset('storage/' . $item->foto) : 'https://via.placeholder.com/600x350/6a0dad/ffffff?text=No+Image' }}"
                                class="img-fluid rounded shadow"
                                style="max-height: 300px; object-fit: cover;">
                        </div>
                        <!-- Info -->
                        <h5 class="fw-bold mb-3">{{ $item->nama_barang }}</h5>
                        <p class="mb-2">
                            <span class="badge bg-purple text-white px-3 py-2 rounded-pill">
                                <i class="fas fa-tag me-1"></i>
                                {{ $item->category->nama_kategori ?? 'Tidak ada kategori' }}
                            </span>
                        </p>
                        <p class="text-muted mb-3">
                            <i class="fas fa-align-left me-2"></i>
                            {{ $item->deskripsi ?? 'Deskripsi tidak tersedia.' }}
                        </p>
                        <p class="mb-2">
                            <i class="fas fa-info-circle me-2 text-purple"></i>
                            <strong>Kondisi:</strong> {{ $item->kondisi ?? 'Tidak ada informasi' }}
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- FOOTER (Opsional, untuk melengkapi tampilan modern) -->
<footer class="bg-white mt-5 py-4 border-top">
    <div class="container text-center">
        <p class="mb-0 text-muted">&copy; 2025 Berbagi. Semua hak dilindungi. Dibuat untuk berbagi kebaikan.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script untuk animasi tambahan (opsional) -->
<script>
    // Animasi fade-in untuk cards saat scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    document.querySelectorAll('.product-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
</script>

</body>
</html>
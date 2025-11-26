<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DonasiKu – Marketplace Donasi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fa;
        }

        /* Navbar */
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }

        .search-box {
            border-radius: 50px;
            background: #f0f0f0;
            padding-left: 15px;
        }

        /* Card Produk */
        .product-card {
            border-radius: 12px;
            transition: 0.25s ease-in-out;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 6px 22px rgba(0,0,0,0.12);
        }

        .product-img {
            height: 180px;
            object-fit: cover;
            width: 100%;
        }
    </style>

</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container">

        <a class="navbar-brand text-primary" href="#">
            DonasiKu
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navUser">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navUser">

            <!-- SEARCH BAR -->
            <form class="d-flex mx-auto" action="{{ route('user.items.index') }}" method="GET" style="width:45%;">
                <input type="text" class="form-control search-box" name="q" placeholder="Cari barang donasi...">
            </form>

            <!-- MENU -->
            <ul class="navbar-nav ms-auto">

                <li class="nav-item me-3">
                    <a href="{{ route('user.items.create') }}" class="nav-link fw-semibold">
                        ➕ Tambah Barang
                    </a>
                </li>

                <li class="nav-item me-3">
                    <a href="{{ route('user.requests.index') }}" class="nav-link fw-semibold position-relative">
                        📥 Inbox
                        @php
                            $jumlahInbox = \App\Models\Request::where('user_id', auth()->id())->count();
                        @endphp
                        @if($jumlahInbox > 0)
                        <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                            {{ $jumlahInbox }}
                        </span>
                        @endif
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold" data-bs-toggle="dropdown">
                        👤 {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Profil</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>

    </div>
</nav>


<!-- HERO (opsional, biar marketplace vibes) -->
<div class="container mt-4">
    <div class="p-4 bg-primary text-white rounded shadow-sm">
        <h3 class="fw-bold">Selamat datang, {{ auth()->user()->name }} 👋</h3>
        <p>Temukan barang donasi atau mulai berbagi sekarang!</p>
    </div>
</div>


<!-- DAFTAR BARANG (Marketplace Grid) -->
<div class="container mt-4">

    <h4 class="fw-bold mb-3">Barang Donasi Terbaru</h4>

    <div class="row">

        @foreach($items as $item)
        <div class="col-md-4 mb-4">
            <div class="card product-card shadow-sm">

                @if($item->gambar)
                <img src="{{ asset('storage/' . $item->gambar) }}" class="product-img">
                @else
                <img src="https://via.placeholder.com/300x180?text=No+Image" class="product-img">
                @endif

                <div class="card-body">
                    <h5 class="fw-bold">{{ $item->nama }}</h5>
                    <p class="text-muted small">{{ $item->kategori }}</p>

                    <a href="{{ route('user.items.show', $item->id) }}"
                       class="btn btn-primary w-100 mt-2">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @endforeach

    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

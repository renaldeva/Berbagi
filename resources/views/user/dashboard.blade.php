<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berbagi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #f6f4ff; font-family: 'Poppins', sans-serif; }

        .navbar { background: white; border-bottom: 3px solid #e6d9ff; }
        .navbar-brand { font-weight: 700; font-size: 1.6rem; color: #6a0dad !important; }

        .search-box {
            border-radius: 40px;
            background: #f0e8ff;
            border: 1px solid #d8c7ff;
            padding-left: 18px;
            transition: 0.3s ease;
        }
        .search-box:focus {
            background: #fff;
            border-color: #9c5aff;
            box-shadow: 0 0 8px rgba(155, 90, 255, 0.3);
        }

        .hero {
            background: linear-gradient(135deg, #6a0dad, #8a2be2);
            border-radius: 15px;
            padding: 35px;
            color: white;
            box-shadow: 0 6px 18px rgba(106, 0, 173, 0.25);
        }

        .product-card {
            border-radius: 15px;
            transition: 0.25s ease-in-out;
            overflow: hidden;
            border: 1px solid #e7dbff;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(106, 0, 173, 0.15);
        }

        .product-img {
            height: 190px;
            object-fit: cover;
            width: 100%;
        }

        .btn-purple {
            background: #7a21cf;
            color: white;
            border-radius: 10px;
            padding: 10px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-purple:hover {
            background: #5c0ea8; color: #fff;
        }

        .kategori-text {
            background: #f0e5ff;
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 12px;
            color: #6a0dad;
            display: inline-block;
        }

        .filter-card {
            background: white;
            border-radius: 12px;
            padding: 15px;
            border: 1px solid #e7dbff;
        }
    </style>

</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container">

        <a class="navbar-brand" href="{{ route('user.dashboard') }}">
            <i class="fas fa-hand-holding-heart"></i> Berbagi
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navUser">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navUser">

            @auth
            <ul class="navbar-nav ms-auto">
                <li class="nav-item me-3">
                    <a href="{{ route('user.items.index') }}" class="nav-link fw-semibold">
                        ➕ Tambah Barang
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
            @endauth

        </div>
    </div>
</nav>


<!-- HERO -->
<div class="container mt-4">
    <div class="hero">
        <h3 class="fw-bold">Temukan Barang Donasi</h3>
        <p>Cari atau filter barang sesuai kategori!</p>
    </div>
</div>


<!-- FILTER KATEGORI -->
<div class="container mt-4">
    <div class="filter-card">

        <form action="{{ route('user.dashboard') }}" method="GET" class="row g-3">

            <div class="col-md-4">
                <select class="form-select" name="kategori">
                    <option value="">Semua Kategori</option>

                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ request('kategori') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nama_kategori }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="col-md-6">
                <input type="text" name="q" class="form-control"
                       placeholder="Cari nama barang..."
                       value="{{ request('q') }}">
            </div>

            <div class="col-md-2">
                <button class="btn btn-purple w-100">Filter</button>
            </div>

        </form>

    </div>
</div>


<!-- LIST BARANG -->
<div class="container mt-4">

    <h4 class="fw-bold mb-3 text-purple">Barang Donasi Terbaru</h4>

    @if($items->count() == 0)
        <div class="alert alert-warning">
            Tidak ada barang ditemukan.
        </div>
    @endif

    <div class="row">
        @foreach($items as $item)
        <div class="col-md-4 mb-4">
            <div class="card product-card shadow-sm">

                <img src="{{ $item->foto
                    ? asset('storage/' . $item->foto)
                    : 'https://via.placeholder.com/300x180?text=No+Image' }}"
                    class="product-img">

                <div class="card-body">
                    <h5 class="fw-bold">{{ $item->nama }}</h5>

                    <span class="kategori-text">
                        {{ $item->category->nama_kategori ?? 'Tidak ada kategori' }}
                    </span>

                    <a href="#" class="btn btn-purple w-100 mt-3">
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

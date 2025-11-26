<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang Saya</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f3e7ff, #ffffff);
            font-family: 'Poppins', sans-serif;
        }

        .card {
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(160, 118, 255, 0.25);
            box-shadow: 0 12px 32px rgba(120, 60, 230, 0.15);
            transition: 0.3s;
        }
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 18px 42px rgba(90, 35, 210, 0.25);
        }

        .btn-back {
            background: linear-gradient(135deg, #8464ff, #b193ff);
            color: white;
            padding: 8px 20px;
            border-radius: 30px;
            box-shadow: 0 4px 14px rgba(120, 60, 255, 0.3);
        }

        .btn-add {
            background: linear-gradient(135deg, #9f6fff, #c3a8ff);
            color: white;
            padding: 6px 14px;
            border-radius: 12px;
            font-weight: 600;
        }

        .btn-edit {
            background: #bda2ff;
            color: white;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-delete {
            background: #ff86a4;
            color: white;
            border-radius: 10px;
            font-weight: 600;
        }

        .status-pending {
            background: rgba(255, 213, 98, 0.25);
            color: #806200;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-approved {
            background: rgba(150, 255, 180, 0.25);
            color: #0e8c40;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-rejected {
            background: rgba(255, 130, 130, 0.25);
            color: #b3001f;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
        }
    </style>
</head>

<body>

<div class="container py-4">

    <a href="{{ route('user.dashboard') }}" class="btn btn-back mb-4">
        ← Kembali
    </a>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-purple">Barang Saya</h3>

        <a href="{{ route('user.items.create') }}" class="btn btn-add">
            + Tambah Barang
        </a>
    </div>

    <div class="row">
        @foreach($items as $item)
        <div class="col-md-4 mb-4">

            <div class="card p-2">

                {{-- FOTO BARANG --}}
                @if($item->foto)
                    <img src="{{ asset('storage/' . $item->foto) }}"
                         class="card-img-top"
                         style="height:220px; object-fit:cover;">
                @else
                    <div class="bg-secondary text-white d-flex justify-content-center align-items-center"
                         style="height:220px;">
                        Tidak ada foto
                    </div>
                @endif

                <div class="card-body">

                    <h5 class="fw-bold">{{ $item->nama_barang }}</h5>

                    <p class="text-muted small">{{ Str::limit($item->deskripsi, 80) }}</p>

                    {{-- STATUS --}}
                    <span class="
                        @if($item->status=='pending') status-pending
                        @elseif($item->status=='approved') status-approved
                        @else status-rejected
                        @endif
                    ">
                        {{ ucfirst($item->status) }}
                    </span>

                    <div class="mt-3 d-flex gap-2">
                        <a href="{{ route('user.items.edit', $item->id) }}" 
                           class="btn btn-edit btn-sm w-50">Edit</a>

                        <form action="{{ route('user.items.destroy', $item->id) }}" method="POST" class="w-50">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-delete btn-sm w-100"
                                    onclick="return confirm('Hapus barang ini?')">
                                Hapus
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $items->links() }}
    </div>

</div>

</body>
</html>
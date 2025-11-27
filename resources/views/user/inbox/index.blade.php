<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox</title>

    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4efff;
        }

        .inbox-card {
            border-radius: 18px;
            transition: 0.25s;
            border: none;
        }

        .inbox-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.09);
        }

        /* Badge Baru */
        .badge-new {
            background: #7a33ff;
            border-radius: 25px;
            font-size: 13px;
            color: white;
            transition: opacity 0.5s ease;
        }

        .header-title {
            font-weight: 800;
            color: #4b0082;
        }

        .btn-back {
            background: #6c3cff;
            color: white;
            border-radius: 10px;
        }

        .btn-back:hover {
            background: #5831d3;
            color: white;
        }
    </style>
</head>

<body>

<div class="container py-4">

    <!-- 🔙 Tombol kembali ke Dashboard -->
    <a href="{{ route('user.dashboard') }}" class="btn btn-back mb-3 px-4">
        ← Kembali ke Dashboard
    </a>

    <h3 class="header-title mb-4">📩 Inbox</h3>

    @forelse($messages as $message)
        <a href="{{ route('user.inbox.show', $message->id) }}" class="text-decoration-none text-dark">

            <div class="card inbox-card mb-3 p-3 shadow-sm"
                 style="background: {{ $message->is_read ? '#f8f5ff' : '#eadeff' }}">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h5 class="fw-bold mb-1" style="color:#5528c4;">
                            Status Barang: {{ strtoupper($message->status) }}
                        </h5>

                        <p class="text-muted mb-0" style="font-size: 15px;">
                            {{ $message->status === 'approved'
                                ? 'Barang Anda telah disetujui admin.'
                                : 'Barang Anda ditolak oleh admin.' }}
                        </p>
                    </div>

                </div>

            </div>

        </a>
    @empty
        <div class="alert alert-light text-center shadow-sm p-4" style="border-radius: 15px;">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png"
                 width="75" class="mb-3 opacity-75">
            <p class="text-muted m-0">Tidak ada pesan di inbox.</p>
        </div>
    @endforelse


    <div class="mt-3">
        {{ $messages->links() }}
    </div>

</div>

</body>
</html>

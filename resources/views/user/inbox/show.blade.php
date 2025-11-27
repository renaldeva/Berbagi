<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4efff;
        }

        .btn-back {
            background: #7a33ff;
            color: white;
            border-radius: 25px;
            font-weight: 600;
            transition: 0.3s;
            padding: 8px 18px;
        }

        .btn-back:hover {
            background: #5a22c9;
            color: #fff;
            transform: translateX(-3px);
        }

        .detail-card {
            border-radius: 20px;
            background: #ffffff;
            border: none;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        .header-title {
            font-weight: 800;
            color: #4b0082;
        }

        .status-badge {
            font-size: 14px;
            padding: 7px 15px;
            border-radius: 30px;
            font-weight: 600;
            color: #fff;
        }

        .badge-approved {
            background: #4caf50;
        }

        .badge-rejected {
            background: #d32f2f;
        }

        .label-title {
            color: #5528c4;
            font-weight: 700;
        }
    </style>
</head>

<body>

<div class="container py-5">

    {{-- Tombol kembali --}}
    <a href="{{ route('user.inbox.index') }}" class="btn btn-back mb-4">
        ← Kembali ke Inbox
    </a>

    {{-- Card pesan --}}
    <div class="detail-card">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="header-title mb-0">Detail Pesan</h4>

            {{-- Badge status --}}
            <span class="status-badge 
                {{ $msg->status == 'approved' ? 'badge-approved' : 'badge-rejected' }}">
                {{ strtoupper($msg->status) }}
            </span>
        </div>

        <p class="text-muted mb-4" style="font-size: 15px;">
            {{ $msg->status === 'approved'
                ? 'Barang Anda telah disetujui admin. Selamat!'
                : 'Barang Anda ditolak oleh admin. Silakan cek kembali persyaratan barang.' }}
        </p>

        <hr>

        {{-- Detail --}}
        <p class="mb-2">
            <span class="label-title">Nama Barang:</span>
            <br>
            {{ $msg->nama_barang }}
        </p>

        <p class="mb-2">
            <span class="label-title">Tanggal:</span>
            <br>
            {{ $msg->updated_at->format('d M Y') }}
        </p>

    </div>

</div>

</body>
</html>

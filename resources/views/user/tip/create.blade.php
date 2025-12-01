<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Tip</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f7f2ff; /* background ungu muda seperti screenshot */
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            padding: 40px;
        }

        .tip-wrapper {
            width: 100%;
            max-width: 900px;
            margin: auto;
            background: #ffffff;
            border-radius: 25px;
            padding: 40px 45px;
            box-shadow: 0px 6px 20px rgba(0,0,0,0.08);
        }

        .title-box {
            background: linear-gradient(90deg, #7b2ff7, #a259ff);
            padding: 25px;
            border-radius: 20px;
            color: white;
            font-weight: 600;
            margin-bottom: 25px;
            font-size: 20px;
            box-shadow: 0px 6px 15px rgba(123, 47, 247, 0.2);
        }

        h4 {
            font-weight: 600;
            margin-bottom: 20px;
        }

        /* Tombol Kirim Tip */
        .btn-purple {
            background: #7b2ff7;
            color: white;
            padding: 12px 30px;
            border-radius: 15px;
            border: none;
            font-size: 16px;
            transition: 0.2s;
            width: 100%;
        }

        .btn-purple:hover {
            background: #6924d6;
        }

        /* Tombol Back Modern */
        .btn-back {
            background: #e8e3ff;
            color: #5a2bbf;
            padding: 8px 17px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 14px;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid #d4caff;
        }

        .btn-back:hover {
            background: #d9d2ff;
        }

        .btn-back i {
            font-size: 16px;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px;
        }
    </style>
</head>

<body>

<div class="tip-wrapper">

    <!-- Back button -->
    <a href="{{ url()->previous() }}" class="btn-back mb-3">
        <i>←</i> Kembali
    </a>

    <!-- Judul -->
    <div class="title-box">
        Kirim Tip Untuk Pengembangan Sistem
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('user.tip.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nominal -->
        <div class="mb-3">
            <label class="form-label">Jumlah Tip (Rp)</label>
            <input type="number" name="jumlah" class="form-control" placeholder="Masukkan nominal" required>
        </div>

        <!-- Pesan -->
        <div class="mb-3">
            <label class="form-label">Pesan (Opsional)</label>
            <textarea name="pesan" class="form-control" rows="3" placeholder="Tambahkan pesan..."></textarea>
        </div>

        <!-- Bukti -->
        <div class="mb-3">
            <label class="form-label">Upload Bukti Pembayaran</label>
            <input type="file" name="bukti_transfer" class="form-control">
        </div>
        <button class="btn-purple mt-2">Kirim Tip</button>

    </form>

</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tip Sistem</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f5f4ff;
        }

        /* Tombol Back */
        .btn-back {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 10px 18px;
            border-radius: 10px;
            background: white;
            color: #6b46ff;
            font-weight: 600;
            font-size: 15px;
            border: 2px solid #6b46ff;
            display: flex;
            align-items: center;
            gap: 6px;
            text-decoration: none !important;
            transition: 0.25s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .btn-back:hover {
            background: #6b46ff;
            color: white;
            transform: translateY(-2px);
        }

        /* Hero */
        .hero {
            background: linear-gradient(135deg, #7b2ff7, #9036ff, #a259ff);
            padding: 90px 20px 60px;
            text-align: center;
            color: white;
        }

        .hero h1 {
            font-size: 32px;
            font-weight: 700;
        }

        .hero p {
            font-size: 16px;
            opacity: 0.9;
        }

        /* Content */
        .content-section {
            padding: 40px 20px;
            max-width: 600px;
            margin: auto;
            text-align: center;
        }

        /* Kasih Tip Button */
        .btn-tip {
            background: linear-gradient(135deg, #4f46e5, #6d5dfc);
            padding: 12px 30px;
            font-size: 18px;
            border-radius: 12px;
            border: none;
            color: white;
            text-decoration: none !important; /* HILANGKAN GARIS BAWAH */
            font-weight: 600;
            transition: 0.2s;
            box-shadow: 0 6px 20px rgba(102, 92, 255, 0.3);
        }

        .btn-tip:hover {
            background: linear-gradient(135deg, #4338ca, #5a4fff);
            transform: translateY(-3px);
        }
    </style>
</head>

<body>

    <!-- Tombol Back -->
    <a href="/user/dashboard" class="btn-back">
        ← Kembali
    </a>

    <!-- Header -->
    <div class="hero">
        <h1>Dukung Sistem Dengan Tip</h1>
        <p>Bantu pengembangan dan perawatan sistem.</p>
    </div>

    <!-- Konten -->
    <div class="content-section">
        <p>
            Tip Anda digunakan untuk mendukung server, pengembangan fitur baru, dan memastikan sistem tetap berjalan stabil.
        </p>

        <!-- KASIH TIP (tanpa underline) -->
        <a href="{{ route('user.tip.create') }}" class="btn-tip">
            Kasih Tip
        </a>
    </div>

</body>
</html>

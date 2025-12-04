<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tip Sistem</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts untuk font modern -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f6f4ff 0%, #e8e2ff 100%);
            color: #333;
            overflow-x: hidden;
        }

        /* Container dengan animasi */
        .container-fluid {
            animation: fadeInUp 1s ease-out;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Tombol Back dengan efek modern */
        .btn-back {
            position: fixed;
            top: 20px;
            left: 20px;
            padding: 12px 20px;
            border-radius: 25px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            color: #6b46ff;
            font-weight: 600;
            font-size: 0.9rem;
            border: 2px solid #6b46ff;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none !important;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        .btn-back:hover {
            background: #6b46ff;
            color: white;
            transform: translateY(-3px) translateX(-3px);
            box-shadow: 0 6px 20px rgba(107, 70, 255, 0.3);
        }

        /* Hero section dengan efek canggih */
        .hero {
            background: linear-gradient(135deg, #7b2ff7 0%, #9036ff 50%, #a259ff 100%);
            padding: 120px 20px 80px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(123, 47, 247, 0.3);
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
        .hero h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .hero h1 i {
            color: #ffd700;
        }
        .hero p {
            font-size: 1.1rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Content section dengan card modern */
        .content-section {
            padding: 60px 20px;
            max-width: 700px;
            margin: auto;
            text-align: center;
        }
        .content-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 25px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(231, 219, 255, 0.5);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .content-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        .content-card p {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #555;
            margin-bottom: 30px;
        }

        /* Kasih Tip Button dengan efek premium */
        .btn-tip {
            background: linear-gradient(135deg, #4f46e5 0%, #6d5dfc 100%);
            padding: 15px 40px;
            font-size: 1.2rem;
            border-radius: 30px;
            border: none;
            color: white;
            text-decoration: none !important;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(102, 92, 255, 0.4);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
        }
        .btn-tip::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        .btn-tip:hover::before {
            left: 100%;
        }
        .btn-tip:hover {
            background: linear-gradient(135deg, #4338ca 0%, #5a4fff 100%);
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(102, 92, 255, 0.5);
        }

        /* Responsivitas */
        @media (max-width: 768px) {
            .hero {
                padding: 100px 20px 60px;
            }
            .hero h1 {
                font-size: 2rem;
            }
            .content-card {
                padding: 30px 20px;
            }
            .btn-tip {
                padding: 12px 30px;
                font-size: 1rem;
            }
            .btn-back {
                position: static;
                margin-bottom: 20px;
                display: inline-block;
            }
        }
    </style>
</head>

<body>
    <!-- Tombol Back -->
    <a href="/user/dashboard" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

    <!-- Header -->
    <div class="hero">
        <h1>
            <i class="fas fa-hand-holding-heart"></i> Dukung Sistem Dengan Tip
        </h1>
        <p>Bantu pengembangan dan perawatan sistem untuk kebaikan bersama.</p>
    </div>

    <!-- Konten -->
    <div class="content-section">
        <div class="content-card">
            <p>
                <i class="fas fa-info-circle me-2 text-primary"></i>
                Tip Anda akan digunakan untuk mendukung biaya server, pengembangan fitur baru, dan memastikan sistem tetap berjalan stabil serta aman untuk semua pengguna.
            </p>

            <!-- KASIH TIP (tanpa underline) -->
            <a href="{{ route('user.tip.create') }}" class="btn-tip">
                <i class="fas fa-gift"></i> Kasih Tip
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

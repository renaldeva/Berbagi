<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Tip</title>

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
            min-height: 100vh;
            padding: 40px 20px;
            color: #333;
            overflow-x: hidden;
        }

        /* Container dengan animasi */
        .tip-wrapper {
            width: 100%;
            max-width: 900px;
            margin: auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 25px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(231, 219, 255, 0.5);
            animation: fadeInUp 0.8s ease-out;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .tip-wrapper:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Tombol Back Modern */
        .btn-back {
            background: rgba(232, 227, 255, 0.8);
            color: #5a2bbf;
            padding: 10px 18px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid #d4caff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-back:hover {
            background: #d9d2ff;
            transform: translateX(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        .btn-back i {
            font-size: 1rem;
        }

        /* Title box dengan efek modern */
        .title-box {
            background: linear-gradient(135deg, #7b2ff7 0%, #a259ff 100%);
            padding: 30px;
            border-radius: 20px;
            color: white;
            font-weight: 600;
            margin-bottom: 30px;
            font-size: 1.3rem;
            box-shadow: 0 8px 20px rgba(123, 47, 247, 0.3);
            display: flex;
            align-items: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
        }
        .title-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        .title-box:hover::before {
            left: 100%;
        }
        .title-box i {
            font-size: 1.5rem;
        }

        /* Form labels dengan ikon */
        .form-label {
            font-weight: 600;
            color: #6a0dad;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .form-label i {
            color: #8a2be2;
        }

        /* Form controls styling */
        .form-control {
            border-radius: 15px;
            padding: 12px 16px;
            border: 2px solid #e7dbff;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
        }
        .form-control:focus {
            border-color: #9c5aff;
            box-shadow: 0 0 15px rgba(155, 90, 255, 0.3);
            background: #fff;
        }
        .form-control::placeholder {
            color: #aaa;
        }

        /* Textarea specific */
        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        /* File input styling */
        .form-control[type="file"] {
            padding: 10px;
        }
        .form-control[type="file"]::file-selector-button {
            background: #6a0dad;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 8px 12px;
            margin-right: 10px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .form-control[type="file"]::file-selector-button:hover {
            background: #5c0ea8;
        }

        /* Tombol Kirim Tip dengan efek modern */
        .btn-purple {
            background: linear-gradient(135deg, #7b2ff7, #9c5aff);
            color: white;
            padding: 14px 30px;
            border-radius: 25px;
            border: none;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            box-shadow: 0 6px 20px rgba(123, 47, 247, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-purple:hover {
            background: linear-gradient(135deg, #6924d6, #7b2ff7);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(123, 47, 247, 0.4);
        }

        /* Alert styling */
        .alert {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
        }

        /* Responsivitas */
        @media (max-width: 768px) {
            .tip-wrapper {
                padding: 30px 20px;
            }
            .title-box {
                padding: 20px;
                font-size: 1.1rem;
            }
            .form-control {
                padding: 10px 14px;
            }
        }
    </style>
</head>

<body>

<div class="tip-wrapper">
    <!-- Back button -->
    <a href="{{ url()->previous() }}" class="btn-back mb-4">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

    <!-- Judul -->
    <div class="title-box">
        <i class="fas fa-gift"></i> Kirim Tip Untuk Pengembangan Sistem
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    <form action="{{ route('user.tip.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nominal -->
        <div class="mb-4">
            <label for="jumlah" class="form-label">
                <i class="fas fa-money-bill-wave"></i> Jumlah Tip (Rp)
            </label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" 
                   placeholder="Masukkan nominal (contoh: 50000)" min="1000" required>
        </div>

        <!-- Pesan -->
        <div class="mb-4">
            <label for="pesan" class="form-label">
                <i class="fas fa-comment-dots"></i> Pesan (Opsional)
            </label>
            <textarea name="pesan" id="pesan" class="form-control" rows="4" 
                      placeholder="Tambahkan pesan dukungan atau saran..."></textarea>
        </div>

        <!-- Bukti -->
        <div class="mb-4">
            <label for="bukti_transfer" class="form-label">
                <i class="fas fa-upload"></i> Upload Bukti Pembayaran
            </label>
            <input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control" 
                   accept="image/*" required>
            <small class="text-muted mt-1 d-block">
                <i class="fas fa-info-circle me-1"></i> Format: JPG, PNG, atau PDF. Maksimal 5MB.
            </small>
        </div>

        <button type="submit" class="btn-purple">
            <i class="fas fa-paper-plane"></i> Kirim Tip
        </button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
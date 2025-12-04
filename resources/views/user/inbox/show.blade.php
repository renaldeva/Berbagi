<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesan</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
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

        /* Container dengan animasi */
        .container {
            animation: fadeInUp 0.8s ease-out;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Tombol kembali dengan efek modern */
        .btn-back {
            background: linear-gradient(135deg, #7a33ff, #9c5aff);
            color: white;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            padding: 10px 20px;
            border: none;
            box-shadow: 0 4px 15px rgba(122, 51, 255, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-back:hover {
            background: linear-gradient(135deg, #5a22c9, #7a33ff);
            transform: translateX(-5px);
            box-shadow: 0 6px 20px rgba(122, 51, 255, 0.4);
            color: white;
        }

        /* Detail card dengan efek modern */
        .detail-card {
            border-radius: 25px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border: none;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .detail-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(135deg, #6a0dad, #8a2be2);
        }
        .detail-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        /* Header title */
        .header-title {
            font-weight: 700;
            color: #4b0082;
            font-size: 1.8rem;
            margin-bottom: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .header-title i {
            color: #6a0dad;
        }

        /* Status badge dengan ikon */
        .status-badge {
            font-size: 0.9rem;
            padding: 8px 16px;
            border-radius: 25px;
            font-weight: 600;
            color: #fff;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .badge-approved {
            background: linear-gradient(135deg, #4caf50, #66bb6a);
        }
        .badge-rejected {
            background: linear-gradient(135deg, #d32f2f, #f44336);
        }

        /* Deskripsi pesan */
        .message-description {
            color: #666;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 30px;
            padding: 15px;
            background: rgba(240, 232, 255, 0.5);
            border-radius: 15px;
            border-left: 4px solid #6a0dad;
        }

        /* Label dan detail */
        .label-title {
            color: #5528c4;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .label-title i {
            color: #6a0dad;
        }
        .detail-value {
            color: #333;
            font-size: 1rem;
            margin-bottom: 20px;
            padding-left: 30px;
        }

        /* HR styling */
        hr {
            border: none;
            height: 2px;
            background: linear-gradient(135deg, #e7dbff, #d8c7ff);
            margin: 30px 0;
        }

        /* Responsivitas */
        @media (max-width: 768px) {
            .detail-card {
                padding: 25px;
            }
            .header-title {
                font-size: 1.5rem;
            }
            .message-description {
                padding: 10px;
            }
            .detail-value {
                padding-left: 20px;
            }
        }
    </style>
</head>

<body>

<div class="container py-5">
    {{-- Tombol kembali --}}
    <a href="{{ route('user.inbox.index') }}" class="btn btn-back mb-4">
        <i class="fas fa-arrow-left"></i> Kembali ke Inbox
    </a>

    {{-- Card pesan --}}
    <div class="detail-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="header-title">
                <i class="fas fa-envelope-open-text"></i> Detail Pesan
            </h4>

            {{-- Badge status --}}
            <span class="status-badge 
                {{ $msg->status == 'approved' ? 'badge-approved' : 'badge-rejected' }}">
                <i class="fas fa-{{ $msg->status == 'approved' ? 'check-circle' : 'times-circle' }}"></i>
                {{ strtoupper($msg->status) }}
            </span>
        </div>

        <div class="message-description">
            <i class="fas fa-info-circle me-2"></i>
            {{ $msg->status === 'approved'
                ? 'Selamat! Barang Anda telah disetujui oleh admin dan siap untuk didonasikan. Terima kasih atas kontribusi Anda.'
                : 'Maaf, barang Anda ditolak oleh admin. Silakan periksa kembali persyaratan donasi dan coba lagi.' }}
        </div>

        <hr>

        {{-- Detail --}}
        <div class="detail-info">
            <div class="mb-3">
                <div class="label-title">
                    <i class="fas fa-tag"></i> Nama Barang
                </div>
                <div class="detail-value">
                    {{ $msg->nama_barang }}
                </div>
            </div>

            <div class="mb-3">
                <div class="label-title">
                    <i class="fas fa-calendar-alt"></i> Tanggal Update
                </div>
                <div class="detail-value">
                    {{ $msg->updated_at->format('d M Y, H:i') }} WIB
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

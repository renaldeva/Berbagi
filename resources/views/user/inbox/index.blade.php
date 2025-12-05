<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox</title>

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
            background: linear-gradient(135deg, #6c3cff, #8a2be2);
            color: white;
            border-radius: 25px;
            padding: 10px 20px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(108, 60, 255, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-back:hover {
            background: linear-gradient(135deg, #5831d3, #6a0dad);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(108, 60, 255, 0.4);
            color: white;
        }

        /* Judul header */
        .header-title {
            font-weight: 700;
            color: #4b0082;
            font-size: 2rem;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .header-title i {
            color: #6a0dad;
        }

        /* Inbox card dengan efek modern */
        .inbox-card {
            border-radius: 20px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
        }
        .inbox-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }
        .inbox-card.unread {
            background: linear-gradient(135deg, #eadeff 0%, #f0e5ff 100%);
            border-left: 5px solid #7a33ff;
        }
        .inbox-card.read {
            background: rgba(248, 245, 255, 0.9);
        }

        /* Badge untuk unread */
        .badge-new {
            background: linear-gradient(135deg, #7a33ff, #9c5aff);
            border-radius: 20px;
            font-size: 0.8rem;
            color: white;
            padding: 4px 10px;
            font-weight: 600;
            position: absolute;
            top: 15px;
            right: 15px;
            box-shadow: 0 2px 8px rgba(122, 51, 255, 0.3);
        }

        /* Konten card */
        .card-content h5 {
            font-weight: 600;
            color: #5528c4;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .card-content p {
            color: #666;
            font-size: 0.95rem;
            margin: 0;
        }

        /* Status approved/rejected dengan ikon */
        .status-approved {
            color: #28a745;
        }
        .status-rejected {
            color: #dc3545;
        }

        /* Empty state dengan styling modern */
        .alert {
            border-radius: 20px;
            border: none;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
        }
        .alert img {
            opacity: 0.7;
            margin-bottom: 20px;
        }
        .alert p {
            color: #666;
            font-size: 1.1rem;
            margin: 0;
        }

        /* Pagination styling */
        .pagination {
            justify-content: center;
            margin-top: 30px;
        }
        .page-link {
            color: #6a0dad;
            border-color: #e7dbff;
            border-radius: 10px !important;
            margin: 0 2px;
            transition: all 0.3s ease;
        }
        .page-link:hover {
            color: #fff;
            background: #6a0dad;
            border-color: #6a0dad;
        }
        .page-item.active .page-link {
            background: #6a0dad;
            border-color: #6a0dad;
        }

        /* Responsivitas */
        @media (max-width: 768px) {
            .header-title {
                font-size: 1.5rem;
            }
            .inbox-card {
                margin-bottom: 15px;
            }
            .alert {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<div class="container py-4">
    <!-- 🔙 Tombol kembali ke Dashboard -->
    <a href="{{ route('user.dashboard') }}" class="btn btn-back mb-4">
        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
    </a>

    <h3 class="header-title">
        <i class="fas fa-inbox"></i> Inbox
    </h3>

    @forelse($messages as $message)
        <a href="{{ route('user.inbox.show', $message->id) }}" class="text-decoration-none">
            <div class="card inbox-card mb-3 p-4 shadow-sm {{ $message->is_read ? 'read' : 'unread' }}">
                @if(!$message->is_read)
                    <span class="badge-new">Baru</span>
                @endif

                <div class="card-content">
                    <h5 class="{{ $message->status === 'approved' ? 'status-approved' : 'status-rejected' }}">
                        <i class="fas fa-{{ $message->status === 'approved' ? 'check-circle' : 'times-circle' }}"></i>
                        Status Barang: {{ strtoupper($message->status) }}
                    </h5>

                    <p>
                        {{ $message->status === 'approved'
                            ? 'Barang Anda telah disetujui oleh admin dan siap untuk didonasikan.'
                            : 'Barang Anda ditolak oleh admin. Silakan periksa kembali detail barang.' }}
                    </p>
                </div>
            </div>
        </a>
    @empty
        <div class="alert alert-light">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" width="80" alt="Empty inbox">
            <p>Tidak ada pesan di inbox Anda saat ini.</p>
        </div>
    @endforelse

    <div class="mt-4">
        {{ $messages->links() }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script untuk animasi scroll -->
<script>
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    document.querySelectorAll('.inbox-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
</script>

</body>
</html>
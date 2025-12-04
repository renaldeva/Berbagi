<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts untuk font modern -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #e8d5ff, #f8f9fa, #d4bfff);
            font-family: 'Inter', sans-serif;
            color: #4a148c;
            min-height: 100vh;
        }

        .container {
            max-width: 800px;
        }

        .card {
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(138, 43, 226, 0.2);
            box-shadow: 0 16px 40px rgba(138, 43, 226, 0.1);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            overflow: hidden;
            position: relative;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #8a2be2, #ba55d3, #dda0dd);
        }

        .btn-back {
            background: linear-gradient(135deg, #6a1b9a, #9c27b0);
            color: white;
            padding: 10px 24px;
            border-radius: 50px;
            box-shadow: 0 6px 20px rgba(106, 27, 154, 0.3);
            transition: all 0.3s ease;
            font-weight: 600;
            border: none;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(106, 27, 154, 0.4);
            background: linear-gradient(135deg, #7b1fa2, #ba68c8);
        }

        .btn-update {
            background: linear-gradient(135deg, #8e24aa, #ce93d8);
            color: white;
            padding: 12px 32px;
            border-radius: 16px;
            font-weight: 600;
            box-shadow: 0 6px 20px rgba(142, 36, 170, 0.3);
            transition: all 0.3s ease;
            border: none;
            font-size: 16px;
        }

        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(142, 36, 170, 0.4);
            background: linear-gradient(135deg, #ab47bc, #e1bee7);
        }

        .form-label {
            color: #6a1b9a;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control {
            border: 2px solid rgba(138, 43, 226, 0.2);
            border-radius: 12px;
            padding: 12px 16px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
        }

        .form-control:focus {
            border-color: #8a2be2;
            box-shadow: 0 0 0 0.2rem rgba(138, 43, 226, 0.25);
            background: white;
        }

        .form-control::placeholder {
            color: #9c27b0;
            opacity: 0.7;
        }

        .text-purple {
            color: #6a1b9a !important;
        }

        .fw-bold {
            font-weight: 700;
        }

        .photo-preview {
            border-radius: 12px;
            border: 2px solid rgba(138, 43, 226, 0.2);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .photo-preview:hover {
            border-color: #8a2be2;
            box-shadow: 0 4px 12px rgba(138, 43, 226, 0.2);
        }

        .text-muted {
            color: #666 !important;
        }

        /* Animasi fade-in untuk card */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Responsivitas */
        @media (max-width: 768px) {
            .container {
                padding: 0 15px;
            }
            .btn-update {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="container py-5">

    <a href="{{ route('user.items.index') }}" class="btn btn-back mb-4">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>

    <div class="card p-4">
        <div class="card-body">
            <h3 class="fw-bold text-purple mb-4">
                <i class="fas fa-edit me-3"></i>Edit Barang
            </h3>

            <form action="{{ route('user.items.update', $item->id) }}" 
                  method="POST" 
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="nama_barang" class="form-label">
                        <i class="fas fa-tag me-2"></i>Nama Barang
                    </label>
                    <input type="text" 
                           name="nama_barang" 
                           id="nama_barang"
                           class="form-control" 
                           value="{{ $item->nama_barang }}" 
                           required
                           placeholder="Masukkan nama barang">
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="form-label">
                        <i class="fas fa-align-left me-2"></i>Deskripsi
                    </label>
                    <textarea name="deskripsi" 
                              id="deskripsi"
                              class="form-control" 
                              rows="4" 
                              required
                              placeholder="Masukkan deskripsi barang">{{ $item->deskripsi }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="foto" class="form-label">
                        <i class="fas fa-camera me-2"></i>Foto Barang
                    </label>

                    <div class="mb-3">
                        @if($item->foto)
                            <div class="photo-preview d-inline-block">
                                <img src="{{ asset('storage/' . $item->foto) }}" 
                                     alt="Foto Barang"
                                     style="height:120px; width:120px; object-fit:cover;">
                            </div>
                        @else
                            <div class="photo-preview d-inline-block bg-light d-flex align-items-center justify-content-center" style="height:120px; width:120px;">
                                <i class="fas fa-image fa-2x text-muted"></i>
                            </div>
                        @endif
                    </div>

                    <input type="file" 
                           name="foto" 
                           id="foto"
                           class="form-control"
                           accept="image/*">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>Kosongkan jika tidak ingin mengubah foto. Format: JPG, PNG, maksimal 2MB.
                    </small>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-update">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

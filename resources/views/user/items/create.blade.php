<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    
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
            color: #333;
            overflow-x: hidden;
        }

        /* Card dengan efek modern */
        .card {
            border-radius: 20px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        /* Header card dengan gradient */
        .card-header {
            background: linear-gradient(135deg, #6a0dad 0%, #8a2be2 100%);
            color: white;
            padding: 25px;
            border-bottom: none;
        }
        .card-header h4 {
            font-weight: 700;
            font-size: 1.8rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .card-header i {
            font-size: 1.5rem;
        }

        /* Card body */
        .card-body {
            padding: 30px;
        }

        /* Form elements styling */
        .form-label {
            font-weight: 600;
            color: #6a0dad;
            margin-bottom: 8px;
        }
        .form-control, .form-select {
            border-radius: 12px;
            border: 2px solid #e7dbff;
            padding: 12px 16px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
        }
        .form-control:focus, .form-select:focus {
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

        /* Alert styling */
        .alert {
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            color: #856404;
            padding: 12px 16px;
            margin-bottom: 20px;
        }
        .alert i {
            margin-right: 8px;
        }

        /* Button styling */
        .btn-primary {
            background: linear-gradient(135deg, #7a21cf, #9c5aff);
            border: none;
            border-radius: 25px;
            padding: 14px 20px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(122, 33, 207, 0.3);
            color: white;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #5c0ea8, #7a21cf);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(122, 33, 207, 0.4);
            color: white;
        }

        /* File input styling */
        .form-control[type="file"] {
            padding: 10px;
        }
        .form-control[type="file"]::file-selector-button {
            background: #6a0dad;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px 12px;
            margin-right: 10px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .form-control[type="file"]::file-selector-button:hover {
            background: #5c0ea8;
        }

        /* Animasi fade-in */
        .container {
            animation: fadeInUp 0.8s ease-out;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsivitas */
        @media (max-width: 768px) {
            .card-body {
                padding: 20px;
            }
            .card-header h4 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-plus-circle"></i>
                    <h4 class="mb-0">Tambah Barang</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.items.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="nama_barang" class="form-label">
                                <i class="fas fa-tag me-2"></i>Nama Barang
                            </label>
                            <input type="text" name="nama_barang" id="nama_barang" class="form-control" 
                                   value="{{ old('nama_barang') }}" placeholder="Masukkan nama barang..." required>
                        </div>

                        <div class="mb-4">
                            <label for="category_id" class="form-label">
                                <i class="fas fa-list me-2"></i>Kategori
                            </label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>                        

                        <div class="mb-4">
                            <label for="kondisi" class="form-label">
                                <i class="fas fa-check-circle me-2"></i>Kondisi
                            </label>
                            <input type="text" name="kondisi" id="kondisi" class="form-control" 
                                   value="{{ old('kondisi') }}" placeholder="Contoh: Baru, Bekas, dll." required>
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="form-label">
                                <i class="fas fa-align-left me-2"></i>Deskripsi
                            </label>
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i>
                                <strong>Penting:</strong> Jangan lupa memberikan Nama dan No Telepon Anda untuk memudahkan komunikasi.
                            </div>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" 
                                      placeholder="Jelaskan detail barang, kondisi, dan informasi kontak...">{{ old('deskripsi') }}</textarea>
                        </div>                        

                        <div class="mb-4">
                            <label for="foto" class="form-label">
                                <i class="fas fa-camera me-2"></i>Foto Barang
                            </label>
                            <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                            <small class="text-muted">Pilih gambar dengan format JPG, PNG, atau GIF. Maksimal 5MB.</small>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Barang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

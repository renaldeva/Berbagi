<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Tambah Barang</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('user.items.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input name="nama_barang" class="form-control" value="{{ old('nama_barang') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="category_id" class="form-control" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>                        

                        <div class="mb-3">
                            <label class="form-label">Kondisi</label>
                            <input name="kondisi" class="form-control" value="{{ old('kondisi') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <p class="text-danger">Jangan lupa memberikan Nama dan No Telefon</p>
                            <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi') }}</textarea>
                        </div>                        

                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" name="foto" class="form-control">
                        </div>

                        <!-- 🔥 Perbaikan: Simpan -> Kirim -->
                        <button class="btn btn-primary w-100">Kirim</button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>

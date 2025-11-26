<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
          rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4 mb-5">

    <h4>Edit Barang</h4>

    <a href="{{ route('user.items.index') }}" class="btn btn-secondary btn-sm mb-3">
        Kembali
    </a>

    <form action="{{ route('user.items.update', $item->id) }}" 
          method="POST" 
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Barang</label>
            <input name="nama_barang" class="form-control" 
                   value="{{ $item->nama_barang }}" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4" required>{{ $item->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label>Foto Barang</label>

            <div class="mb-2">
                @if($item->foto)
                    <img src="{{ asset($item->foto) }}" 
                         style="height:100px;object-fit:cover;border-radius:6px;">
                @endif
            </div>

            <input type="file" name="foto" class="form-control">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>

</div>

</body>
</html>

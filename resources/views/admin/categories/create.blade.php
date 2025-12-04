@extends('layouts.app')

@section('sidebar')
@include('admin.sidebar')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 rounded-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <div class="card-header bg-transparent border-0 text-center py-4">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Kategori
                    </h4>
                    <p class="text-white-50 mt-2">Buat kategori baru untuk mengorganisir konten Anda</p>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('admin.categories.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <div class="mb-4">
                            <label for="nama_kategori" class="form-label fw-bold">
                                <i class="fas fa-tag me-2"></i>Nama Kategori
                            </label>
                            <input type="text" class="form-control form-control-lg" id="nama_kategori" name="nama_kategori" placeholder="Masukkan nama kategori..." required style="border-radius: 10px; border: 2px solid #ddd; transition: all 0.3s ease;">
                            <div class="invalid-feedback">
                                Nama kategori wajib diisi.
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg fw-bold" style="border-radius: 10px; background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border: none; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);">
                                <i class="fas fa-save me-2"></i>Simpan Kategori
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .btn:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }
</style>

<script>
    // Bootstrap validation script
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endsection
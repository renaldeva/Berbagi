@extends('layouts.app')

@section('content')

<style>
    body {
        background: #f5e8ff !important;
    }

    .card-purple {
        background: linear-gradient(135deg, #7a1cc6, #9b29e8);
        border: none;
        color: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .card-purple .card-header {
        background: transparent;
        border-bottom: 1px solid rgba(255,255,255,0.3);
        font-size: 22px;
        font-weight: bold;
        color: #fff;
        text-align: center;
        padding: 20px;
    }

    .card-purple .form-label {
        font-weight: bold;
        color: #fff;
    }

    .card-purple .form-control {
        background: rgba(255, 255, 255, 0.85);
        border: none;
        border-radius: 10px;
    }

    .btn-ungu {
        background: #6a0dad;
        border: none;
        color: #fff;
        padding: 10px 20px;
        border-radius: 10px;
        transition: 0.2s;
        font-weight: bold;
    }

    .btn-ungu:hover {
        background: #5800b3;
        color: #fff;
    }

    .btn-kembali {
        background: #ffffff;
        color: #6a0dad;
        border-radius: 10px;
        padding: 8px 15px;
        font-weight: bold;
        border: 2px solid #6a0dad;
    }

    .btn-kembali:hover {
        background: #6a0dad;
        color: #fff;
    }

</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <a href="{{ route('user.profil.index') }}" class="btn btn-kembali mb-3">
                ← Kembali
            </a>

            <div class="card card-purple">
                <div class="card-header">Ganti Password</div>

                <div class="card-body">

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('user.profil.password.update') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Password Lama</label>
                            <input type="password" name="current_password"
                                   class="form-control @error('current_password') is-invalid @enderror" required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="new_password"
                                   class="form-control @error('new_password') is-invalid @enderror" required>
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-ungu">Ubah Password</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

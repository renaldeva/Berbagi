@extends('layouts.app')

@section('content')
<style>
    /* ==== Purple Modern Theme ==== */
    .purple-header {
        background: linear-gradient(135deg, #6a0dad 0%, #8a2be2 50%, #ba55d3 100%);
        padding: 30px;
        border-radius: 20px 20px 0 0;
        color: white;
        text-align: center;
        backdrop-filter: blur(8px);
    }

    .profile-card {
        border-radius: 20px;
        overflow: hidden;
        border: none;
        box-shadow: 0 8px 25px rgba(111, 66, 193, 0.15);
    }

    .input-purple:focus {
        border-color: #6f42c1 !important;
        box-shadow: 0 0 8px rgba(111, 66, 193, 0.3) !important;
        background: linear-gradient(135deg, #8e24aa, #6a1b9a, #9c27b0);
        color: white !important;
    }

    .btn-purple {
        background: linear-gradient(135deg, #8e24aa, #6a1b9a, #9c27b0);
        border: none;
        transition: 0.2s;
        backdrop-filter: blur(8px);
    }

    .btn-purple:hover {
        background: #5b34a2;
    }

    .mini-box {
        background: #f5edff;
        border-left: 4px solid #6f42c1;
        border-radius: 12px;
    }

    /* ==== Button Kembali ==== */
    .btn-back-purple {
        display: inline-block;
        background: rgba(255, 255, 255, 0.25);
        border: 2px solid #8e24aa;
        color: #8e24aa;
        font-weight: 600;
        padding: 8px 18px;
        border-radius: 12px;
        backdrop-filter: blur(6px);
        transition: 0.3s ease;
    }

    .btn-back-purple:hover {
        background: #8e24aa;
        color: white !important;
        border-color: #8e24aa;
        transform: translateX(-4px);
        box-shadow: 0 6px 18px rgba(142, 36, 170, 0.35);
    }

    .btn-back-purple i {
        margin-right: 6px;
    }
</style>

<div class="container mt-4">

    <!-- BUTTON KEMBALI -->
    <div class="mb-3">
        <a href="{{ route('user.profil.index') }}" class="btn-back-purple">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- CARD WRAPPER -->
    <div class="card profile-card">

        <!-- HEADER GRADIENT -->
        <div class="purple-header">
            <h3 class="fw-bold mb-0">Edit Profil</h3>
            <p class="mb-0">Perbarui informasi akun Anda dengan tampilan yang lebih modern.</p>
        </div>

        <div class="p-4">

            <form action="{{ route('user.profil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-8">

                        <!-- Nama -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input 
                                type="text"
                                name="name"
                                class="form-control form-control-lg rounded-3 input-purple"
                                value="{{ old('name', $user->name) }}"
                                required
                            >
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input 
                                type="email"
                                name="email"
                                class="form-control form-control-lg rounded-3 input-purple"
                                value="{{ old('email', $user->email) }}"
                                required
                            >
                        </div>

                        <!-- Foto -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Foto Profil</label>

                            <div class="d-flex align-items-center mb-3">

                                <img 
                                    src="{{ $user->photo ? asset('uploads/profile/'.$user->photo) : 'https://ui-avatars.com/api/?background=6f42c1&color=fff&name='.$user->name }}" 
                                    width="90"
                                    height="90"
                                    class="rounded-circle shadow-sm me-3"
                                    style="object-fit: cover;"
                                >

                                <input type="file" name="photo" class="form-control input-purple">
                            </div>
                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="mini-box p-3 mb-3 shadow-sm">
                            <h6 class="fw-bold text-purple">Tips:</h6>
                            <p class="text-muted mb-0" style="font-size: 14px;">
                                Gunakan foto terbaik Anda dan pastikan informasi yang Anda masukkan akurat.
                            </p>
                        </div>

                        <div class="mini-box p-3 shadow-sm">
                            <i class="fa fa-user-edit fa-2x text-purple"></i>
                            <p class="text-muted mb-0 mt-2" style="font-size: 14px;">
                                Perubahan profil akan langsung diterapkan setelah disimpan.
                            </p>
                        </div>

                    </div>
                </div>

                <!-- Button -->
                <button class="btn btn-purple w-100 mt-4 py-3 rounded-3 text-white fw-bold">
                    <i class="fa fa-save"></i> Simpan Perubahan
                </button>

            </form>

        </div>
    </div>
</div>
@endsection

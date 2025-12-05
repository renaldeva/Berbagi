@extends('layouts.app')

@section('content')
<div class="profile-bg">

    {{-- Tombol kembali --}}
    <a href="{{ route('user.dashboard') }}" class="btn-back shadow-sm">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>

    <div class="profile-card glass-card shadow-lg">

        <div class="text-center mb-4">
            <h2 class="profile-title">Profil Saya</h2>
            <div class="divider-purple"></div>
        </div>

        {{-- Foto & Info User --}}
        <div class="d-flex flex-column align-items-center">
            <div class="profile-photo-wrapper">
                <img 
                    src="{{ $user->photo ? asset('uploads/profile/'.$user->photo) : 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}" 
                    class="profile-photo"
                >
                <span class="status-badge">
                    <i class="fas fa-check"></i>
                </span>
            </div>

            <h4 class="mt-3 mb-1 username-text">{{ $user->name }}</h4>
            <p class="email-text">{{ $user->email }}</p>
        </div>

        {{-- Tombol --}}
        <div class="d-grid gap-3 mt-4">
            <a href="{{ route('user.profil.edit') }}" class="btn-purple btn-big shadow-sm">
                <i class="fas fa-edit me-2"></i> Edit Profil
            </a>
            <a href="{{ route('user.profil.password') }}" class="btn-outline-purple btn-big shadow-sm">
                <i class="fas fa-key me-2"></i> Ganti Password
            </a>
        </div>

    </div>
</div>


{{-- ==================== CSS ==================== --}}
<style>
    /* Background Sweet Purple Gradient */
    .profile-bg {
        min-height: 100vh;
        padding: 40px 20px;
        background: rgba(255,255,255,0.15);
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /* Hilangkan underline di semua tombol */
    .btn-back,
    .btn-purple,
    .btn-outline-purple {
        text-decoration: none !important;
    }
    .btn-back:hover,
    .btn-purple:hover,
    .btn-outline-purple:hover {
        text-decoration: none !important;
    }

    .btn-back {

        position: absolute;
        top: 100px;     
        left: 20px;    
        background: linear-gradient(135deg, #8e24aa, #6a1b9a, #9c27b0);
        backdrop-filter: blur(8px);
        padding: 10px 20px;
        border-radius: 12px;
        color: white;
        border: 1px solid rgba(255,255,255,0.3);
        transition: 0.3s ease;
        margin-bottom: 25px;
    }
    .btn-back:hover {
        background: linear-gradient(135deg, #8e24aa, #6a1b9a, #9c27b0);
        transform: translateY(-3px);
    }

    /* Glassmorphism Card */
    .glass-card {
        width: 100%;
        max-width: 520px;
        padding: 40px;
        border-radius: 25px;
        background: linear-gradient(135deg, #8e24aa, #6a1b9a, #9c27b0);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255,255,255,0.2);
        color: white;
        animation: fadeUp 0.6s ease-out;
    }

    .profile-title {
        font-weight: 800;
        color: #f3e5f5;
        letter-spacing: 1px;
        font-size: 28px;
    }
    .divider-purple {
        width: 80px;
        height: 4px;
        background: #ce93d8;
        border-radius: 10px;
        margin: 10px auto 0;
    }

    /* Profile Photo */
    .profile-photo-wrapper {
        position: relative;
    }
    .profile-photo {
        width: 135px;
        height: 135px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #ce93d8;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }
    .status-badge {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 35px;
        height: 35px;
        background: #43a047;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 16px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.3);
    }

    .username-text {
        font-size: 22px;
        font-weight: 700;
        color: #f3e5f5;
    }
    .email-text {
        color: #e1bee7;
        font-size: 15px;
    }

    /* Buttons */
    .btn-big {
        padding: 14px;
        font-size: 17px;
        border-radius: 12px;
        transition: all .25s ease;
    }

    .btn-purple {
        background: linear-gradient(135deg, #8e24aa, #ba68c8);
        border: none;
        color: white;
    }
    .btn-purple:hover {
        transform: scale(1.05);
        background: linear-gradient(135deg, #9c27b0, #ce93d8);
    }

    .btn-outline-purple {
        border: 2px solid #ce93d8;
        background: transparent;
        color: #f3e5f5;
    }
    .btn-outline-purple:hover {
        background: rgba(206,147,216,0.2);
        transform: scale(1.05);
    }

    /* Animation */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

@endsection

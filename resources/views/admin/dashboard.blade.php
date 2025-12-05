@extends('layouts.app')

@section('sidebar')
@include('admin.sidebar')
@endsection
@section('content')

{{-- Welcome Banner --}}
<div class="welcome-banner">
    <div class="banner-content">
        <div class="banner-text">
            <h2>Selamat Datang Kembali! 👋</h2>
            <p>Kelola sistem Anda dengan mudah dan efisien</p>
        </div>
        <div class="banner-decoration">
            <div class="float-circle circle-1"></div>
            <div class="float-circle circle-2"></div>
            <div class="float-circle circle-3"></div>
        </div>
    </div>
</div>

{{-- Stats Cards --}}
<div class="row stats-container mt-4">
    
    {{-- Card Total Barang --}}
    <div class="col-md-4 mb-4">
        <div class="stat-card card-gradient-1">
            <div class="stat-icon">
                <i class="fas fa-box-open"></i>
            </div>
            <div class="stat-content">
                <span class="stat-label">Total Barang</span>
                <h3 class="stat-value">{{ $totalBarang }}</h3>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>Stok tersedia</span>
                </div>
            </div>
            <div class="stat-bg-icon">
                <i class="fas fa-box-open"></i>
            </div>
        </div>
    </div>

    {{-- Card Total Category --}}
    <div class="col-md-4 mb-4">
        <div class="stat-card card-gradient-2">
            <div class="stat-icon">
                <i class="fas fa-tags"></i>
            </div>
            <div class="stat-content">
                <span class="stat-label">Total Category</span>
                <h3 class="stat-value">{{ $totalCategory }}</h3>
                <div class="stat-trend">
                    <i class="fas fa-layer-group"></i>
                    <span>Kategori aktif</span>
                </div>
            </div>
            <div class="stat-bg-icon">
                <i class="fas fa-tags"></i>
            </div>
        </div>
    </div>

    {{-- Card Total Tip --}}
    <div class="col-md-4 mb-4">
        <div class="stat-card card-gradient-3">
            <div class="stat-icon">
                <i class="fas fa-wallet"></i>
            </div>
            <div class="stat-content">
                <span class="stat-label">Total Tip</span>
                <h3 class="stat-value">{{ $totalTip }}</h3>
                <div class="stat-trend">
                    <i class="fas fa-chart-line"></i>
                    <span>Total pendapatan</span>
                </div>
            </div>
            <div class="stat-bg-icon">
                <i class="fas fa-wallet"></i>
            </div>
        </div>
    </div>

</div>

<style>
/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
/*  GLOBAL STYLES                                                        */
/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */

* {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
}

body {
    background: #f5f7fa;
}

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
/*  ULTRA MODERN SIDEBAR                                                 */
/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */

.sidebar-ultra-modern {
    background: linear-gradient(180deg, #1a1f36 0%, #0f1419 100%);
    border-radius: 20px;
    padding: 0;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    overflow: hidden;
    position: relative;
}

.sidebar-ultra-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 200px;
    background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, transparent 100%);
    pointer-events: none;
}

.sidebar-header {
    padding: 30px 20px;
    background: linear-gradient(135deg, rgba(99, 102, 241, 0.15) 0%, rgba(139, 92, 246, 0.1) 100%);
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.logo-area {
    display: flex;
    align-items: center;
    gap: 12px;
    color: #ffffff;
    font-size: 20px;
    font-weight: 700;
    letter-spacing: -0.5px;
}

.logo-area i {
    font-size: 24px;
    color: #fbbf24;
    filter: drop-shadow(0 0 10px rgba(251, 191, 36, 0.5));
}

.logout-item {
    background: rgba(239, 68, 68, 0.08) !important;
}

.logout-item:hover {
    background: rgba(239, 68, 68, 0.15) !important;
    color: #fca5a5 !important;
}

.logout-item .item-indicator {
    background: linear-gradient(180deg, #ef4444 0%, #dc2626 100%) !important;
}

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
/*  WELCOME BANNER                                                       */
/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */

.welcome-banner {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 24px;
    padding: 40px;
    margin-top: 10px;
    box-shadow: 0 20px 60px rgba(102, 126, 234, 0.4);
    position: relative;
    overflow: hidden;
}

.banner-content {
    position: relative;
    z-index: 2;
}

.banner-text h2 {
    color: #ffffff;
    font-size: 32px;
    font-weight: 800;
    margin: 0 0 8px 0;
    letter-spacing: -0.5px;
}

.banner-text p {
    color: rgba(255, 255, 255, 0.9);
    font-size: 16px;
    margin: 0;
    font-weight: 400;
}

.banner-decoration {
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0;
    width: 50%;
    pointer-events: none;
}

.float-circle {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
}

.circle-1 {
    width: 200px;
    height: 200px;
    right: -50px;
    top: -50px;
    animation: float 6s ease-in-out infinite;
}

.circle-2 {
    width: 150px;
    height: 150px;
    right: 100px;
    bottom: -30px;
    animation: float 8s ease-in-out infinite;
}

.circle-3 {
    width: 100px;
    height: 100px;
    right: 200px;
    top: 50%;
    transform: translateY(-50%);
    animation: float 7s ease-in-out infinite;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-20px);
    }
}

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
/*  STATS CARDS                                                          */
/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */

.stats-container {
    margin-top: 30px;
}

.stat-card {
    background: #ffffff;
    border-radius: 24px;
    padding: 32px;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #6366f1 0%, #8b5cf6 100%);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.4s ease;
}

.stat-card:hover::before {
    transform: scaleX(1);
}

.stat-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
}

.stat-icon {
    width: 64px;
    height: 64px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    color: #ffffff;
    margin-bottom: 20px;
    position: relative;
    z-index: 2;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
}

.card-gradient-1 .stat-icon {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.card-gradient-2 .stat-icon {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.card-gradient-3 .stat-icon {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.stat-content {
    position: relative;
    z-index: 2;
}

.stat-label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
}

.stat-value {
    font-size: 42px;
    font-weight: 800;
    color: #111827;
    margin: 0 0 12px 0;
    line-height: 1;
    letter-spacing: -1px;
}

.stat-trend {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: #6b7280;
    font-weight: 500;
}

.stat-trend i {
    font-size: 12px;
    color: #10b981;
}

.stat-bg-icon {
    position: absolute;
    right: -20px;
    bottom: -20px;
    font-size: 140px;
    opacity: 0.03;
    pointer-events: none;
    transform: rotate(-15deg);
}

/* Responsive */
@media (max-width: 768px) {
    .welcome-banner {
        padding: 30px 24px;
    }

    .banner-text h2 {
        font-size: 24px;
    }

    .banner-text p {
        font-size: 14px;
    }

    .stat-card {
        padding: 24px;
    }

    .stat-value {
        font-size: 36px;
    }

    .circle-1, .circle-2, .circle-3 {
        display: none;
    }
}
</style>

@endsection
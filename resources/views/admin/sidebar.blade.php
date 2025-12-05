{{-- resources/views/partials/sidebar.blade.php --}}

<div class="sidebar-ultra-modern">
    <div class="sidebar-header">
        <div class="logo-area">
            <span>Admin Panel</span>
        </div>
    </div>

    <ul class="list-group sidebar-menu">
        {{-- DASHBOARD --}}
        <a href="/admin/dashboard" class="list-group-item sidebar-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <div class="item-content">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </div>
            <div class="item-indicator"></div>
        </a>

        {{-- MANAJEMEN BARANG --}}
        <a href="{{ route('admin.items.index') }}" class="list-group-item sidebar-item {{ request()->routeIs('admin.items.*') ? 'active' : '' }}">
            <div class="item-content">
                <i class="fas fa-box"></i>
                <span>Manajemen Barang</span>
            </div>
            <div class="item-indicator"></div>
        </a>

        {{-- CATEGORY --}}
        <a href="{{ route('admin.categories.index') }}" class="list-group-item sidebar-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <div class="item-content">
                <i class="fas fa-tags"></i>
                <span>Category</span>
            </div>
            <div class="item-indicator"></div>
        </a>

        {{-- DATA TIP --}}
        <a href="{{ route('admin.tip.index') }}" class="list-group-item sidebar-item {{ request()->routeIs('admin.tip.*') ? 'active' : '' }}">
            <div class="item-content">
                <i class="fas fa-money-bill-wave"></i>
                <span>Data Tip</span>
            </div>
            <div class="item-indicator"></div>
        </a>

        <div class="sidebar-divider"></div>

        {{-- LOGOUT --}}
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="list-group-item sidebar-item logout-item">
            <div class="item-content">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </div>
            <div class="item-indicator"></div>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
    </ul>
</div>

<style>
/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
/*  ULTRA MODERN SIDEBAR STYLES (ENHANCED VERSION)                  */
/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */

:root {
    --primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    --secondary-gradient: linear-gradient(135deg, #1a1f36 0%, #0f1419 100%);
    --accent-color: #fbbf24;
    --text-muted: #9ca3af;
    --text-active: #ffffff;
    --danger-color: #ef4444;
    --glass-bg: rgba(255, 255, 255, 0.05);
    --glass-border: rgba(255, 255, 255, 0.1);
}

.sidebar-ultra-modern {
    background: var(--secondary-gradient);
    border-radius: 24px;
    padding: 0;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4), 0 0 40px rgba(99, 102, 241, 0.1);
    overflow: hidden;
    position: relative;
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    animation: fadeInUp 0.8s ease-out;
}

.sidebar-ultra-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 250px;
    background: linear-gradient(135deg, rgba(99, 102, 241, 0.15) 0%, rgba(139, 92, 246, 0.08) 50%, transparent 100%);
    pointer-events: none;
    animation: shimmer 3s ease-in-out infinite;
}

.sidebar-ultra-modern::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 100px;
    background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, 0.2) 100%);
    pointer-events: none;
}

.sidebar-header {
    padding: 35px 25px;
    background: rgba(99, 102, 241, 0.1);
    border-bottom: 1px solid var(--glass-border);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    position: relative;
    z-index: 1;
}

.logo-area {
    display: flex;
    align-items: center;
    gap: 15px;
    color: var(--text-active);
    font-size: 22px;
    font-weight: 700;
    letter-spacing: -0.5px;
    text-shadow: 0 0 20px rgba(251, 191, 36, 0.5);
}

.logo-area i {
    font-size: 28px;
    color: var(--accent-color);
    filter: drop-shadow(0 0 15px rgba(251, 191, 36, 0.6));
    animation: pulseGlow 2s ease-in-out infinite;
}

.sidebar-menu {
    padding: 25px 15px;
    position: relative;
    z-index: 1;
}

.sidebar-menu .sidebar-item {
    background: var(--glass-bg);
    color: var(--text-muted);
    border: 1px solid var(--glass-border);
    padding: 0;
    margin: 8px 0;
    border-radius: 16px;
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    position: relative;
    overflow: hidden;
    will-change: transform, box-shadow;
    cursor: pointer;
}

.sidebar-item .item-content {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 16px 20px;
    position: relative;
    z-index: 2;
}

.sidebar-item i {
    font-size: 20px;
    width: 22px;
    text-align: center;
    transition: all 0.3s ease;
    will-change: transform;
}

.sidebar-item span {
    font-weight: 500;
    font-size: 15px;
    transition: color 0.3s ease;
}

.sidebar-item .item-indicator {
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%) scaleY(0);
    width: 6px;
    height: 30px;
    background: var(--primary-gradient);
    border-radius: 0 12px 12px 0;
    transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    box-shadow: 0 0 20px rgba(99, 102, 241, 0.5);
}

.sidebar-item::before {
    content: '';
    position: absolute;
    inset: 0;
    background: var(--primary-gradient);
    opacity: 0;
    transition: opacity 0.4s ease;
    border-radius: inherit;
}

.sidebar-item::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: width 0.6s ease, height 0.6s ease;
    pointer-events: none;
}

.sidebar-item:hover {
    color: var(--text-active);
    transform: translateX(6px) scale(1.02);
    box-shadow: 0 10px 30px rgba(99, 102, 241, 0.2), 0 0 40px rgba(139, 92, 246, 0.1);
}

.sidebar-item:hover::before {
    opacity: 0.1;
}

.sidebar-item:hover i {
    transform: scale(1.15) rotate(5deg);
    color: #a78bfa;
    filter: drop-shadow(0 0 10px rgba(167, 139, 250, 0.5));
}

.sidebar-item:active::after {
    width: 300px;
    height: 300px;
}

.sidebar-item.active {
    color: var(--text-active);
    background: rgba(99, 102, 241, 0.15);
    box-shadow: 0 0 50px rgba(99, 102, 241, 0.3), inset 0 0 20px rgba(139, 92, 246, 0.1);
    border-color: rgba(99, 102, 241, 0.3);
}

.sidebar-item.active::before {
    opacity: 0.2;
}

.sidebar-item.active .item-indicator {
    transform: translateY(-50%) scaleY(1);
    animation: glowPulse 1.5s ease-in-out infinite;
}

.sidebar-item.active i {
    color: #a78bfa;
    filter: drop-shadow(0 0 15px rgba(167, 139, 250, 0.7));
}

.sidebar-divider {
    height: 2px;
    background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.15) 50%, transparent 100%);
    margin: 25px 0;
    position: relative;
}

.sidebar-divider::before {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 60%;
    height: 100%;
    background: linear-gradient(90deg, transparent 0%, rgba(99, 102, 241, 0.3) 50%, transparent 100%);
    animation: shimmer 2s ease-in-out infinite;
}

.logout-item {
    background: rgba(239, 68, 68, 0.1) !important;
    border-color: rgba(239, 68, 68, 0.2) !important;
}

.logout-item:hover {
    background: rgba(239, 68, 68, 0.2) !important;
    color: #fca5a5 !important;
    box-shadow: 0 10px 30px rgba(239, 68, 68, 0.3);
}

.logout-item .item-indicator {
    background: linear-gradient(180deg, #ef4444 0%, #dc2626 100%) !important;
    box-shadow: 0 0 20px rgba(239, 68, 68, 0.5) !important;
}

/* Animations */
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

@keyframes shimmer {
    0%, 100% {
        opacity: 0.5;
        transform: translateX(-100%);
    }
    50% {
        opacity: 1;
        transform: translateX(100%);
    }
}

@keyframes pulseGlow {
    0%, 100% {
        filter: drop-shadow(0 0 10px rgba(251, 191, 36, 0.5));
    }
    50% {
        filter: drop-shadow(0 0 20px rgba(251, 191, 36, 0.8));
    }
}

@keyframes glowPulse {
    0%, 100% {
        box-shadow: 0 0 20px rgba(99, 102, 241, 0.5);
    }
    50% {
        box-shadow: 0 0 40px rgba(99, 102, 241, 0.8);
    }
}

/* Responsive */
@media (max-width: 768px) {
    .sidebar-ultra-modern {
        border-radius: 18px;
        animation: none; /* Disable animation on mobile for performance */
    }

    .sidebar-header {
        padding: 25px 18px;
    }

    .logo-area {
        font-size: 20px;
    }

    .sidebar-menu {
        padding: 20px 12px;
    }

    .sidebar-item .item-content {
        padding: 14px 18px;
    }

    .sidebar-item:hover {
        transform: translateX(4px) scale(1.01);
    }
}
</style>
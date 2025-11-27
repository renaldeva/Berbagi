@section('sidebar')
<div class="sidebar-modern">
    <ul class="list-group sidebar-menu">

        {{-- DASHBOARD --}}
        <a href="/admin/dashboard" class="list-group-item sidebar-item">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>

        {{-- MANAJEMEN BARANG --}}
        <a href="{{ route('admin.items.index') }}" class="list-group-item sidebar-item">
            <i class="fas fa-box"></i> Manajemen Barang
        </a>

        {{-- CATEGORY (PERBAIKAN DISINI) --}}
        <a href="{{ route('admin.categories.index') }}" class="list-group-item sidebar-item">
            <i class="fas fa-tags"></i> Category
        </a>

        {{-- RIWAYAT BARANG --}}
        <a href="{{ route('admin.history.index') }}" class="list-group-item sidebar-item">
            <i class="fas fa-history"></i> Riwayat Barang
        </a>

        {{-- LOGOUT --}}
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="list-group-item sidebar-item text-danger">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>

    </ul>
</div>

<style>
    .sidebar-modern {
        background: linear-gradient(180deg, #4B0082, #6A0DAD);
        border-radius: 14px;
        padding: 0;
        box-shadow: 0 4px 15px rgba(106, 13, 173, 0.4);
    }

    .sidebar-menu .sidebar-item {
        background: transparent;
        color: #e7d7ff;
        border: none;
        padding: 14px 18px;
        font-weight: 500;
        transition: 0.25s;
        display: flex;
        align-items: center;
        gap: 10px;
        border-radius: 8px;
        margin: 4px 8px;
    }

    .sidebar-item i {
        font-size: 17px;
        opacity: 0.85;
    }

    .sidebar-item:hover {
        background: rgba(255, 255, 255, 0.12);
        color: #ffffff;
        transform: translateX(6px);
        box-shadow: 0px 2px 10px rgba(255, 255, 255, 0.15);
    }
</style>
@endsection

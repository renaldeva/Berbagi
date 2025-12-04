@extends('layouts.app')

@section('sidebar')
@include('admin.sidebar')
@endsection

@section('content')

{{-- Header Section --}}
<div class="page-header-modern">
    <div class="header-content">
        <div class="header-title-section">
            <h2 class="page-title">
                <i class="fas fa-box-open"></i>
                Manajemen Barang
            </h2>
            <p class="page-subtitle">Kelola dan verifikasi barang yang masuk ke sistem</p>
        </div>
        <div class="header-actions">
            <button class="btn-filter" onclick="toggleFilter()">
                <i class="fas fa-filter"></i>
                <span>Filter</span>
            </button>
            <button class="btn-refresh" onclick="location.reload()">
                <i class="fas fa-sync-alt"></i>
            </button>
        </div>
    </div>

    {{-- Filter Section (Hidden by default) --}}
    <div class="filter-section" id="filterSection" style="display: none;">
        <div class="filter-grid">
            <div class="filter-item">
                <label>Status</label>
                <select class="form-select-modern" onchange="filterTable('status', this.value)">
                    <option value="">Semua Status</option>
                    <option value="pending">Menunggu ACC</option>
                    <option value="approved">Disetujui</option>
                    <option value="rejected">Ditolak</option>
                </select>
            </div>
            <div class="filter-item">
                <label>Kondisi</label>
                <select class="form-select-modern" onchange="filterTable('kondisi', this.value)">
                    <option value="">Semua Kondisi</option>
                    <option value="Baru">Baru</option>
                    <option value="Bekas">Bekas</option>
                </select>
            </div>
            <div class="filter-item">
                <label>Cari Barang</label>
                <input type="text" class="form-input-modern" placeholder="Nama barang..." onkeyup="searchTable(this.value)">
            </div>
        </div>
    </div>
</div>

{{-- Stats Cards --}}
<div class="stats-mini-container">
    <div class="stat-mini-card">
        <div class="stat-mini-icon pending">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-mini-content">
            <span class="stat-mini-label">Menunggu</span>
            <h4 class="stat-mini-value">{{ $items->where('status', 'pending')->count() }}</h4>
        </div>
    </div>
    
    <div class="stat-mini-card">
        <div class="stat-mini-icon approved">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-mini-content">
            <span class="stat-mini-label">Disetujui</span>
            <h4 class="stat-mini-value">{{ $items->where('status', 'approved')->count() }}</h4>
        </div>
    </div>
    
    <div class="stat-mini-card">
        <div class="stat-mini-icon rejected">
            <i class="fas fa-times-circle"></i>
        </div>
        <div class="stat-mini-content">
            <span class="stat-mini-label">Ditolak</span>
            <h4 class="stat-mini-value">{{ $items->where('status', 'rejected')->count() }}</h4>
        </div>
    </div>

    <div class="stat-mini-card">
        <div class="stat-mini-icon total">
            <i class="fas fa-boxes"></i>
        </div>
        <div class="stat-mini-content">
            <span class="stat-mini-label">Total Barang</span>
            <h4 class="stat-mini-value">{{ $items->count() }}</h4>
        </div>
    </div>
</div>

{{-- Table Card --}}
<div class="table-card-modern">
    <div class="table-responsive-modern">
        <table class="table-modern" id="itemsTable">
            <thead>
                <tr>
                    <th>
                        <div class="th-content">
                            <span>No</span>
                        </div>
                    </th>
                    <th>
                        <div class="th-content">
                            <i class="fas fa-box"></i>
                            <span>Nama Barang</span>
                        </div>
                    </th>
                    <th>
                        <div class="th-content">
                            <i class="fas fa-align-left"></i>
                            <span>Deskripsi</span>
                        </div>
                    </th>
                    <th>
                        <div class="th-content">
                            <i class="fas fa-star"></i>
                            <span>Kondisi</span>
                        </div>
                    </th>
                    <th>
                        <div class="th-content">
                            <i class="fas fa-tags"></i>
                            <span>Kategori</span>
                        </div>
                    </th>
                    <th>
                        <div class="th-content">
                            <i class="fas fa-image"></i>
                            <span>Foto</span>
                        </div>
                    </th>
                    <th>
                        <div class="th-content">
                            <i class="fas fa-info-circle"></i>
                            <span>Status</span>
                        </div>
                    </th>
                    <th>
                        <div class="th-content">
                            <i class="fas fa-cog"></i>
                            <span>Aksi</span>
                        </div>
                    </th>
                </tr>
            </thead>

            <tbody>
                @forelse($items as $item)
                <tr class="table-row-hover" data-status="{{ $item->status }}" data-kondisi="{{ $item->kondisi }}">
                    <td>
                        <div class="td-number">
                            {{ $loop->iteration }}
                        </div>
                    </td>
                    
                    <td>
                        <div class="td-product">
                            <span class="product-name">{{ $item->nama_barang }}</span>
                        </div>
                    </td>
                    
                    <td>
                        <div class="td-description">
                            {{ Str::limit($item->deskripsi, 50) }}
                        </div>
                    </td>

                    <td>
                        <div class="td-kondisi">
                            <span class="kondisi-badge {{ strtolower($item->kondisi) }}">
                                <i class="fas fa-circle"></i>
                                {{ $item->kondisi }}
                            </span>
                        </div>
                    </td>

                    <td>
                        <div class="td-category">
                            <span class="category-tag">
                                <i class="fas fa-tag"></i>
                                {{ $item->category->nama_kategori ?? '-' }}
                            </span>
                        </div>
                    </td>

                    <td>
                        <div class="td-image">
                            @if($item->foto)
                                <div class="image-container" onclick="showImageModal('{{ asset('storage/' . $item->foto) }}')">
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="foto">
                                    <div class="image-overlay">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                </div>
                            @else
                                <div class="no-image">
                                    <i class="fas fa-image"></i>
                                    <span>No Image</span>
                                </div>
                            @endif
                        </div>
                    </td>

                    <td>
                        <div class="td-status">
                            @if($item->status == 'pending')
                                <span class="status-badge status-pending">
                                    <i class="fas fa-clock"></i>
                                    Menunggu ACC
                                </span>
                            @elseif($item->status == 'approved')
                                <span class="status-badge status-approved">
                                    <i class="fas fa-check-circle"></i>
                                    Disetujui
                                </span>
                            @elseif($item->status == 'rejected')
                                <span class="status-badge status-rejected">
                                    <i class="fas fa-times-circle"></i>
                                    Ditolak
                                </span>
                            @endif
                        </div>
                    </td>

                    <td>
                        <div class="td-actions">
                            @if($item->status == 'pending')
                                <form action="{{ route('admin.items.acc', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn-action btn-approve" type="submit" title="Setujui">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>

                                <button class="btn-action btn-reject"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalTolak{{ $item->id }}"
                                        title="Tolak">
                                    <i class="fas fa-times"></i>
                                </button>
                            @else
                                <span class="text-processed">Sudah Diproses</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">
                        <div class="empty-state">
                            <i class="fas fa-box-open"></i>
                            <h4>Tidak Ada Data</h4>
                            <p>Belum ada barang yang terdaftar di sistem</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Penolakan --}}
@foreach($items as $item)
<div class="modal fade" id="modalTolak{{ $item->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('admin.items.reject', $item->id) }}" method="POST" class="modal-content-modern">
            @csrf

            <div class="modal-header-modern">
                <div class="modal-icon-reject">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h5 class="modal-title-modern">Tolak Barang</h5>
                <button type="button" class="btn-close-modern" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body-modern">
                <p class="modal-description">Berikan alasan penolakan untuk <strong>{{ $item->nama_barang }}</strong></p>
                <textarea name="alasan" 
                          class="form-textarea-modern" 
                          rows="4" 
                          placeholder="Tuliskan alasan penolakan barang ini..."
                          required></textarea>
            </div>

            <div class="modal-footer-modern">
                <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                    Batal
                </button>
                <button type="submit" class="btn-modal-reject">
                    <i class="fas fa-paper-plane"></i>
                    Submit Penolakan
                </button>
            </div>
        </form>
    </div>
</div>
@endforeach

{{-- Image Preview Modal --}}
<div class="image-preview-modal" id="imagePreviewModal" onclick="closeImageModal()">
    <span class="close-preview">&times;</span>
    <img class="modal-image-content" id="modalImage">
</div>

<style>
/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
/*  GLOBAL STYLES                                                        */
/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */

* {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
}

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
/*  PAGE HEADER                                                          */
/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */

.page-header-modern {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-title-section {
    color: #ffffff;
}

.page-title {
    font-size: 28px;
    font-weight: 800;
    margin: 0 0 8px 0;
    display: flex;
    align-items: center;
    gap: 12px;
    color: #ffffff;
}

.page-title i {
    font-size: 26px;
}

.page-subtitle {
    margin: 0;
    font-size: 14px;
    color: rgba(255, 255, 255, 0.9);
}

.header-actions {
    display: flex;
    gap: 10px;
}

.btn-filter, .btn-refresh {
    background: rgba(255, 255, 255, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: #ffffff;
    padding: 10px 20px;
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.btn-filter:hover, .btn-refresh:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
}

.btn-refresh {
    padding: 10px 15px;
}

/* Filter Section */
.filter-section {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid rgba(255, 255, 255, 0.2);
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.filter-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
}

.filter-item label {
    display: block;
    color: rgba(255, 255, 255, 0.9);
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 8px;
}

.form-select-modern, .form-input-modern {
    width: 100%;
    padding: 10px 15px;
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.15);
    color: #ffffff;
    font-size: 14px;
    transition: all 0.3s ease;
}

.form-select-modern:focus, .form-input-modern:focus {
    outline: none;
    background: rgba(255, 255, 255, 0.25);
    border-color: rgba(255, 255, 255, 0.5);
}

.form-select-modern option {
    background: #1a1f36;
    color: #ffffff;
}

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
/*  MINI STATS CARDS                                                     */
/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */

.stats-mini-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-mini-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}

.stat-mini-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
}

.stat-mini-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    color: #ffffff;
}

.stat-mini-icon.pending {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
}

.stat-mini-icon.approved {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
}

.stat-mini-icon.rejected {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
}

.stat-mini-icon.total {
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
}

.stat-mini-label {
    display: block;
    font-size: 13px;
    color: #6b7280;
    font-weight: 600;
    margin-bottom: 4px;
}

.stat-mini-value {
    font-size: 24px;
    font-weight: 800;
    color: #111827;
    margin: 0;
}

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
/*  TABLE MODERN                                                         */
/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */

.table-card-modern {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.table-responsive-modern {
    overflow-x: auto;
}

.table-modern {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

.table-modern thead {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
}

.table-modern thead th {
    padding: 18px 20px;
    text-align: left;
    font-weight: 700;
    font-size: 13px;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #e2e8f0;
}

.th-content {
    display: flex;
    align-items: center;
    gap: 8px;
}

.th-content i {
    color: #94a3b8;
    font-size: 12px;
}

.table-modern tbody tr {
    transition: all 0.3s ease;
    border-bottom: 1px solid #f1f5f9;
}

.table-modern tbody tr:hover {
    background: #f8fafc;
    transform: scale(1.01);
}

.table-modern tbody td {
    padding: 18px 20px;
    vertical-align: middle;
}

/* Table Cell Styles */
.td-number {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 14px;
}

.td-product .product-name {
    font-weight: 600;
    color: #1e293b;
    font-size: 14px;
}

.td-description {
    color: #64748b;
    font-size: 13px;
    line-height: 1.5;
}

.kondisi-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.kondisi-badge.baru {
    background: #dbeafe;
    color: #1e40af;
}

.kondisi-badge.bekas {
    background: #fef3c7;
    color: #92400e;
}

.kondisi-badge i {
    font-size: 6px;
}

.category-tag {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    background: #f1f5f9;
    border-radius: 8px;
    color: #475569;
    font-size: 13px;
    font-weight: 500;
}

.category-tag i {
    font-size: 11px;
}

/* Image Styles */
.td-image {
    display: flex;
    justify-content: center;
}

.image-container {
    position: relative;
    width: 70px;
    height: 70px;
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.image-container:hover img {
    transform: scale(1.1);
}

.image-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    color: #ffffff;
    font-size: 20px;
}

.image-container:hover .image-overlay {
    opacity: 1;
}

.no-image {
    width: 70px;
    height: 70px;
    border-radius: 12px;
    background: #f1f5f9;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 4px;
    color: #94a3b8;
}

.no-image i {
    font-size: 20px;
}

.no-image span {
    font-size: 10px;
    font-weight: 600;
}

/* Status Badges */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.status-pending {
    background: #fef3c7;
    color: #92400e;
}

.status-approved {
    background: #d1fae5;
    color: #065f46;
}

.status-rejected {
    background: #fee2e2;
    color: #991b1b;
}

/* Action Buttons */
.td-actions {
    display: flex;
    gap: 8px;
}

.btn-action {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 14px;
}

.btn-approve {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: #ffffff;
}

.btn-approve:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
}

.btn-reject {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: #ffffff;
}

.btn-reject:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
}

.text-processed {
    font-size: 12px;
    color: #94a3b8;
    font-weight: 500;
    font-style: italic;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #94a3b8;
}

.empty-state i {
    font-size: 64px;
    margin-bottom: 20px;
    opacity: 0.5;
}

.empty-state h4 {
    font-size: 20px;
    font-weight: 700;
    color: #64748b;
    margin-bottom: 8px;
}

.empty-state p {
    font-size: 14px;
    margin: 0;
}

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
/*  MODAL MODERN                                                         */
/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */

.modal-content-modern {
    border: none;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
}

.modal-header-modern {
    background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    padding: 30px;
    border: none;
    text-align: center;
    position: relative;
}

.modal-icon-reject {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: #ffffff;
    font-size: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
}

.modal-title-modern {
    font-size: 22px;
    font-weight: 800;
    color: #991b1b;
    margin: 0;
}

.btn-close-modern {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.9);
    border: none;
    color: #991b1b;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.btn-close-modern:hover {
    background: #ffffff;
    transform: rotate(90deg);
}

.modal-body-modern {
    padding: 30px;
}

.modal-description {
    color: #475569;
    font-size: 14px;
    margin-bottom: 20px;
    line-height: 1.6;
}

.form-textarea-modern {
    width: 100%;
    padding: 15px;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 14px;
    color: #1e293b;
    resize: vertical;
    transition: all 0.3s ease;
}

.form-textarea-modern:focus {
    outline: none;
    border-color: #ef4444;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

.modal-footer-modern {
    padding: 20px 30px;
    background: #f8fafc;
    border: none;
    display: flex;
    justify-content: flex-end;
    gap: 12px;
}

.btn-modal-cancel, .btn-modal-reject {
    padding: 12px 24px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 14px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.btn-modal-cancel {
    background: #e2e8f0;
    color: #475569;
}

.btn-modal-cancel:hover {
    background: #cbd5e1;
}

.btn-modal-reject {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: #ffffff;
}

.btn-modal-reject:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
}

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
/*  IMAGE PREVIEW MODAL                                                  */
/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */

.image-preview-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    padding-top: 60px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.95);
    animation: fadeIn 0.3s;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.modal-image-content {
    margin: auto;
    display: block;
    max-width: 90%;
    max-height: 80%;
    border-radius: 12px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
}

.close-preview {
    position: absolute;
    top: 20px;
    right: 40px;
    color: #ffffff;
    font-size: 40px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

.close-preview:hover {
    color: #ef4444;
}

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
/*  RESPONSIVE                                                           */
/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */

@media (max-width: 768px) {
    .page-header-modern {
        padding: 20px;
    }

    .header-content {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
    }

    .page-title {
        font-size: 22px;
    }

    .stats-mini-container {
        grid-template-columns: repeat(2, 1fr);
    }

    .table-modern thead th {
        font-size: 11px;
        padding: 12px 10px;
    }

    .table-modern tbody td {
        padding: 12px 10px;
        font-size: 13px;
    }

    .td-number {
        width: 32px;
        height: 32px;
        font-size: 12px;
    }

    .image-container {
        width: 50px;
        height: 50px;
    }

    .no-image {
        width: 50px;
        height: 50px;
    }
}
</style>

<script>
// Toggle Filter
function toggleFilter() {
    const filterSection = document.getElementById('filterSection');
    if (filterSection.style.display === 'none') {
        filterSection.style.display = 'block';
    } else {
        filterSection.style.display = 'none';
    }
}

// Filter Table by Column
function filterTable(column, value) {
    const table = document.getElementById('itemsTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    
    for (let row of rows) {
        if (value === '') {
            row.style.display = '';
        } else {
            const dataValue = row.getAttribute('data-' + column);
            if (dataValue && dataValue.toLowerCase() === value.toLowerCase()) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    }
}

// Search Table
function searchTable(query) {
    const table = document.getElementById('itemsTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    
    for (let row of rows) {
        const text = row.textContent.toLowerCase();
        if (text.includes(query.toLowerCase())) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    }
}

// Show Image Modal
function showImageModal(imageSrc) {
    const modal = document.getElementById('imagePreviewModal');
    const modalImg = document.getElementById('modalImage');
    modal.style.display = 'block';
    modalImg.src = imageSrc;
}

// Close Image Modal
function closeImageModal() {
    document.getElementById('imagePreviewModal').style.display = 'none';
}
</script>

@endsection
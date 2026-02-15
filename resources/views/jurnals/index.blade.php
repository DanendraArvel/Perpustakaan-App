@extends('layouts.app')

@section('title', 'Data Jurnal Perpustakaan')

@section('content')
<style>
    .filter-container { background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #dee2e6; }
    .search-form { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; }
    .search-box, .filter-select { padding: 10px; border: 1px solid #ddd; border-radius: 5px; flex: 1; min-width: 150px; }
    .btn-search { padding: 10px 25px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 14px; font-weight: bold; }
    .btn-search:hover { 
        background: #0056b3; 
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transform: scale(1.05);
        transition: all 0.3s ease;
    }
    .btn-reset { padding: 10px 20px; background: #6c757d; color: white; border-radius: 5px; text-decoration: none; font-size: 14px; font-weight: bold; }
    .btn-reset:hover { 
        background: #5a6268; 
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transform: scale(1.05);
        transition: all 0.3s ease;
    }
    .btn-create { display: inline-block; transition: all 0.3s ease; padding: 10px 15px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 15px; text-decoration: none; font-weight: bold; }
    .btn-create:hover { 
        background: #0056b3; 
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transform: scale(1.05);
        transition: all 0.3s ease;
    }
    .btn-back { display: inline-block; transition: all 0.3s ease; padding: 10px 15px; background: #6c757d; color: white; border-radius: 5px; font-size: 15px; text-decoration: none; font-weight: bold; }
    .btn-back:hover { 
        background: #5a6268; 
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transform: scale(1.05);
        transition: all 0.3s ease;
    }
    
    .btn-warning { background: #ffc107; color: #333; font-size: 12px; padding: 5px 10px; text-decoration: none; }
    .btn-danger { background: #dc3545; color: white; font-size: 12px; padding: 5px 10px; border: none; cursor: pointer; }
    .btn-info { background: #17a2b8; color: white; font-size: 12px; padding: 5px 10px; text-decoration: none; }

    table { width: 100%; border-collapse: collapse; background: white; margin-top: 10px; }
    th { background: #3097af; color: white; padding: 12px; text-align: left; }
    td { padding: 12px; border-bottom: 1px solid #eee; }
    tr:hover { background: #f1f1f1; }
    
    .status-badge { padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold; }
    .bg-success { background: #d4edda; color: #155724; }
    .bg-danger { background: #f8d7da; color: #721c24; }

    .pagination-container nav ul {
        display: flex !important;
        justify-content: center !important;
        list-style: none !important;
        padding: 0 !important;
        margin-top: 5px !important;
        gap: 5px !important;
    }

    .pagination-container nav li a, 
    .pagination-container nav li span {
        display: block !important;
        padding: 8px 16px !important;
        border: 1px solid #dee2e6 !important;
        border-radius: 5px !important;
        color: #3097af !important;
        text-decoration: none !important;
        background-color: white !important;
        font-weight: bold !important;
    }

    .pagination-container nav li.active span {
        background-color: #3097af !important;
        color: white !important;
        border-color: #3097af !important;
    }

    .pagination-container nav li a:hover {
        background-color: #f1f1f1 !important;
        transform: scale(1.05);
        transition: all 0.2s ease;
    }

    .pagination-container nav .flex.justify-between.flex-1,
    .pagination-container nav .hidden.sm\:flex-1 {
        display: none !important;
    }

    .pagination-container nav p {
        text-align: center !important;
        gap: 5px !important;
    }

    .toggle-sidebar {
        border: none;
        background-color: #3097af;
        color: white;
        font-weight: bold;
        font-size: 15px;
        padding: 10px 10px;
        border-radius: 5px;
        cursor: pointer;
        z-index: 1001;
    }
    
    .toggle-sidebar:hover {
        background-color: #2a8599;
    }
    
    .sidebar {
        height: 100vh;
        width: 200px;
        list-style: none;
        background-color: #3097af;
        position: fixed;
        left: -200px;
        top: 0;
        margin: 0;
        padding: 0;
        padding-top: 60px; 
        transition: left 0.5s ease;
        z-index: 1000;
        box-shadow: 2px 0 5px rgba(0,0,0,0.1);

        display: flex;
        flex-direction: column;
    }
    
    .sidebar.active {
        left: 0;
        box-shadow: 5px 0 15px rgba(0,0,0,0.1);
    }

    .sidebar li.logout-item {
        margin-top: auto;
        margin-bottom: 20px;
        padding-top: 0;
    }

    .sidebar .btn-logout-sidebar {
        width: 100%;
        background: none;
        border: none;
        color: white;
        font-weight: bold;
        text-align: left;
        padding: 15px 25px;
        cursor: pointer;
        font-size: 14px;
        transition: 0.3s;
        border-top: 1px solid rgba(255,255,255,0.1);
    }

    .sidebar .btn-logout-sidebar:hover {
        background-color: rgba(0,0,0,0.2);
        color: #ffcccc;
    }
    
    .sidebar li {
        padding-top: 12px;
        margin: 0;
    }
    
    .sidebar li a {
        display: block;
        padding: 15px 25px;
        text-decoration: none;
        color: white;
        font-weight: bold;
        text-transform: uppercase;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        border-left: 1px solid rgba(255,255,255,0.1);
        transition: background-color 0.3s ease, padding-left 0.3s ease;
    }
    
    .sidebar li a:hover {
        padding-left: 35px;
    }
    
    .sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 999;
    }
    
    .sidebar-overlay.active {
        display: block;
    }

    .head {
        display: flex;
        align-items: center; 
        justify-content: space-between;
        width: 100%;
        height: 70px;
        background-color: #fff;
        border-bottom: 2px solid #3097af;
        position: fixed;
        top: 0;
        left: 0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        padding: 0 20px;
        box-sizing: border-box;
        z-index: 1000;

        transition: left 0.5s ease;
    }

    .brand-center {
        display: flex;
        align-items: center;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
    }

    .brand-center img {
        width: 45px;
        height: 45px;
    }
    
    .brand-center p {
        margin: 0;
        padding-left: 10px;
        font-weight: bold;
        color: #333;
        white-space: nowrap;
    }
</style>

<div class="head">
    <button class="toggle-sidebar" id="toggle-sidebar">☰ Menu</button>
    <div class="brand-center">
        <img src="https://smkn11semarang.sch.id/wp-content/uploads/2022/07/cropped-cropped-Logo-SMK-N-11-Smg-HD-1-scaled.png" alt="Logo SMKN N 11 Smg">
        <p>PERPUSTAKAAN SMKN 11 SEMARANG</p>
    </div>
    <div style="width: 80px;"></div>
</div>

<div class="sidebar-overlay" id="sidebar-overlay"></div>

<ul class="sidebar" id="sidebar">
    <li><a href="/dashboard">Dashboard</a></li>
    <li><a href="#">Kontak</a></li>
    @if (auth()->user()->token == 'admin')
    <li><a href="/jurnals">Jurnal</a></li>
    @endif

    <li class="logout-item">
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="btn-logout-sidebar">Logout</button>
        </form>
    </li>
</ul>

<div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-top: 70px; margin-bottom: 20px; margin-left: auto; margin-right: auto;">

    <h1>Jurnal Kunjungan</h1>
    <div>
        <a href="/dashboard" class="btn-back" style="margin-right: 10px;">Ke Dashboard</a>
        <a href="/jurnals/create" class="btn-create">Tambah Absen</a>
    </div>
</div>

<div class="filter-container">
    <form method="GET" action="/jurnals" class="search-form">
    
        <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="search-box">


        <input type="text" name="jam" value="{{ request('jam') }}" placeholder="Jam (Contoh: 14 atau 14:30)" class="search-box">


    
        <select name="keperluan" class="filter-select">
            <option value="">Semua Keperluan</option>
            <option value="menemui-guru" {{ request('keperluan') == 'menemui-guru' ? 'selected' : '' }}>Menemui Guru</option>
            <option value="meminjam-buku" {{ request('keperluan') == 'meminjam-buku' ? 'selected' : '' }}>Meminjam Buku</option>
            <option value="mengembalikan-buku" {{ request('keperluan') == 'mengembalikan-buku' ? 'selected' : '' }}>Mengembalikan Buku</option>
        </select>

    
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama atau Buku..." class="search-box">

        <button type="submit" class="btn-search">Filter</button>
        <a href="/jurnals" class="btn-reset">Reset</a>
    </form>
</div>

@if($jurnals->count() > 0)
    <p><b>Total Data:</b> {{ $jurnals->total() }}</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Waktu</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Keperluan</th>
                <th>Judul Buku</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jurnals as $index => $jurnal)
            <tr>
                <td>{{ $jurnals->firstItem() + $index }}</td>
                <td>{{ $jurnal->created_at->format('d-m-Y H:i') }}</td>
                <td>{{ $jurnal->nama }}</td>
                <td>{{ $jurnal->kelas }}</td>
                <td>{{ ucwords(str_replace('-', ' ', $jurnal->keperluan)) }}</td>
                <td>{{ $jurnal->judul_buku ?? '-' }}</td>
                @if(auth()->user()->token == 'admin')
                <td>
                    <div class="actions">
                        <a href="/jurnals/{{ $jurnal->id }}/show" class="btn-info">Detail</a>
                            <a href="/jurnals/{{ $jurnal->id }}/edit" class="btn-warning">Edit</a>
                            <form method="POST" action="/jurnals/{{ $jurnal->id }}" style="display: inline;" 
                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger">Hapus</button>
                            </form>
                    </div>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination-container">
        {{ $jurnals->appends(request()->query())->links() }}
    </div>
@else
    <div style="text-align: center; padding: 50px; color: #999;">
        <p>Tidak ada data jurnal yang ditemukan.</p>
    </div>
@endif

<script>
    const toggleSidebar = document.getElementById('toggle-sidebar');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    toggleSidebar.addEventListener('click', function() {
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
        
        if (sidebar.classList.contains('active')) {
            toggleSidebar.style.transform = "translateX(200px)";
            toggleSidebar.innerHTML = "X Tutup";
        } else {
            toggleSidebar.style.transform = "translateX(0)";
            toggleSidebar.innerHTML = "☰ Menu";
        }
    });

    overlay.addEventListener('click', function() {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
        toggleSidebar.style.transform = "translateX(0)";
        toggleSidebar.innerHTML = "☰ Menu";
    });
</script>

@endsection

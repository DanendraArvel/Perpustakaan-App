@extends('layouts.app')

@section('title', 'Tambah Absensi')

@section('content')

<style>
    .form-container { text-align: center; background: white; padding: 30px; border-radius: 10px; max-width: 500px; margin-top: 100px; margin-left: auto; margin-right: auto; }
    .form-container h1 { margin-bottom: 20px; color: #333; }
    .form-group { text-align: center; margin-bottom: 15px; }
    .form-group label { display: block; margin-bottom: 5px; color: #555; font-weight: bold; }
    .form-group input, .form-group textarea, .form-group select { 
        font-weight: bold;
        text-align: center;
        width: 100%; 
        padding: 10px; 
        border: 1px solid #ddd; 
        border-radius: 5px; 
        font-size: 14px;
        padding: 15px; 
    }
    .form-group textarea { min-height: 100px; }
    .error { color: #dc3545; font-size: 12px; margin-top: 5px; }
    .form-actions { display: flex; flex-direction: column; align-items: center; gap: 15px; margin-top: 30px; }
    .btn {
        border: none; 
        border-radius: 5px; 
        cursor: pointer; 
        font-size: 14px; 
        text-decoration: none;
        display: inline-block;
    }
    .btn-primary { width: 100%; padding: 20px; background: #007bff; color: white; font-weight: bold; border-radius: 5px; }
    .btn-primary:hover { 
        background: #0056b3; 
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        transform: scale(1.05);
        transition: all 0.3s ease;
    }
    .btn-link {
        color: #6c757d;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.3s;
    }
    .btn-link:hover { 
        color: #343a40;
        text-decoration: underline;

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

<div class="form-container">

    <div class="head">
        <div class="brand-center">
            <img src="https://smkn11semarang.sch.id/wp-content/uploads/2022/07/cropped-cropped-Logo-SMK-N-11-Smg-HD-1-scaled.png" alt="Logo SMKN N 11 Smg">
            <p>PERPUSTAKAAN SMKN 11 SEMARANG</p>
        </div>
        <div style="width: 80px;"></div>
    </div>

    <h1>Absensi Perpustakaan</h1>

    <form method="POST" action="/jurnals" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Nama</label>
            <input style="text-transform: uppercase;" type="text" name="nama" value="{{ old('nama') }}" required>
            @error('nama')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Kelas</label>
            <input style="text-transform: uppercase;" type="text" name="kelas" value="{{ old('kelas') }}" required>
            @error('kelas')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label>Keperluan</label>
            <select name="keperluan" id="keperluan" required onchange="toggleBukuInput()">
                <option value="">-- Pilih Keperluan --</option>
                <option value="menemui-guru">Menemui Guru</option>
                <option value="meminjam-buku">Meminjam Buku</option>
                <option value="mengembalikan-buku">Mengembalikan Buku</option>
            </select>
        </div>

        <div class="form-group" id="form-buku" style="display: none;">
            <label>Nama Buku</label>
            <input style="text-transform: uppercase;" type="text" name="judul_buku" id="judul_buku" value="{{ old('judul_buku') }}">
            @error('judul_buku')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>   

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Absen</button>
            <a href="/dashboard" class="btn-link">Batal</a>
        </div>

        <script>
        function toggleBukuInput() {
            const keperluan = document.getElementById('keperluan').value;
            const formBuku = document.getElementById('form-buku');
            const inputBuku = document.getElementById('judul_buku');

            if (keperluan === 'meminjam-buku' || keperluan === 'mengembalikan-buku') {
                formBuku.style.display = 'block';
                inputBuku.setAttribute('required', 'required');
            } else {
                formBuku.style.display = 'none';
                inputBuku.removeAttribute('required');
                inputBuku.value = '';
            }
        }

        window.onload = toggleBukuInput;
        </script>


    </form>
</div>

<style>
    .swal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        animation: fadeIn 0.2s;
    }
    
    .swal-overlay.active {
        display: flex;
    }
    
    .swal-box {
        background: white;
        padding: 40px;
        border-radius: 15px;
        max-width: 450px;
        width: 90%;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        animation: zoomIn 0.3s;
        text-align: center;
    }
    
    .swal-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        border-radius: 50%;
        background: #dc3545;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 40px;
        color: white;
        animation: pulse 0.5s;
    }
    
    .swal-title {
        font-size: 24px;
        color: #333;
        margin-bottom: 15px;
        font-weight: bold;
    }
    
    .swal-text {
        color: #666;
        margin-bottom: 20px;
        line-height: 1.6;
    }
    
    .swal-errors {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        max-height: 200px;
        overflow-y: auto;
        text-align: left;
    }
    
    .swal-errors ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .swal-errors li {
        padding: 8px 12px;
        margin-bottom: 8px;
        background: white;
        border-left: 3px solid #dc3545;
        border-radius: 4px;
        color: #721c24;
    }
    
    .swal-button {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
        padding: 12px 40px;
        border: none;
        border-radius: 25px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        transition: all 0.3s;
    }
    
    .swal-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
    }
    
    @keyframes zoomIn {
        from {
            transform: scale(0.5);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }
</style>

<div class="swal-overlay" id="swalError">
    <div class="swal-box">
        <div class="swal-icon">⚠️</div>
        <div class="swal-title">Oops!</div>
        <div class="swal-text">Terdapat beberapa kesalahan pada form:</div>
        <div class="swal-errors">
            <ul id="swalErrorList"></ul>
        </div>
        <button class="swal-button" onclick="closeSwal()">Mengerti</button>
    </div>
</div>

<script>
function showSwal(errors) {
    const swal = document.getElementById('swalError');
    const errorList = document.getElementById('swalErrorList');
    
    errorList.innerHTML = '';
    errors.forEach(error => {
        const li = document.createElement('li');
        li.textContent = error;
        errorList.appendChild(li);
    });
    
    swal.classList.add('active');
}

function closeSwal() {
    document.getElementById('swalError').classList.remove('active');
}

document.getElementById('swalError').addEventListener('click', function(e) {
    if (e.target === this) {
        closeSwal();
    }
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeSwal();
    }
});

@if ($errors->any())
    showSwal(@json($errors->all()));
@endif
</script>
@endsection
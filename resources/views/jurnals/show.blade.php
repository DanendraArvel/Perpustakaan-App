@extends('layouts.app')

@section('title', 'Detail Absensi')

@section('content')
<style>
    .detail-container { background: white; padding: 30px; border-radius: 10px; max-width: 500px; margin-top: 100px; margin-left: auto; margin-right: auto; }
    .detail-container h1 { text-align: center; margin-bottom: 20px; color: #333; }
    .detail-row { display: flex; padding: 15px 0; border-bottom: 1px solid #eee; }
    .detail-label { width: 200px; font-weight: bold; color: #555; }
    .detail-value { flex: 1; color: #333; }
    .actions { margin-top: 30px; display: flex; gap: 10px; }
    .btn { 
        padding: 10px 20px; 
        text-decoration: none; 
        border-radius: 5px; 
        display: inline-block;
    }
    .btn:hover {
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        transition: cubic-bezier(0.215, 0.610, 0.355, 1) ease-in-out;
        -webkit-transition: cubic-bezier(0.215, 0.610, 0.355, 1) ease-in-out;
        -moz-transition: cubic-bezier(0.215, 0.610, 0.355, 1) ease-in-out;
        -ms-transition: cubic-bezier(0.215, 0.610, 0.355, 1) ease-in-out;
        -o-transition: cubic-bezier(0.215, 0.610, 0.355, 1) ease-in-out;
        transform: scale(105%);
        -webkit-transform: scale(105%);
        -moz-transform: scale(105%);
        -ms-transform: scale(105%);
        -o-transform: scale(105%);
    }
    .btn-secondary { background: #007bff; color: white; }
    .btn-secondary:hover { 
        background: #0056b3; 
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        transition: cubic-bezier(0.215, 0.610, 0.355, 1) ease-in-out;
        -webkit-transition: cubic-bezier(0.215, 0.610, 0.355, 1) ease-in-out;
        -moz-transition: cubic-bezier(0.215, 0.610, 0.355, 1) ease-in-out;
        -ms-transition: cubic-bezier(0.215, 0.610, 0.355, 1) ease-in-out;
        -o-transition: cubic-bezier(0.215, 0.610, 0.355, 1) ease-in-out;
        transform: scale(105%);
        -webkit-transform: scale(105%);
        -moz-transform: scale(105%);
        -ms-transform: scale(105%);
        -o-transform: scale(105%);
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

<div class="detail-container">

    <div class="head">
        <div class="brand-center">
            <img src="https://smkn11semarang.sch.id/wp-content/uploads/2022/07/cropped-cropped-Logo-SMK-N-11-Smg-HD-1-scaled.png" alt="Logo SMKN N 11 Smg">
            <p>PERPUSTAKAAN SMKN 11 SEMARANG</p>
        </div>
        <div style="width: 80px;"></div>
    </div>

    <h1>Detail Absensi</h1>

    <div class="detail-row">
        <div class="detail-label">Id:</div>
        <div class="detail-value">{{ $jurnal->id }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Nama:</div>
        <div class="detail-value">{{ $jurnal->nama }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Kelas:</div>
        <div class="detail-value">{{ $jurnal->kelas }}</div>
    </div>
    
    <div class="detail-row">
        <div class="detail-label">Keperluan:</div>
        <div class="detail-value">{{ $jurnal->keperluan }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Nama Buku:</div>
        <div class="detail-value">{{ $jurnal->judul_buku }}</div>
    </div>
    
    <div class="detail-row">
        <div class="detail-label">Dibuat pada:</div>
        <div class="detail-value">{{ $jurnal->created_at->format('d F Y H:i') }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Terakhir diupdate:</div>
        <div class="detail-value">{{ $jurnal->updated_at->format('d F Y H:i') }}</div>
    </div>

    <div class="actions">
        <a href="/jurnals" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
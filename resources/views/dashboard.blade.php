@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        
        .dashboard { 
            background: white; 
            padding: 30px; 
            border-radius: 10px;
            margin-top: 80px;
            transition: margin-left 0.5s;
        }
        
        .header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 30px; 
            position: relative;
        }
        
        .header h1 { color: #333; }

        .menu { margin-top: 30px; }
        
        .menu a { 
            display: inline-block;
            padding: 15px 30px; 
            background: #007bff; 
            color: white; 
            text-decoration: none; 
            border-radius: 5px; 
            margin-right: 10px;
        }
        
        .menu a:hover { 
            background: #0056b3;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            transform: scale(1.05);
            transition: all 0.3s ease;
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
</head>

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

<div class="dashboard" id="dashboard">
    <div class="header">
        
        <div>
            <h1>Dashboard</h1>
            <p>Selamat datang, <strong>{{ auth()->user()->name }}</strong>!</p>
        </div>
        
    </div>

    <div class="menu">
        <a href="/jurnals/create">Absen</a>
    </div>
</div>

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
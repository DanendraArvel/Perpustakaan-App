@extends('layouts.app')

@section('title', 'Success')

@section('content')

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>


    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f6f8;
            margin: 0;
            padding: 100px;
        }

        .container {
            max-width: 420px;
            margin: auto;
            background: white;
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            text-align: center;
            margin-bottom: 20px;
        }

        button {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        button {
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #1e40af;
            transform: scale(1.05);
            transition: all 0.3s ease;
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

<body>

    <div class="head">
        <div class="brand-center">
            <img src="https://smkn11semarang.sch.id/wp-content/uploads/2022/07/cropped-cropped-Logo-SMK-N-11-Smg-HD-1-scaled.png" alt="Logo SMKN N 11 Smg">
            <p>PERPUSTAKAAN SMKN 11 SEMARANG</p>
        </div>
        <div style="width: 80px;"></div>
    </div>

    <div class="container">
        <h2>Absensi Berhasil</h2>
        <p>Data kunjungan kamu sudah tercatat.</p>
        <a href="{{ route('dashboard') }}"><button>Kembali</button></a>
    </div>

</body>

@endsection

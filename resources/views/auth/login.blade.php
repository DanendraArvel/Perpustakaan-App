@extends('layouts.app')

@section('title', 'Login')

@section('content')
<style>
    .login-box { 
        max-width: 400px; 
        margin-top: 100px;
        margin-left: auto;
        margin-right: auto; 
        background: white; 
        padding: 30px; 
        border-radius: 10px; 
        box-shadow: 0 2px 10px rgba(0,0,0,0.1); 
    }
    .login-box h2 { margin-bottom: 20px; text-align: center; color: #333; }
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; margin-bottom: 5px; color: #555; }
    .form-group input { 
        width: 100%; 
        padding: 10px; 
        border: 1px solid #ddd; 
        border-radius: 5px; 
        font-size: 14px; 
    }
    .form-group input:hover { 
        border-color: #aaa; 
        box-shadow: 0 0 5px rgba(0,0,0,0.1); 
    }
    .btn { 
        width: 100%; 
        padding: 12px; 
        background: #007bff; 
        color: white; 
        border: none; 
        border-radius: 5px; 
        cursor: pointer; 
        font-size: 16px; 
    }
    .btn:hover { 
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

<div class="head">
        <div class="brand-center">
            <img src="https://smkn11semarang.sch.id/wp-content/uploads/2022/07/cropped-cropped-Logo-SMK-N-11-Smg-HD-1-scaled.png" alt="Logo SMKN N 11 Smg">
            <p>PERPUSTAKAAN SMKN 11 SEMARANG</p>
        </div>
    <div style="width: 80px;"></div>
</div>

@if(session('error'))
    <div class="alert alert-danger" style="margin-bottom: 20px; padding: 15px; background: #f8d7da; color: #721c24; border-radius: 8px; border: 1px solid #f5c6cb; position: relative; z-index: 10;">
        {{ session('error') }}
    </div>
@endif

<div class="login-box">
    <h2>Login</h2>
    <form method="POST" action="/login">
        @csrf
        
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" class="btn">Login</button>
    </form>
</div>
@endsection
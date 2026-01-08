@extends('layouts.app')
@stack('styles')
@section('content')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<div class="login-wrapper">
    <div class="login-card">
        <h1 class="logo" style="color: #6c63ff; margin-bottom: 10px;">CRM</h1>
        <h2>Welcome Back</h2>
        <p>Please enter your details to Log in.</p>

        @if(session('error'))
            <div class="error-msg">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <div class="form-group">
                <label>Email </label>
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>
</div>
@endsection
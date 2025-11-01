@extends('layouts.app')

@section('title', 'Login - Daiyaa Restaurant')

@section('styles')
<style>
    .auth-container {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    .auth-card {
        max-width: 500px;
        width: 100%;
    }

    .auth-title {
        text-align: center;
        font-size: 2rem;
        color: var(--primary-gold);
        margin-bottom: 2rem;
    }

    .form-footer {
        text-align: center;
        margin-top: 1.5rem;
        color: var(--text-secondary);
    }

    .form-footer a {
        color: var(--primary-gold);
        text-decoration: none;
    }

    .form-footer a:hover {
        text-decoration: underline;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .checkbox-group input[type="checkbox"] {
        width: auto;
    }
</style>
@endsection

@section('content')
<div class="auth-container">
    <div class="auth-card card">
        <h2 class="auth-title">Welcome Back</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                       name="email" value="{{ old('email') }}" required autofocus placeholder="your@email.com">
                @error('email')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                       name="password" required placeholder="Enter your password">
                @error('password')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <div class="checkbox-group">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" class="form-label" style="margin-bottom: 0;">Remember Me</label>
                </div>
            </div>

            <button type="submit" class="btn" style="width: 100%;">
                Login
            </button>

            <div class="form-footer">
                Don't have an account? <a href="{{ route('register') }}">Register here</a>
            </div>
        </form>
    </div>
</div>
@endsection


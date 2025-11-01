@extends('layouts.app')

@section('title', 'Register - Daiyaa Restaurant')

@section('styles')
<style>
    body {
        padding-top: 0 !important;
    }

    main {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .footer {
        margin-top: 0 !important;
    }

    .auth-container {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        padding-top: calc(80px + 2rem);
    }

    .auth-card {
        max-width: 600px;
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

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="auth-container">
    <div class="auth-card card">
        <h2 class="auth-title">Create Account</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Full Name</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                       name="name" value="{{ old('name') }}" required autofocus placeholder="John Doe">
                @error('name')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                           name="email" value="{{ old('email') }}" required placeholder="your@email.com">
                    @error('email')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" 
                           name="phone" value="{{ old('phone') }}" required placeholder="+94 77 123 4567">
                    @error('phone')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="address" class="form-label">Delivery Address</label>
                <textarea id="address" class="form-control @error('address') is-invalid @enderror" 
                          name="address" required placeholder="Street address">{{ old('address') }}</textarea>
                @error('address')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="city" class="form-label">City</label>
                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" 
                           name="city" value="{{ old('city') }}" required placeholder="Wellawaya">
                    @error('city')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="postal_code" class="form-label">Postal Code (Optional)</label>
                    <input id="postal_code" type="text" class="form-control @error('postal_code') is-invalid @enderror" 
                           name="postal_code" value="{{ old('postal_code') }}" placeholder="91200">
                    @error('postal_code')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                           name="password" required placeholder="Minimum 8 characters">
                    @error('password')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input id="password_confirmation" type="password" class="form-control" 
                           name="password_confirmation" required placeholder="Re-enter password">
                </div>
            </div>

            <button type="submit" class="btn" style="width: 100%;">
                Register
            </button>

            <div class="form-footer">
                Already have an account? <a href="{{ route('login') }}">Login here</a>
            </div>
        </form>
    </div>
</div>
@endsection


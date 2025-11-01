@extends('layouts.admin')

@section('page-title', 'Contact Information')

@section('content')
<div style="max-width: 1000px;">
    <div class="card">
            <div style="margin-bottom: 2rem;">
                <h2 style="color: var(--primary-gold); margin-bottom: 0.5rem;">
                    <i class="bi bi-telephone-fill"></i> Contact Information
                </h2>
                <p style="color: var(--text-secondary);">
                    Manage your business contact details, address, and location information
                </p>
            </div>

            <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="group" value="contact">

                @foreach($settings as $setting)
                    <div class="form-group">
                        <label for="setting_{{ $setting->key }}" class="form-label">
                            {{ $setting->label }}
                            @if(str_contains($setting->key, 'whatsapp'))
                                <small style="color: var(--text-secondary); font-weight: normal;">(with country code, e.g., +94771234567)</small>
                            @endif
                            @if(str_contains($setting->key, 'latitude') || str_contains($setting->key, 'longitude'))
                                <small style="color: var(--text-secondary); font-weight: normal;">(Right-click on Google Maps to get coordinates)</small>
                            @endif
                        </label>

                        @if($setting->type === 'text')
                            <input type="text" 
                                   id="setting_{{ $setting->key }}" 
                                   name="settings[{{ $setting->key }}]" 
                                   class="form-control" 
                                   value="{{ old('settings.' . $setting->key, $setting->value) }}"
                                   @if(str_contains($setting->key, 'email')) type="email" @endif>

                        @elseif($setting->type === 'textarea')
                            <textarea id="setting_{{ $setting->key }}" 
                                      name="settings[{{ $setting->key }}]" 
                                      class="form-control" 
                                      rows="3">{{ old('settings.' . $setting->key, $setting->value) }}</textarea>
                        @endif

                        @error('settings.' . $setting->key)
                            <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                        @enderror
                    </div>
                @endforeach

                <div style="display: flex; gap: 1rem; margin-top: 2rem; padding-top: 2rem; border-top: 2px solid rgba(212, 175, 55, 0.3);">
                    <button type="submit" class="btn">
                        <i class="bi bi-check-circle"></i> Update Contact Info
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn" style="background: transparent; color: var(--primary-gold);">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
</div>
@endsection


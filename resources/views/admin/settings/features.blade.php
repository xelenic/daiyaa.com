@extends('layouts.admin')

@section('page-title', 'Feature Settings')

@section('content')
<div style="max-width: 1000px;">
    <div class="card">
            <div style="margin-bottom: 2rem;">
                <h2 style="color: var(--primary-gold); margin-bottom: 0.5rem;">
                    <i class="bi bi-toggles"></i> Feature Settings
                </h2>
                <p style="color: var(--text-secondary);">
                    Enable or disable website features and functionality
                </p>
            </div>

            <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="group" value="features">

                <div style="display: grid; gap: 2rem;">
                    @foreach($settings as $setting)
                        <div style="background: rgba(212, 175, 55, 0.05); padding: 1.5rem; border-radius: 10px; border: 1px solid rgba(212, 175, 55, 0.2);">
                            <div style="display: flex; justify-content: space-between; align-items: start; gap: 2rem;">
                                <div style="flex: 1;">
                                    <label for="setting_{{ $setting->key }}" class="form-label" style="font-size: 1.1rem; margin-bottom: 0.5rem;">
                                        @if(str_contains($setting->key, 'online_ordering'))
                                            <i class="bi bi-cart-check" style="color: var(--primary-gold);"></i>
                                        @elseif(str_contains($setting->key, 'promotions'))
                                            <i class="bi bi-megaphone" style="color: var(--primary-gold);"></i>
                                        @elseif(str_contains($setting->key, 'table_reservation'))
                                            <i class="bi bi-calendar-check" style="color: var(--primary-gold);"></i>
                                        @elseif(str_contains($setting->key, 'reviews'))
                                            <i class="bi bi-star-fill" style="color: var(--primary-gold);"></i>
                                        @elseif(str_contains($setting->key, 'newsletter'))
                                            <i class="bi bi-envelope-paper" style="color: var(--primary-gold);"></i>
                                        @elseif(str_contains($setting->key, 'loyalty'))
                                            <i class="bi bi-gift" style="color: var(--primary-gold);"></i>
                                        @elseif(str_contains($setting->key, 'maintenance'))
                                            <i class="bi bi-exclamation-triangle" style="color: var(--warning);"></i>
                                        @endif
                                        {{ $setting->label }}
                                    </label>
                                    <p style="color: var(--text-secondary); font-size: 0.9rem; margin: 0;">
                                        @if(str_contains($setting->key, 'online_ordering'))
                                            Allow customers to place orders online through your website
                                        @elseif(str_contains($setting->key, 'promotions'))
                                            Display promotional popups and banners to customers
                                        @elseif(str_contains($setting->key, 'table_reservation'))
                                            Enable table reservation system for customers
                                        @elseif(str_contains($setting->key, 'reviews'))
                                            Show customer reviews and testimonials on your website
                                        @elseif(str_contains($setting->key, 'newsletter'))
                                            Display newsletter subscription forms
                                        @elseif(str_contains($setting->key, 'loyalty'))
                                            Enable customer loyalty and rewards program
                                        @elseif(str_contains($setting->key, 'maintenance'))
                                            Put website in maintenance mode (only admins can access)
                                        @endif
                                    </p>
                                </div>
                                
                                <div class="checkbox-group" style="flex-shrink: 0;">
                                    <input type="hidden" name="settings[{{ $setting->key }}]" value="0">
                                    <label class="toggle-switch" style="margin: 0;">
                                        <input type="checkbox" 
                                               id="setting_{{ $setting->key }}" 
                                               name="settings[{{ $setting->key }}]" 
                                               value="1" 
                                               {{ old('settings.' . $setting->key, $setting->value) == '1' ? 'checked' : '' }}>
                                        <span class="toggle-slider"></span>
                                    </label>
                                </div>
                            </div>

                            @if(str_contains($setting->key, 'maintenance') && old('settings.' . $setting->key, $setting->value) == '1')
                                <div style="margin-top: 1rem; padding: 0.75rem; background: rgba(255, 193, 7, 0.1); border-radius: 5px; border: 1px solid var(--warning);">
                                    <small style="color: var(--warning);">
                                        <i class="bi bi-exclamation-triangle"></i> 
                                        <strong>Warning:</strong> Your website is currently in maintenance mode. Only administrators can access it.
                                    </small>
                                </div>
                            @endif

                            @error('settings.' . $setting->key)
                                <span style="color: var(--danger); font-size: 0.875rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                            @enderror
                        </div>
                    @endforeach
                </div>

                <div style="display: flex; gap: 1rem; margin-top: 2rem; padding-top: 2rem; border-top: 2px solid rgba(212, 175, 55, 0.3);">
                    <button type="submit" class="btn">
                        <i class="bi bi-check-circle"></i> Update Features
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn" style="background: transparent; color: var(--primary-gold);">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .toggle-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #333;
        transition: .4s;
        border-radius: 34px;
    }

    .toggle-slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .toggle-slider {
        background-color: var(--primary-gold);
    }

    input:checked + .toggle-slider:before {
        transform: translateX(26px);
    }
    </style>
</div>
@endsection


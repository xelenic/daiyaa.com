@extends('layouts.admin')

@section('page-title', 'Delivery & Payment Settings')

@section('content')
<div style="max-width: 1000px;">
    <div class="card">
            <div style="margin-bottom: 2rem;">
                <h2 style="color: var(--primary-gold); margin-bottom: 0.5rem;">
                    <i class="bi bi-truck"></i> Delivery & Payment Settings
                </h2>
                <p style="color: var(--text-secondary);">
                    Configure delivery options, fees, and payment methods
                </p>
            </div>

            <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="group" value="delivery">

                @foreach($settings as $setting)
                    <div class="form-group">
                        <label for="setting_{{ $setting->key }}" class="form-label">
                            {{ $setting->label }}
                            @if(str_contains($setting->key, 'minimum') || str_contains($setting->key, 'fee') || str_contains($setting->key, 'free_above'))
                                <small style="color: var(--text-secondary); font-weight: normal;">(in {{ setting('site_currency_symbol', 'Rs') }})</small>
                            @elseif(str_contains($setting->key, 'radius'))
                                <small style="color: var(--text-secondary); font-weight: normal;">(kilometers)</small>
                            @endif
                        </label>

                        @if($setting->type === 'text')
                            <input type="text" 
                                   id="setting_{{ $setting->key }}" 
                                   name="settings[{{ $setting->key }}]" 
                                   class="form-control" 
                                   value="{{ old('settings.' . $setting->key, $setting->value) }}">

                        @elseif($setting->type === 'toggle')
                            <div class="checkbox-group">
                                <input type="hidden" name="settings[{{ $setting->key }}]" value="0">
                                <input type="checkbox" 
                                       id="setting_{{ $setting->key }}" 
                                       name="settings[{{ $setting->key }}]" 
                                       value="1" 
                                       {{ old('settings.' . $setting->key, $setting->value) == '1' ? 'checked' : '' }}>
                                <label for="setting_{{ $setting->key }}" style="margin: 0;">Enable</label>
                            </div>
                        @endif

                        @error('settings.' . $setting->key)
                            <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                        @enderror
                    </div>
                @endforeach

                <div style="display: flex; gap: 1rem; margin-top: 2rem; padding-top: 2rem; border-top: 2px solid rgba(212, 175, 55, 0.3);">
                    <button type="submit" class="btn">
                        <i class="bi bi-check-circle"></i> Update Delivery Settings
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn" style="background: transparent; color: var(--primary-gold);">
                        Cancel
                    </a>
                </div>
            </form>

            <!-- Preview -->
            <div style="margin-top: 3rem; padding-top: 2rem; border-top: 2px solid rgba(212, 175, 55, 0.3);">
                <h3 style="color: var(--primary-gold); margin-bottom: 1.5rem;">
                    <i class="bi bi-eye"></i> Customer View Preview
                </h3>
                <div style="background: rgba(212, 175, 55, 0.05); padding: 2rem; border-radius: 10px; border: 1px solid rgba(212, 175, 55, 0.2);">
                    <h4 style="color: var(--text-primary); margin-bottom: 1rem;">Delivery Information</h4>
                    <div style="display: grid; gap: 1rem; color: var(--text-secondary);">
                        <div>
                            <strong style="color: var(--primary-gold);">Minimum Order:</strong> 
                            {{ setting('site_currency_symbol', 'Rs') }}{{ setting('delivery_minimum_order', '500') }}
                        </div>
                        <div>
                            <strong style="color: var(--primary-gold);">Delivery Fee:</strong> 
                            {{ setting('site_currency_symbol', 'Rs') }}{{ setting('delivery_fee', '150') }}
                        </div>
                        <div>
                            <strong style="color: var(--primary-gold);">Free Delivery:</strong> 
                            Orders above {{ setting('site_currency_symbol', 'Rs') }}{{ setting('delivery_free_above', '2000') }}
                        </div>
                        <div>
                            <strong style="color: var(--primary-gold);">Delivery Radius:</strong> 
                            {{ setting('delivery_radius', '10') }} km
                        </div>
                        <div>
                            <strong style="color: var(--primary-gold);">Estimated Time:</strong> 
                            {{ setting('delivery_estimated_time', '30-45 minutes') }}
                        </div>
                        <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid rgba(212, 175, 55, 0.2);">
                            <strong style="color: var(--primary-gold);">Payment Methods:</strong><br>
                            @if(setting('payment_cash_on_delivery') == '1')
                                ✓ Cash on Delivery<br>
                            @endif
                            @if(setting('payment_online_enabled') == '1')
                                ✓ Online Payment
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection


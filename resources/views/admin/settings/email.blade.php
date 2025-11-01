@extends('layouts.admin')

@section('page-title', 'Email Settings')

@section('content')
<div style="max-width: 1000px;">
    <div class="card">
            <div style="margin-bottom: 2rem;">
                <h2 style="color: var(--primary-gold); margin-bottom: 0.5rem;">
                    <i class="bi bi-envelope-fill"></i> Email Settings
                </h2>
                <p style="color: var(--text-secondary);">
                    Configure email notifications and sender information
                </p>
            </div>

            <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="group" value="email">

                @foreach($settings as $setting)
                    <div class="form-group">
                        <label for="setting_{{ $setting->key }}" class="form-label">
                            {{ $setting->label }}
                        </label>

                        @if($setting->type === 'text')
                            <input type="{{ str_contains($setting->key, 'address') ? 'email' : 'text' }}" 
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
                        <i class="bi bi-check-circle"></i> Update Email Settings
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn" style="background: transparent; color: var(--primary-gold);">
                        Cancel
                    </a>
                </div>
            </form>

            <!-- Email Preview -->
            <div style="margin-top: 3rem; padding-top: 2rem; border-top: 2px solid rgba(212, 175, 55, 0.3);">
                <h3 style="color: var(--primary-gold); margin-bottom: 1rem;">
                    <i class="bi bi-eye"></i> Email Preview
                </h3>
                <div style="background: rgba(212, 175, 55, 0.05); padding: 2rem; border-radius: 10px; border: 1px solid rgba(212, 175, 55, 0.2);">
                    <div style="margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid rgba(212, 175, 55, 0.2);">
                        <strong style="color: var(--text-secondary);">From:</strong> 
                        <span style="color: var(--text-primary);">
                            {{ setting('email_from_name', 'Your Restaurant') }} 
                            &lt;{{ setting('email_from_address', 'noreply@example.com') }}&gt;
                        </span>
                    </div>
                    <div style="margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid rgba(212, 175, 55, 0.2);">
                        <strong style="color: var(--text-secondary);">To:</strong> 
                        <span style="color: var(--text-primary);">customer@example.com</span>
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <strong style="color: var(--text-secondary);">Subject:</strong> 
                        <span style="color: var(--text-primary);">Order Confirmation - {{ setting('site_name') }}</span>
                    </div>
                    <div style="color: var(--text-secondary); margin-top: 1.5rem; padding: 1rem; background: rgba(0,0,0,0.2); border-radius: 5px;">
                        Thank you for your order!<br><br>
                        Best regards,<br>
                        {{ setting('email_from_name', 'Your Restaurant') }}
                    </div>
                </div>

                <div style="margin-top: 2rem; padding: 1rem; background: rgba(23, 162, 184, 0.1); border-radius: 10px; border-left: 4px solid var(--info);">
                    <p style="color: var(--text-secondary); margin: 0;">
                        <i class="bi bi-info-circle"></i> 
                        <strong style="color: var(--info);">Email Notifications Status:</strong><br>
                        @if(setting('email_order_confirmation') == '1')
                            ✓ Customers will receive order confirmation emails<br>
                        @else
                            ✗ Customer order confirmations are disabled<br>
                        @endif
                        @if(setting('email_admin_notifications') == '1')
                            ✓ Admin will be notified at {{ setting('email_admin_address', 'admin@example.com') }}
                        @else
                            ✗ Admin notifications are disabled
                        @endif
                    </p>
                </div>
            </div>
        </div>
</div>
@endsection


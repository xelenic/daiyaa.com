@extends('layouts.admin')

@section('page-title', 'Business Hours')

@section('content')
<div style="max-width: 1000px;">
    <div class="card">
            <div style="margin-bottom: 2rem;">
                <h2 style="color: var(--primary-gold); margin-bottom: 0.5rem;">
                    <i class="bi bi-clock-fill"></i> Business Hours
                </h2>
                <p style="color: var(--text-secondary);">
                    Set your operating hours and special schedules
                </p>
            </div>

            <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="group" value="hours">

                @foreach($settings as $setting)
                    <div class="form-group">
                        <label for="setting_{{ $setting->key }}" class="form-label">
                            @if(str_contains($setting->key, 'open'))
                                <i class="bi bi-sunrise" style="color: #FDB813;"></i>
                            @elseif(str_contains($setting->key, 'close'))
                                <i class="bi bi-sunset" style="color: #FF6B35;"></i>
                            @elseif(str_contains($setting->key, 'days'))
                                <i class="bi bi-calendar-week" style="color: var(--primary-gold);"></i>
                            @else
                                <i class="bi bi-info-circle" style="color: var(--info);"></i>
                            @endif
                            {{ $setting->label }}
                        </label>

                        @if($setting->type === 'text')
                            <input type="text" 
                                   id="setting_{{ $setting->key }}" 
                                   name="settings[{{ $setting->key }}]" 
                                   class="form-control" 
                                   value="{{ old('settings.' . $setting->key, $setting->value) }}"
                                   @if(str_contains($setting->key, 'open') || str_contains($setting->key, 'close'))
                                       placeholder="e.g., 10:00 AM"
                                   @elseif(str_contains($setting->key, 'days'))
                                       placeholder="e.g., Monday - Sunday"
                                   @endif>

                        @elseif($setting->type === 'textarea')
                            <textarea id="setting_{{ $setting->key }}" 
                                      name="settings[{{ $setting->key }}]" 
                                      class="form-control" 
                                      rows="2"
                                      placeholder="e.g., Open all public holidays">{{ old('settings.' . $setting->key, $setting->value) }}</textarea>
                        @endif

                        @error('settings.' . $setting->key)
                            <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                        @enderror
                    </div>
                @endforeach

                <div style="display: flex; gap: 1rem; margin-top: 2rem; padding-top: 2rem; border-top: 2px solid rgba(212, 175, 55, 0.3);">
                    <button type="submit" class="btn">
                        <i class="bi bi-check-circle"></i> Update Business Hours
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
                <div style="background: rgba(212, 175, 55, 0.05); padding: 2rem; border-radius: 10px; border: 1px solid rgba(212, 175, 55, 0.2); text-align: center;">
                    <h4 style="color: var(--text-primary); margin-bottom: 1rem;">
                        <i class="bi bi-clock-history"></i> Opening Hours
                    </h4>
                    <div style="display: inline-block; text-align: left; color: var(--text-secondary);">
                        <div style="margin-bottom: 0.5rem;">
                            <strong style="color: var(--primary-gold);">Days:</strong> 
                            {{ setting('hours_days', 'Monday - Sunday') }}
                        </div>
                        <div style="margin-bottom: 0.5rem;">
                            <strong style="color: var(--primary-gold);">Time:</strong> 
                            {{ setting('hours_open', '10:00 AM') }} - {{ setting('hours_close', '11:00 PM') }}
                        </div>
                        @if(setting('hours_special_note'))
                            <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid rgba(212, 175, 55, 0.2); font-style: italic;">
                                <i class="bi bi-info-circle"></i> {{ setting('hours_special_note') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Tips -->
            <div style="margin-top: 2rem; padding: 1.5rem; background: rgba(23, 162, 184, 0.1); border-radius: 10px; border-left: 4px solid var(--info);">
                <h4 style="color: var(--info); margin-bottom: 1rem;">
                    <i class="bi bi-lightbulb"></i> Tips
                </h4>
                <ul style="color: var(--text-secondary); line-height: 1.8; margin: 0;">
                    <li>Use consistent time format (e.g., "10:00 AM" or "22:00")</li>
                    <li>Clearly indicate if you're open on weekends or holidays</li>
                    <li>Use the special notes field for holiday schedules or temporary changes</li>
                    <li>Keep your hours up-to-date to avoid customer confusion</li>
                </ul>
            </div>
        </div>
</div>
@endsection


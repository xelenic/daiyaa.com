@extends('layouts.admin')

@section('page-title', 'General Settings')

@section('content')
<div style="max-width: 1000px;">
    <div class="card">
            <div style="margin-bottom: 2rem;">
                <h2 style="color: var(--primary-gold); margin-bottom: 0.5rem;">
                    <i class="bi bi-house-fill"></i> General Settings
                </h2>
                <p style="color: var(--text-secondary);">
                    Configure your website's basic information, branding, and display preferences
                </p>
            </div>

            <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="group" value="general">

                @foreach($settings as $setting)
                    <div class="form-group">
                        <label for="setting_{{ $setting->key }}" class="form-label">
                            {{ $setting->label }}
                        </label>

                        @if($setting->type === 'text')
                            <input type="text" 
                                   id="setting_{{ $setting->key }}" 
                                   name="settings[{{ $setting->key }}]" 
                                   class="form-control" 
                                   value="{{ old('settings.' . $setting->key, $setting->value) }}">

                        @elseif($setting->type === 'textarea')
                            <textarea id="setting_{{ $setting->key }}" 
                                      name="settings[{{ $setting->key }}]" 
                                      class="form-control" 
                                      rows="4">{{ old('settings.' . $setting->key, $setting->value) }}</textarea>

                        @elseif($setting->type === 'select')
                            <select id="setting_{{ $setting->key }}" 
                                    name="settings[{{ $setting->key }}]" 
                                    class="form-control">
                                @if(is_array($setting->options))
                                    @foreach($setting->options as $optKey => $optValue)
                                        <option value="{{ $optKey }}" 
                                                {{ old('settings.' . $setting->key, $setting->value) == $optKey ? 'selected' : '' }}>
                                            {{ $optValue }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>

                        @elseif($setting->type === 'image')
                            @if($setting->value)
                                <div style="margin-bottom: 1rem;">
                                    <p style="color: var(--text-secondary); margin-bottom: 0.5rem;">Current Image:</p>
                                    <img src="{{ $setting->value }}" alt="{{ $setting->label }}" 
                                         style="max-width: 200px; max-height: 200px; border-radius: 10px; border: 2px solid var(--primary-gold);">
                                </div>
                            @endif
                            
                            <input type="file" 
                                   id="setting_{{ $setting->key }}" 
                                   name="settings[{{ $setting->key }}]" 
                                   class="form-control" 
                                   accept="image/jpeg,image/png,image/jpg,image/webp">
                            <small style="color: var(--text-secondary); display: block; margin-top: 0.5rem;">
                                Accepted formats: JPG, PNG, WEBP (Max: 2MB)
                            </small>
                        @endif

                        @error('settings.' . $setting->key)
                            <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                        @enderror
                    </div>
                @endforeach

                <div style="display: flex; gap: 1rem; margin-top: 2rem; padding-top: 2rem; border-top: 2px solid rgba(212, 175, 55, 0.3);">
                    <button type="submit" class="btn">
                        <i class="bi bi-check-circle"></i> Update Settings
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn" style="background: transparent; color: var(--primary-gold);">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
</div>
@endsection


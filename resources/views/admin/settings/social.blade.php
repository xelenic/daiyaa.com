@extends('layouts.admin')

@section('page-title', 'Social Media Settings')

@section('content')
<div style="max-width: 1000px;">
    <div class="card">
            <div style="margin-bottom: 2rem;">
                <h2 style="color: var(--primary-gold); margin-bottom: 0.5rem;">
                    <i class="bi bi-share-fill"></i> Social Media Settings
                </h2>
                <p style="color: var(--text-secondary);">
                    Connect your social media profiles. Only filled URLs will appear on your website.
                </p>
            </div>

            <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="group" value="social">

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                    @foreach($settings as $setting)
                        <div class="form-group">
                            <label for="setting_{{ $setting->key }}" class="form-label">
                                @if(str_contains($setting->key, 'facebook'))
                                    <i class="bi bi-facebook" style="color: #1877F2;"></i>
                                @elseif(str_contains($setting->key, 'instagram'))
                                    <i class="bi bi-instagram" style="color: #E4405F;"></i>
                                @elseif(str_contains($setting->key, 'twitter'))
                                    <i class="bi bi-twitter-x" style="color: #000;"></i>
                                @elseif(str_contains($setting->key, 'youtube'))
                                    <i class="bi bi-youtube" style="color: #FF0000;"></i>
                                @elseif(str_contains($setting->key, 'tiktok'))
                                    <i class="bi bi-tiktok" style="color: #000;"></i>
                                @elseif(str_contains($setting->key, 'linkedin'))
                                    <i class="bi bi-linkedin" style="color: #0A66C2;"></i>
                                @elseif(str_contains($setting->key, 'pinterest'))
                                    <i class="bi bi-pinterest" style="color: #E60023;"></i>
                                @elseif(str_contains($setting->key, 'telegram'))
                                    <i class="bi bi-telegram" style="color: #0088cc;"></i>
                                @elseif(str_contains($setting->key, 'snapchat'))
                                    <i class="bi bi-snapchat" style="color: #FFFC00;"></i>
                                @elseif(str_contains($setting->key, 'tripadvisor'))
                                    <i class="bi bi-star-fill" style="color: #00AF87;"></i>
                                @elseif(str_contains($setting->key, 'yelp'))
                                    <i class="bi bi-yelp" style="color: #FF1A1A;"></i>
                                @endif
                                {{ $setting->label }}
                            </label>

                            <input type="url" 
                                   id="setting_{{ $setting->key }}" 
                                   name="settings[{{ $setting->key }}]" 
                                   class="form-control" 
                                   value="{{ old('settings.' . $setting->key, $setting->value) }}"
                                   placeholder="https://...">

                            @error('settings.' . $setting->key)
                                <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                            @enderror
                        </div>
                    @endforeach
                </div>

                <div style="display: flex; gap: 1rem; margin-top: 2rem; padding-top: 2rem; border-top: 2px solid rgba(212, 175, 55, 0.3);">
                    <button type="submit" class="btn">
                        <i class="bi bi-check-circle"></i> Update Social Media
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn" style="background: transparent; color: var(--primary-gold);">
                        Cancel
                    </a>
                </div>
            </form>

            <!-- Preview Section -->
            <div style="margin-top: 3rem; padding-top: 2rem; border-top: 2px solid rgba(212, 175, 55, 0.3);">
                <h3 style="color: var(--primary-gold); margin-bottom: 1rem;">
                    <i class="bi bi-eye"></i> Live Preview
                </h3>
                <p style="color: var(--text-secondary); margin-bottom: 1.5rem;">
                    This is how your social links will appear on your website:
                </p>
                <x-social-links iconSize="2rem" />
            </div>
        </div>
</div>
@endsection


@extends('layouts.admin')

@section('page-title', 'SEO Settings')

@section('content')
<div style="max-width: 1000px;">
    <div class="card">
            <div style="margin-bottom: 2rem;">
                <h2 style="color: var(--primary-gold); margin-bottom: 0.5rem;">
                    <i class="bi bi-search"></i> SEO Settings
                </h2>
                <p style="color: var(--text-secondary);">
                    Optimize your website for search engines and track visitor analytics
                </p>
            </div>

            <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="group" value="seo">

                @foreach($settings as $setting)
                    <div class="form-group">
                        <label for="setting_{{ $setting->key }}" class="form-label">
                            {{ $setting->label }}
                            @if(str_contains($setting->key, 'google_analytics'))
                                <small style="color: var(--text-secondary); font-weight: normal;">(e.g., G-XXXXXXXXXX)</small>
                            @elseif(str_contains($setting->key, 'tag_manager'))
                                <small style="color: var(--text-secondary); font-weight: normal;">(e.g., GTM-XXXXXXX)</small>
                            @elseif(str_contains($setting->key, 'facebook_pixel'))
                                <small style="color: var(--text-secondary); font-weight: normal;">(Numeric ID)</small>
                            @endif
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
                                      rows="3">{{ old('settings.' . $setting->key, $setting->value) }}</textarea>
                            @if(str_contains($setting->key, 'description'))
                                <small style="color: var(--text-secondary); display: block; margin-top: 0.5rem;">
                                    Recommended: 150-160 characters
                                </small>
                            @elseif(str_contains($setting->key, 'keywords'))
                                <small style="color: var(--text-secondary); display: block; margin-top: 0.5rem;">
                                    Separate keywords with commas
                                </small>
                            @endif

                        @elseif($setting->type === 'image')
                            @if($setting->value)
                                <div style="margin-bottom: 1rem;">
                                    <p style="color: var(--text-secondary); margin-bottom: 0.5rem;">Current Image:</p>
                                    <img src="{{ $setting->value }}" alt="{{ $setting->label }}" 
                                         style="max-width: 400px; max-height: 200px; border-radius: 10px; border: 2px solid var(--primary-gold);">
                                </div>
                            @endif
                            
                            <input type="file" 
                                   id="setting_{{ $setting->key }}" 
                                   name="settings[{{ $setting->key }}]" 
                                   class="form-control" 
                                   accept="image/jpeg,image/png,image/jpg,image/webp">
                            <small style="color: var(--text-secondary); display: block; margin-top: 0.5rem;">
                                Recommended: 1200x630px for optimal social media display
                            </small>
                        @endif

                        @error('settings.' . $setting->key)
                            <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                        @enderror
                    </div>
                @endforeach

                <div style="display: flex; gap: 1rem; margin-top: 2rem; padding-top: 2rem; border-top: 2px solid rgba(212, 175, 55, 0.3);">
                    <button type="submit" class="btn">
                        <i class="bi bi-check-circle"></i> Update SEO Settings
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn" style="background: transparent; color: var(--primary-gold);">
                        Cancel
                    </a>
                </div>
            </form>

            <!-- SEO Tips -->
            <div style="margin-top: 3rem; padding: 1.5rem; background: rgba(212, 175, 55, 0.1); border-radius: 10px; border-left: 4px solid var(--primary-gold);">
                <h4 style="color: var(--primary-gold); margin-bottom: 1rem;">
                    <i class="bi bi-lightbulb"></i> SEO Tips
                </h4>
                <ul style="color: var(--text-secondary); line-height: 1.8;">
                    <li>Keep meta titles under 60 characters for best display in search results</li>
                    <li>Meta descriptions should be 150-160 characters to avoid truncation</li>
                    <li>Use relevant keywords naturally in your content</li>
                    <li>Upload a high-quality OG image (1200x630px) for better social media sharing</li>
                    <li>Google Analytics helps you understand your visitors and improve your site</li>
                </ul>
            </div>
        </div>
</div>
@endsection


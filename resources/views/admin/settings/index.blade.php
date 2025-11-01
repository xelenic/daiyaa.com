@extends('layouts.admin')

@section('page-title', 'Website Settings')

@section('styles')
<style>
    .tabs-container {
        margin-bottom: 2rem;
    }

    .tabs {
        display: flex;
        gap: 0.5rem;
        border-bottom: 2px solid rgba(212, 175, 55, 0.2);
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .tab {
        padding: 1rem 1.5rem;
        background: transparent;
        color: var(--text-secondary);
        border: none;
        cursor: pointer;
        font-size: 1rem;
        font-weight: 500;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .tab:hover {
        color: var(--primary-gold);
        background: rgba(212, 175, 55, 0.1);
    }

    .tab.active {
        color: var(--primary-gold);
        border-bottom-color: var(--primary-gold);
        background: rgba(212, 175, 55, 0.1);
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
        animation: fadeIn 0.3s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .tabs {
            flex-direction: column;
            gap: 0;
        }

        .tab {
            border-bottom: 1px solid rgba(212, 175, 55, 0.1);
            border-left: 3px solid transparent;
        }

        .tab.active {
            border-bottom-color: rgba(212, 175, 55, 0.1);
            border-left-color: var(--primary-gold);
        }
    }
</style>
@endsection

@section('content')
<div style="max-width: 1000px;">
    <h2 style="color: var(--primary-gold); margin-bottom: 2rem;">Website Settings</h2>

    <div class="card">
        <!-- Tabs Navigation -->
        <div class="tabs-container">
            <div class="tabs">
                @foreach($settings as $group => $groupSettings)
                    <button type="button" 
                            class="tab {{ $loop->first ? 'active' : '' }}" 
                            onclick="switchTab('{{ $group }}')">
                        @if($group === 'general')
                            <i class="bi bi-house-fill"></i>
                        @elseif($group === 'contact')
                            <i class="bi bi-telephone-fill"></i>
                        @elseif($group === 'hours')
                            <i class="bi bi-clock-fill"></i>
                        @elseif($group === 'social')
                            <i class="bi bi-share-fill"></i>
                        @elseif($group === 'seo')
                            <i class="bi bi-search"></i>
                        @elseif($group === 'delivery')
                            <i class="bi bi-truck"></i>
                        @elseif($group === 'email')
                            <i class="bi bi-envelope-fill"></i>
                        @elseif($group === 'features')
                            <i class="bi bi-toggles"></i>
                        @else
                            <i class="bi bi-gear-fill"></i>
                        @endif
                        {{ ucfirst($group) }}
                    </button>
                @endforeach
            </div>
        </div>

        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @foreach($settings as $group => $groupSettings)
                <div class="tab-content {{ $loop->first ? 'active' : '' }}" id="tab-{{ $group }}">
                    @foreach($groupSettings as $setting)
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

@section('scripts')
<script>
    function switchTab(tabName) {
        // Hide all tab contents
        const tabContents = document.querySelectorAll('.tab-content');
        tabContents.forEach(content => {
            content.classList.remove('active');
        });

        // Remove active class from all tabs
        const tabs = document.querySelectorAll('.tab');
        tabs.forEach(tab => {
            tab.classList.remove('active');
        });

        // Show selected tab content
        const selectedContent = document.getElementById('tab-' + tabName);
        if (selectedContent) {
            selectedContent.classList.add('active');
        }

        // Add active class to clicked tab
        event.target.closest('.tab').classList.add('active');

        // Save active tab to localStorage
        localStorage.setItem('activeSettingsTab', tabName);
    }

    // Restore last active tab on page load
    document.addEventListener('DOMContentLoaded', function() {
        const lastActiveTab = localStorage.getItem('activeSettingsTab');
        if (lastActiveTab) {
            const tabButton = document.querySelector(`[onclick="switchTab('${lastActiveTab}')"]`);
            if (tabButton) {
                tabButton.click();
            }
        }
    });
</script>
@endsection


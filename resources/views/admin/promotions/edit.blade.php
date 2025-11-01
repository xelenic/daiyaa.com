@extends('layouts.admin')

@section('page-title', 'Edit Promotion')

@section('content')
<div style="max-width: 800px;">
    <h2 style="color: var(--primary-gold); margin-bottom: 2rem;">Edit Promotion</h2>

    <div class="card">
        <form method="POST" action="{{ route('admin.promotions.update', $promotion) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title" class="form-label">Promotion Title *</label>
                <input type="text" id="title" name="title" class="form-control" 
                       value="{{ old('title', $promotion->title) }}" required>
                @error('title')
                    <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control">{{ old('description', $promotion->description) }}</textarea>
                @error('description')
                    <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image" class="form-label">Promotion Image</label>
                
                @if($promotion->image_url)
                    <div style="margin-bottom: 1rem;">
                        <p style="color: var(--text-secondary); margin-bottom: 0.5rem;">Current Image:</p>
                        <img src="{{ $promotion->image_url }}" alt="{{ $promotion->title }}" 
                             style="max-width: 400px; max-height: 400px; border-radius: 10px; border: 2px solid var(--primary-gold);">
                    </div>
                @endif
                
                <input type="file" id="image" name="image" class="form-control" 
                       accept="image/jpeg,image/png,image/jpg,image/webp" onchange="previewImage(event)">
                <small style="color: var(--text-secondary); display: block; margin-top: 0.5rem;">
                    Upload a new image to replace the current one. Accepted formats: JPG, PNG, WEBP (Max: 2MB)
                </small>
                @error('image')
                    <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                @enderror
                
                <!-- Image Preview -->
                <div id="imagePreview" style="margin-top: 1rem; display: none;">
                    <p style="color: var(--text-secondary); margin-bottom: 0.5rem;">New Image Preview:</p>
                    <img id="preview" src="" alt="Preview" 
                         style="max-width: 400px; max-height: 400px; border-radius: 10px; border: 2px solid var(--primary-gold);">
                </div>
            </div>

            <div class="form-group">
                <label for="image_url" class="form-label">Or Image URL (Optional)</label>
                <input type="url" id="image_url" name="image_url" class="form-control" 
                       value="{{ old('image_url', $promotion->image_url) }}">
                <small style="color: var(--text-secondary); display: block; margin-top: 0.5rem;">
                    Use this if you prefer to link to an external image instead of uploading
                </small>
                @error('image_url')
                    <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="start_date" class="form-label">Start Date (Optional)</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" 
                           value="{{ old('start_date', $promotion->start_date?->format('Y-m-d')) }}">
                    @error('start_date')
                        <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="end_date" class="form-label">End Date (Optional)</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" 
                           value="{{ old('end_date', $promotion->end_date?->format('Y-m-d')) }}">
                    @error('end_date')
                        <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="sort_order" class="form-label">Sort Order</label>
                <input type="number" id="sort_order" name="sort_order" class="form-control" 
                       value="{{ old('sort_order', $promotion->sort_order) }}" min="0">
                <small style="color: var(--text-secondary); display: block; margin-top: 0.5rem;">
                    Lower numbers appear first in the modal
                </small>
                @error('sort_order')
                    <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <div class="checkbox-group">
                    <input type="checkbox" id="is_active" name="is_active" value="1" 
                           {{ old('is_active', $promotion->is_active) ? 'checked' : '' }}>
                    <label for="is_active" style="margin: 0;">Active (Show in modal)</label>
                </div>
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <button type="submit" class="btn">
                    <i class="bi bi-check-circle"></i> Update Promotion
                </button>
                <a href="{{ route('admin.promotions.index') }}" class="btn" style="background: transparent; color: var(--primary-gold);">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview');
        const previewContainer = document.getElementById('imagePreview');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
        }
    }
</script>
@endsection


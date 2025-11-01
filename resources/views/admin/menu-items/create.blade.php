@extends('layouts.admin')

@section('page-title', 'Add Menu Item')

@section('content')
<div style="max-width: 800px;">
    <h2 style="color: var(--primary-gold); margin-bottom: 2rem;">Add New Menu Item</h2>

    <div class="card">
        <form method="POST" action="{{ route('admin.menu-items.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="category_id" class="form-label">Category *</label>
                <select id="category_id" name="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name" class="form-label">Name *</label>
                <input type="text" id="name" name="name" class="form-control" 
                       value="{{ old('name') }}" required placeholder="e.g., Rice & Curry">
                @error('name')
                    <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" 
                          placeholder="Describe your dish">{{ old('description') }}</textarea>
                @error('description')
                    <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="price" class="form-label">Price (Rs.) *</label>
                <input type="number" id="price" name="price" class="form-control" 
                       value="{{ old('price') }}" required step="0.01" min="0" placeholder="850.00">
                @error('price')
                    <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image" class="form-label">Food Image</label>
                <input type="file" id="image" name="image" class="form-control" 
                       accept="image/jpeg,image/png,image/jpg,image/webp" onchange="previewImage(event)">
                <small style="color: var(--text-secondary); display: block; margin-top: 0.5rem;">
                    Accepted formats: JPG, PNG, WEBP (Max: 2MB)
                </small>
                @error('image')
                    <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                @enderror
                
                <!-- Image Preview -->
                <div id="imagePreview" style="margin-top: 1rem; display: none;">
                    <img id="preview" src="" alt="Preview" 
                         style="max-width: 300px; max-height: 300px; border-radius: 10px; border: 2px solid var(--primary-gold);">
                </div>
            </div>

            <div class="form-group">
                <label for="image_url" class="form-label">Or Image URL (Optional)</label>
                <input type="url" id="image_url" name="image_url" class="form-control" 
                       value="{{ old('image_url') }}" placeholder="https://example.com/image.jpg">
                <small style="color: var(--text-secondary); display: block; margin-top: 0.5rem;">
                    Use this if you prefer to link to an external image instead of uploading
                </small>
                @error('image_url')
                    <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="sort_order" class="form-label">Sort Order</label>
                <input type="number" id="sort_order" name="sort_order" class="form-control" 
                       value="{{ old('sort_order', 0) }}" min="0" placeholder="0">
                @error('sort_order')
                    <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <div class="checkbox-group">
                    <input type="checkbox" id="is_available" name="is_available" value="1" 
                           {{ old('is_available', true) ? 'checked' : '' }}>
                    <label for="is_available" style="margin: 0;">Available for ordering</label>
                </div>
            </div>

            <div class="form-group">
                <div class="checkbox-group">
                    <input type="checkbox" id="is_featured" name="is_featured" value="1" 
                           {{ old('is_featured') ? 'checked' : '' }}>
                    <label for="is_featured" style="margin: 0;">Featured item</label>
                </div>
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <button type="submit" class="btn">
                    <i class="bi bi-check-circle"></i> Create Item
                </button>
                <a href="{{ route('admin.menu-items.index') }}" class="btn" style="background: transparent; color: var(--primary-gold);">
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


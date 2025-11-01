@extends('layouts.admin')

@section('page-title', 'Add Menu Item')

@section('content')
<div style="max-width: 800px;">
    <h2 style="color: var(--primary-gold); margin-bottom: 2rem;">Add New Menu Item</h2>

    <div class="card">
        <form method="POST" action="{{ route('admin.menu-items.store') }}">
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
                <label for="image_url" class="form-label">Image URL</label>
                <input type="url" id="image_url" name="image_url" class="form-control" 
                       value="{{ old('image_url') }}" placeholder="https://example.com/image.jpg">
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


@extends('layouts.admin')

@section('page-title', 'Edit Delivery Zone')

@section('content')
<div style="max-width: 800px;">
    <div class="card">
        <div style="margin-bottom: 2rem;">
            <h2 style="color: var(--primary-gold); margin-bottom: 0.5rem;">
                <i class="bi bi-pencil"></i> Edit Delivery Zone
            </h2>
            <p style="color: var(--text-secondary);">
                Update delivery zone settings
            </p>
        </div>

        <form method="POST" action="{{ route('admin.delivery-zones.update', $deliveryZone) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="form-label">
                    <i class="bi bi-tag" style="color: var(--primary-gold);"></i> Zone Name
                </label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       class="form-control" 
                       value="{{ old('name', $deliveryZone->name) }}"
                       placeholder="e.g., Kathmandu Central"
                       required>
                @error('name')
                    <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="cities" class="form-label">
                    <i class="bi bi-buildings" style="color: var(--primary-gold);"></i> Cities/Areas (comma-separated)
                </label>
                <input type="text" 
                       id="cities" 
                       name="cities" 
                       class="form-control" 
                       value="{{ old('cities', $deliveryZone->cities) }}"
                       placeholder="e.g., Kathmandu, Thamel, New Road">
                <small style="color: var(--text-secondary);">Enter city names or area names separated by commas</small>
                @error('cities')
                    <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="postal_codes" class="form-label">
                    <i class="bi bi-mailbox" style="color: var(--primary-gold);"></i> Postal Codes (comma-separated, optional)
                </label>
                <input type="text" 
                       id="postal_codes" 
                       name="postal_codes" 
                       class="form-control" 
                       value="{{ old('postal_codes', $deliveryZone->postal_codes) }}"
                       placeholder="e.g., 44600, 44601, 44602">
                <small style="color: var(--text-secondary);">Enter postal codes separated by commas</small>
                @error('postal_codes')
                    <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="delivery_fee" class="form-label">
                        <i class="bi bi-cash-coin" style="color: var(--primary-gold);"></i> Delivery Fee (Rs)
                    </label>
                    <input type="number" 
                           id="delivery_fee" 
                           name="delivery_fee" 
                           class="form-control" 
                           value="{{ old('delivery_fee', $deliveryZone->delivery_fee) }}"
                           step="0.01"
                           min="0"
                           required>
                    @error('delivery_fee')
                        <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="min_order_amount" class="form-label">
                        <i class="bi bi-cart-check" style="color: var(--primary-gold);"></i> Min Order for FREE Delivery (Rs)
                    </label>
                    <input type="number" 
                           id="min_order_amount" 
                           name="min_order_amount" 
                           class="form-control" 
                           value="{{ old('min_order_amount', $deliveryZone->min_order_amount) }}"
                           min="0"
                           required>
                    <small style="color: var(--text-secondary);">Set to 0 to always charge delivery</small>
                    @error('min_order_amount')
                        <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="estimated_time" class="form-label">
                        <i class="bi bi-clock" style="color: var(--primary-gold);"></i> Estimated Delivery Time (minutes)
                    </label>
                    <input type="number" 
                           id="estimated_time" 
                           name="estimated_time" 
                           class="form-control" 
                           value="{{ old('estimated_time', $deliveryZone->estimated_time) }}"
                           min="1"
                           required>
                    @error('estimated_time')
                        <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sort_order" class="form-label">
                        <i class="bi bi-sort-numeric-down" style="color: var(--primary-gold);"></i> Sort Order
                    </label>
                    <input type="number" 
                           id="sort_order" 
                           name="sort_order" 
                           class="form-control" 
                           value="{{ old('sort_order', $deliveryZone->sort_order) }}"
                           min="0">
                    <small style="color: var(--text-secondary);">Lower numbers appear first</small>
                    @error('sort_order')
                        <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-checkbox">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $deliveryZone->is_active) ? 'checked' : '' }}>
                    <span><i class="bi bi-check-circle" style="color: var(--success);"></i> Active (Zone is available for delivery)</span>
                </label>
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 2rem; padding-top: 2rem; border-top: 2px solid rgba(212, 175, 55, 0.3);">
                <button type="submit" class="btn">
                    <i class="bi bi-check-circle"></i> Update Delivery Zone
                </button>
                <a href="{{ route('admin.delivery-zones.index') }}" class="btn" style="background: transparent; color: var(--primary-gold);">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection



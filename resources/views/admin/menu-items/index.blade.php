@extends('layouts.admin')

@section('page-title', 'Menu Items')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2 style="color: var(--primary-gold);">Menu Items</h2>
    <a href="{{ route('admin.menu-items.create') }}" class="btn">
        <i class="bi bi-plus-circle"></i> Add New Item
    </a>
</div>

<div class="card">
    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($menuItems as $item)
                <tr>
                    <td>
                        @if($item->image_url)
                            <img src="{{ $item->image_path }}" alt="{{ $item->name }}" 
                                 style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid rgba(212, 175, 55, 0.2);"
                                 onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div style="width: 60px; height: 60px; background: var(--darker-bg); border-radius: 8px; display: none; align-items: center; justify-content: center; border: 1px solid rgba(212, 175, 55, 0.2);">
                                <i class="bi bi-image-fill" style="color: var(--text-secondary);"></i>
                            </div>
                        @else
                            <div style="width: 60px; height: 60px; background: var(--darker-bg); border-radius: 8px; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(212, 175, 55, 0.2);">
                                <i class="bi bi-image-fill" style="color: var(--text-secondary);"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $item->name }}</strong><br>
                        <small style="color: var(--text-secondary);">{{ Str::limit($item->description, 50) }}</small>
                    </td>
                    <td>{{ $item->category->name }}</td>
                    <td style="color: var(--primary-gold); font-weight: 600;">Rs. {{ number_format($item->price, 2) }}</td>
                    <td>
                        @if($item->is_available)
                            <span style="color: var(--success);">✓ Available</span>
                        @else
                            <span style="color: var(--danger);">✗ Unavailable</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.menu-items.edit', $item) }}" class="btn btn-sm">Edit</a>
                        <form action="{{ route('admin.menu-items.destroy', $item) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" 
                                    onclick="return confirm('Are you sure you want to delete this item?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: var(--text-secondary); padding: 2rem;">
                        No menu items found. <a href="{{ route('admin.menu-items.create') }}" style="color: var(--primary-gold);">Add your first item</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($menuItems->hasPages())
        <div style="padding: 1rem; border-top: 1px solid rgba(212, 175, 55, 0.1);">
            {{ $menuItems->links() }}
        </div>
    @endif
</div>
@endsection


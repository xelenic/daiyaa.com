@extends('layouts.admin')

@section('page-title', 'Promotions')

@section('content')
<div style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center;">
    <h2 style="color: var(--primary-gold);">Special Offers & Promotions</h2>
    <a href="{{ route('admin.promotions.create') }}" class="btn">
        <i class="bi bi-plus-circle"></i> Add Promotion
    </a>
</div>

<div class="card">
    @if($promotions->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th>Sort</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($promotions as $promotion)
                    <tr>
                        <td>
                            @if($promotion->image_url)
                                <img src="{{ $promotion->image_url }}" alt="{{ $promotion->title }}" 
                                     style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                            @else
                                <div style="width: 80px; height: 80px; background: var(--darker-bg); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-image" style="font-size: 2rem; color: var(--text-secondary);"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $promotion->title }}</strong>
                        </td>
                        <td style="max-width: 300px;">
                            {{ Str::limit($promotion->description, 100) }}
                        </td>
                        <td>
                            @if($promotion->start_date || $promotion->end_date)
                                <small>
                                    @if($promotion->start_date)
                                        From: {{ $promotion->start_date->format('M d, Y') }}<br>
                                    @endif
                                    @if($promotion->end_date)
                                        To: {{ $promotion->end_date->format('M d, Y') }}
                                    @endif
                                </small>
                            @else
                                <small style="color: var(--text-secondary);">No expiry</small>
                            @endif
                        </td>
                        <td>
                            @if($promotion->is_active)
                                <span style="color: var(--success); display: flex; align-items: center; gap: 0.5rem;">
                                    <i class="bi bi-check-circle-fill"></i> Active
                                </span>
                            @else
                                <span style="color: var(--text-secondary); display: flex; align-items: center; gap: 0.5rem;">
                                    <i class="bi bi-x-circle"></i> Inactive
                                </span>
                            @endif
                        </td>
                        <td>{{ $promotion->sort_order }}</td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="{{ route('admin.promotions.edit', $promotion) }}" class="btn btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.promotions.destroy', $promotion) }}" method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this promotion?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 2rem;">
            {{ $promotions->links() }}
        </div>
    @else
        <div style="text-align: center; padding: 3rem; color: var(--text-secondary);">
            <i class="bi bi-gift" style="font-size: 4rem; margin-bottom: 1rem; display: block;"></i>
            <p>No promotions yet. Create your first special offer!</p>
            <a href="{{ route('admin.promotions.create') }}" class="btn" style="margin-top: 1rem;">
                <i class="bi bi-plus-circle"></i> Add Promotion
            </a>
        </div>
    @endif
</div>
@endsection


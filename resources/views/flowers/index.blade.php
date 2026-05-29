@extends('layouts.app')

@section('title', 'All Flowers')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-flower-tulip text-success"></i> Flower Collection</h1>
</div>

<div class="row">
    @forelse($flowers as $flower)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                @if($flower->image)
                    <img src="{{ asset('storage/' . $flower->image) }}" class="card-img-top" 
                         style="height: 200px; object-fit: cover;" alt="{{ $flower->name }}">
                @else
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                         style="height: 200px;">
                        <i class="fas fa-flower-tulip fa-3x text-muted"></i>
                    </div>
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $flower->name }}</h5>
                    <p class="card-text flex-grow-1">{{ Str::limit($flower->description, 100) }}</p>
                    <div class="mb-2">
                        <span class="badge bg-primary fs-6">${{ number_format($flower->price, 2) }}</span>
                        <span class="badge {{ $flower->stock > 0 ? 'bg-success' : 'bg-danger' }} ms-2">
                            {{ $flower->stock }} in stock
                        </span>
                    </div>
                    <div class="mt-auto">
                        <a href="{{ route('flowers.show', $flower) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('flowers.edit', $flower) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form method="POST" action="{{ route('flowers.destroy', $flower) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" 
                                    onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="fas fa-flower-tulip fa-5x text-muted mb-4"></i>
                <h3>No flowers available</h3>
                <a href="{{ route('flowers.create') }}" class="btn btn-success btn-lg">
                    Add your first flower
                </a>
            </div>
        </div>
    @endforelse
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $flowers->links() }}
</div>
@endsection
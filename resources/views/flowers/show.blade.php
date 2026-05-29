@extends('layouts.app')

@section('title', $flower->name)

@section('content')
<div class="row">
    
    <!-- Image Section -->
    <div class="col-md-6">
        <div class="card shadow-sm">
            @if($flower->image)
                <img src="{{ asset('storage/' . $flower->image) }}" 
                     class="card-img-top" 
                     style="height: 400px; object-fit: cover;" 
                     alt="{{ $flower->name }}">
            @else
                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                     style="height: 400px;">
                    <i class="fas fa-flower-tulip fa-5x text-muted"></i>
                </div>
            @endif
        </div>
    </div>

    <!-- Details Section -->
    <div class="col-md-6">
        <div class="card shadow-sm p-4">
            <h2>{{ $flower->name }}</h2>
            <hr>

            <h5>Description:</h5>
            <p>
                {{ $flower->description ?? 'No description available.' }}
            </p>
        </div>
    </div>

</div>
@endsection
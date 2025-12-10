@extends('layouts.app')

@section('content')
{{-- BEDANYA DENGAN ADMIN GA ADA TOMBOL DELETE DAN EDIT --}}
<div class="container my-4">
    <h4 class="mb-3">{{ $book->title }}</h4>

    <!-- Include Alert Messages -->
    @include('layouts.alert')

    <div class="row">
        <!-- Image card -->
        <div class="col-md-4 mb-3">
            <div class="card">
                @if ($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}" class="card-img-top img-fluid" alt="Cover Image">
                @else
                    <img src="https://via.placeholder.com/400x600?text=No+Cover" class="card-img-top img-fluid" alt="No Cover">
                @endif
                <div class="card-body">
                    <p class="card-text text-muted mb-0">Cover Image</p>
                </div>
            </div>
        </div>

        <!-- Details -->
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->title }}</h5>

                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item"><strong>Author:</strong> {{ $book->author ?? '-' }}</li>
                        <li class="list-group-item">
                            <strong>Published:</strong>
                            {{ $book->published_year ? \Carbon\Carbon::parse($book->published_year)->format('d-m-Y') : '-' }}
                        </li>
                        <li class="list-group-item"><strong>ISBN:</strong> {{ $book->isbn ?? '-' }}</li>
                        <li class="list-group-item"><strong>Category:</strong> {{ $book->category->name ?? '-' }}</li>
                    </ul>

                    <div class="mb-3">
                        <strong>Description</strong>
                        <p class="mt-2">{{ $book->description ?? '-' }}</p>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('books.index') }}" class="btn btn-sm btn-secondary">Back</a>
                    </div>
                </div>
            </div>

            <!-- optional metadata -->
            <div class="text-muted small">
                <span>Created: {{ $book->created_at ? \Carbon\Carbon::parse($book->created_at)->diffForHumans() : '-' }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
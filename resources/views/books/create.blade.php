@extends('layouts.app')

@section('content')
<h4>Create Book</h4>
<div class="container mt-5 mb-5">
    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="title">Title</label>
            <input
                type="text"
                name="title"
                id="title"
                class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title') }}"
            >
            @error('title')
                <div class="invalid-feedback d-block mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="author">Author</label>
            <input
                type="text"
                name="author"
                id="author"
                class="form-control @error('author') is-invalid @enderror"
                value="{{ old('author') }}"
            >
            @error('author')
                <div class="invalid-feedback d-block mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="published_date">Published Date</label>
            <input
                type="date"
                name="published_date"
                id="published_date"
                class="form-control @error('published_date') is-invalid @enderror"
                value="{{ old('published_date') }}"
            >
            @error('published_date')
                <div class="invalid-feedback d-block mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="isbn">ISBN</label>
            <input
                type="text"
                name="isbn"
                id="isbn"
                class="form-control @error('isbn') is-invalid @enderror"
                value="{{ old('isbn') }}"
            >
            @error('isbn')
                <div class="invalid-feedback d-block mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea
                name="description"
                id="description"
                class="form-control @error('description') is-invalid @enderror"
                rows="4"
            >{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback d-block mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="cover_image">Cover Image</label>
            <input
                type="file"
                name="cover_image"
                id="cover_image"
                class="form-control @error('cover_image') is-invalid @enderror"
            >
            @error('cover_image')
                <div class="invalid-feedback d-block mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="category_id">Category</label>
            <select
                name="category_id"
                id="category_id"
                class="form-select @error('category_id') is-invalid @enderror"
                required
            >
                <option value="">-- Select Category --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback d-block mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-md btn-primary me-3">Save</button>
        <button type="reset" class="btn btn-md btn-secondary">Reset</button>
    </form>
</div>
@endsection
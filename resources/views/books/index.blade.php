@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h4 class="mb-3">Books</h4>
    <!-- Include Alert Messages -->
    @include('layouts.alert')

    <a href="{{ route('books.create') }}" class="btn btn-sm btn-primary mb-3">Add Book</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Published Date</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->published_date ? \Carbon\Carbon::parse($book->published_date)->format('d-m-Y') : '-' }}</td>
                <td>
                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah anda yakin ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
                                    <div class="alert alert-info">
                                        data masih kosong.
                                    </div>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
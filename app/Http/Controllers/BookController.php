<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('category')->get();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_date' => 'nullable|date',
            'isbn' => 'required|string|unique:books,isbn|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        try {
            if ($request->hasFile('cover_image')) {
                $validated['cover_image'] = $request->file('cover_image')->store('cover_images', 'public');
            }

            Book::create($validated);

            return redirect()->route('books.index')->with('success', 'Book created successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to create book: ' . $e->getMessage());
            return redirect()->route('books.create')->with('error', 'Failed to create book. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        try {
            return view('books.show', compact('book'));
        } catch (\Exception $e) {
            Log::error('Failed to retrieve book: ' . $e->getMessage());
            return redirect()->route('books.index')->with('error', 'Failed to retrieve book. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_date' => 'nullable|date',
            'isbn' => 'required|string|unique:books,isbn,' . $book->id . '|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        try {
            if ($request->hasFile('cover_image')) {
                // Delete the old cover image if it exists
                if ($book->cover_image) {
                    Storage::disk('public')->delete($book->cover_image);
                }
                $validated['cover_image'] = $request->file('cover_image')->store('cover_images', 'public');
            }

            $book->update($validated);

            return redirect()->route('books.index')->with('success', 'Book updated successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to update book: ' . $e->getMessage());
            return redirect()->route('books.edit', $book->id)->with('error', 'Failed to update book. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        try {
            // Delete the cover image if it exists
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }

            $book->delete();

            return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete book: ' . $e->getMessage());
            return redirect()->route('books.index')->with('error', 'Failed to delete book. Please try again.');
        }
    }

    // UNTUK HANDLE WELCOME PAGE DENGAN SEARCH

    public function welcome(Request $request)
    {
        try {
            $search = $request->input('search');
            $books = Book::when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%");
            })->get();

            return view('welcome', compact('books', 'search'));
        } catch (\Exception $e) {
            Log::error('Failed to load welcome page: ' . $e->getMessage());
            return redirect()->route('books.index')->with('error', 'Failed to load books. Please try again.');
        }
    }

    public function showUser($id)
    {
        $book = Book::with('category')->findOrFail($id);
        return view('books.showuser', compact('book'));
    }
}
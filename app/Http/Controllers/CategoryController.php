<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

//RESOURCE CONTROLLER UNTUK MENGELOLA DATA KATEGORI DENGAN FUNGSI CRUD DENGAN PERINTAH -R ATAU --RESOURCE
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all(); //CATEGORY ADALAH MODELNYA, TITIK DUA MEMANGGIL FUNGSI ALL() UNTUK MENGAMBIL SEMUA DATA DARI TABEL CATEGORIES
        return view('categories.index', compact('categories'));//MRNGIRIMKAN VARIABEL CATEGORY KE VIEW
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create'); //UNTUK MENAMPILKAN VIEW CATEGORIES CREATE UNTUK FORM TAMBAH DIBUAT DENGAN BOOTSTRAP
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // MENERIMA REQUEST DARI HTMLNYA, ini juga ada validasinya misal name minimal 5 dan harus di isi
        $validatedData = $request->validate([
            'name' => 'required|string|max:25|min:5',
            'description' => 'nullable|string',
        ]);

        Category::create($validatedData);
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:25|min:5',
            'description' => 'nullable|string',
        ]);

        $category = Category::findOrFail($id);
        // MENCARI DATA ID YANG MAU DI UPDATE
        $category->update($validatedData);
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
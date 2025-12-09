@extends('layouts.app') 
{{-- EXTENDS DARI LAYOUTS --}}

{{-- YANG DI UBAH ADALAH BAGIAN CONTENT --}}
@section('content')
<h4>Create Category</h4>
<div class="container mt-5 mb-5">
    <form action="{{ route('categories.store') }}" method="POST"> 
        {{-- POST UNTUK MENGIRIM --}}
    @csrf
    <div class="form-group mb-3">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" > 
        {{-- KLO ERROR STYLE FORM BERUBAH MERAH --}}
     <!-- tampilkan pesan error -->
     @error('name')
        <div class="alert alert-danger mt-2">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group mb-3">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        {{-- OLD BIAR NILAI KERTIKA ERRO TETAP ADA DAN TIDAK PERLU INPUT ULANG DARI AWAL --}}
    </div>
    <button type="submit" class="btn btn-md btn-primary me-3">Save</button>
     <button type="reset" class="btn btn-md btn-primary me-3">Reset</button>
</form>
</div>
@endsection
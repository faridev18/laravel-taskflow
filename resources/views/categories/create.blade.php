@extends('layouts.admin')
@section('content')
    <h1 class="text-2xl">Ajouter categorie </h1>

    <form action="{{ route('savecategorie') }}" method="POST" enctype="multipart/form-data">
        @csrf



        <div class="mb-4 mt-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nom</label>
            <input type="text" name="name" id="name"
                class="bg-white rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('name')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4 mt-4">
            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image</label>
            <input type="file" name="image" id="image"
                class="bg-white rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('image')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <input value="Save Image" type="submit" class="bg-blue-600 px-2 py-1 rounded text-white">
        </div>






    </form>
@endsection

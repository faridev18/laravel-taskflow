@extends('layouts.admin')
@section('content')
    <h1 class="text-2xl">Categories </h1>

    <div class="flex justify-end ">
        <a href="{{ route('addcategory') }}" class=" bg-blue-600 px-2 py-1 rounded text-white">Ajouter</a>
    </div>

    <div>
        @if (session('success'))
            <div class="bg-green-200 text-green-700 border border-green-700 p-2 rounded-xl mt-3">
                {{ session('success') }}
            </div>
        @endif
        <table class="min-w-full bg-white mt-5">
            <thead class="border-b">
                <tr>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Image</th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Name</th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($categories as $category)
                    <tr class="border-b">
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            <img width="200px" src="{{ asset('storage/' . $category->image) }}" alt="">
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $category->name }}</td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            <a class="bg-red-600 px-2 py-1 rounded text-white"
                                href="/categorie/{{ $category->id }}/delete">Delete</a>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
@endsection

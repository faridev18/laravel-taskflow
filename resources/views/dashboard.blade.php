@extends('layouts.admin')
@section("content")

<h1>Dashboard </h1>
<h2>{{ auth()->user()->email }}</h2>

<div>
    @auth
        <a href="{{ route('logout') }}">Logout</a>
    @endauth

</div>

@endsection
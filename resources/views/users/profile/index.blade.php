@extends('users.layouts.app')
@section('content')
<div class="h-screen flex justify-center items-center">
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="bg-red-500 text-white px-5 py-2 rounded-e-md" type="submit">Logout</button>
    </form>
</div>
@endsection


@extends('layout.layout')
@section('content')


<h2 class="text-2xl font-bold mb-4">Create Tag</h2>

<div class="mt-2 mb-2">
<a href="{{route('posts.create')}}" class="bg-blue-600 text-white px-4 py-2 rounded">Add Post</a>
<a href="{{route('tags.index')}}" class="bg-blue-600 text-white px-4 py-2 rounded">All Tags</a>
</div>

<form method="post" action="{{route('tags.store')}}">
    @csrf
<label class="block mb-1 font-semibold">Tag Name</label>
<input name="name" type="text" class="w-full border p-2 rounded mb-4">


<button type="submit" class="bg-green-600 text-white w-full p-2 rounded">Create</button>
</form>



@endsection
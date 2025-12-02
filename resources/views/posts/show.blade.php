@extends('layout.layout')
@section('content')


<h2 class="text-2xl font-bold mb-4">{{$post->title}}</h2>
<p class="text-gray-600 mb-4">{{$post->description}}</p>


<h3 class="text-xl font-semibold mb-2">Tags (Many-to-Many)</h3>
<div class="space-x-2 ">
@foreach($post->tags as $tag)
<span class="bg-purple-100 text-purple-700 px-2 py-1 rounded text-sm">{{$tag->name}}</span>
@endforeach
</div>



@endsection
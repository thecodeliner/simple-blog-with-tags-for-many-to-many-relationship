@extends('layout.layout')
@section('content')


<h2 class="text-2xl font-bold mb-4">Posts List</h2>
<a href="{{route('posts.create')}}" class="bg-blue-600 text-white px-4 py-2 rounded">Add Post</a>



<table class="w-full mt-4 border">
<thead class="bg-gray-200">
<tr>
<th class="p-3 text-left">Title</th>
<th class="p-3 text-left">Tags</th>
<th class="p-3 text-left">Action</th>
</tr>
</thead>
<tbody>
@foreach($posts as $post)    
<tr class="border-t">
<td class="p-3">{{$post->title}}</td>

<td class="p-3">
    @foreach($post->tags as $tag)
<span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-sm">{{$tag->name}}</span>
@endforeach
</td>
<td class="p-3">
<a href="{{route('posts.show', $post->id)}}" class="text-blue-600">View</a>
</td>
</tr>
@endforeach
</tbody>
</table>

@endsection
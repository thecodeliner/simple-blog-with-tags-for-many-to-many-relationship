@extends('layout.layout')
@section('content')

<div class="max-w-2xl mx-auto bg-white p-6 shadow rounded">
<h2 class="text-2xl font-bold mb-4">Tags List</h2>
<a href="{{route('tags.create')}}" class="bg-blue-600 text-white px-4 py-2 rounded">Add Tag</a>


<ul class="mt-4 space-y-2">
<li class="p-3 border rounded flex justify-between items-center">
<span>Tag A</span>
<a href="#" class="text-blue-600">View Posts</a>
</li>
<li class="p-3 border rounded flex justify-between items-center">
<span>Tag B</span>
<a href="#" class="text-blue-600">View Posts</a>
</li>
</ul>
</div>

@endsection
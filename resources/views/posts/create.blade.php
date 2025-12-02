@extends('layout.layout')
@section('content')


<h2 class="text-2xl font-bold mb-4">Create Post</h2>


<form method="post" action="{{route('posts.store')}}">
    @csrf
<label class="block mb-1 font-semibold">Post Title</label>
<input name="title" type="text" class="w-full border p-2 rounded mb-4">

<label class="block mb-1 font-semibold">Post Description</label>
<input name="description" type="text" class="w-full border p-2 rounded mb-4">

<label class="block mb-2 font-semibold">Select Tags (Many-to-Many)</label>
<div class="space-y-2 mb-4">
 <div class="wp-dropdown">
    <button type="button" class="wp-dropdown-toggle">Select tags ▾</button>
    <div class="wp-dropdown-panel">
        @foreach($tags as $tag)
            <label class="wp-option">
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                    {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                <span>{{ $tag->name }}</span>
            </label>
        @endforeach
    </div>
    
</div>
<div class="mt-4">
<a href="{{route('tags.create')}}" class="bg-blue-600 text-white px-4 py-2 rounded">Add Tag</a>
</div>

</div>


<button class="bg-green-600 text-white w-full p-2 rounded">Create</button>
</form>

<style>
    .wp-dropdown{position:relative;width:250px;font-family:inherit}
.wp-dropdown-toggle{width:100%;text-align:left;padding:6px 10px;border:1px solid #ccc;background:#fff;cursor:pointer}
.wp-dropdown-panel{display:none;position:absolute;top:100%;left:0;right:0;background:#fff;border:1px solid #ccc;max-height:200px;overflow-y:auto;z-index:1000}
.wp-dropdown.open .wp-dropdown-panel{display:block}
.wp-option{display:flex;align-items:center;padding:4px 8px;cursor:pointer}
.wp-option:hover{background:#f2f2f2}
.wp-option input{margin-right:6px}
</style>
<script>
    document.querySelector('.wp-dropdown-toggle').addEventListener('click', function () {
    document.querySelector('.wp-dropdown').classList.toggle('open');
});
// close when clicking outside
document.addEventListener('click', function (e) {
    if (!e.target.closest('.wp-dropdown')) {
        document.querySelector('.wp-dropdown').classList.remove('open');
    }
});
</script>
@endsection

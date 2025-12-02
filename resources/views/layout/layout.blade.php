<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdn.tailwindcss.com"></script>
<title>Posts</title>
</head>
<body class="bg-gray-100 p-6">
    
    <div class="max-w-xl mx-auto bg-white p-6 shadow rounded">
    @if(session('success'))
    <p class="text-green-500 pb-2 pt-2 rounded ">{{session('success')}}</p>
    @endif
    
    @if($errors->any())
        
        @foreach($errors->all() as $error)
        <li class="text-red-500 list-none pb-2 pt-2 rounded ">{{$error}}</li>
        @endforeach
    @endif
        
    @yield('content')
     </div>
    </body>
</html>
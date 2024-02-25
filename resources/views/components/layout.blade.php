<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LARAVEL!</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="mx-auto mt-11 max-w-2xl bg-gradient-to-r from-indigo-200 via-purple-200 to-pink-200 text-slate-700">
    <nav class="mb-8 flex justify-between text-lg font-medium">
        <ul class="flex space-x-2">
            <li>
                <a href="{{route('jobs.index')}}">Home</a>
            </li>
        </ul>
        <ul class="flex space-x-2 items-center">
            @auth
                <li>
                    <a href="{{ route('my-job-application.index') }}">
                        {{ auth()->user()->name }}: Applications
                    </a>
                </li>
                <li>
                    <a href="{{ route('my-jobs.index')}}">My Jobs</a>
                </li>
                <li>
                    <form action="{{ route('auth.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-button>Logout</x-button>
                    </form>
                </li>
            @else
                <li>
                    <a href="{{ route('auth.create') }}">Sign Up</a>
                </li>
            @endauth
        </ul>
    </nav>

    @if(session('success'))
    <div x-data="{ show : true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" role="alert" class="my-8 roundend-md border-l-4 border-green-300 bg-green-100 p-4 text-green-700 opacity-75">
        <p class="font-bold">Success!</p>
        <p>{{session('success')}}</p>
    </div>
    @elseif(session('error'))
    <div x-data="{ show : true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" role="alert" class="my-8 fixed right-0 top-0 roundend-md border-l-4 border-red-300 bg-red-100 p-4 text-red-700 opacity-75">
        <p class="font-bold">Error</p>
        <p>{{session('error')}}</p>
    </div>
    @endif

    {{ $slot }}
    
</body>

</html>

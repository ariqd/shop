<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') &bull; {{ env('APP_NAME') }}</title>

    <!-- Fonts -->
    {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> --}}

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        body {
            font-family: 'Nunito';
        }

    </style>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.min.js" defer></script>

    @stack('css')
</head>

<body class="bg-white text-gray-600 work-sans leading-normal text-base tracking-normal">
    @include('front.components.header')

    <main class="min-h-screen relative">

        <div class="container mx-auto">
            @if(session('success'))
                <div class="max-w-7xl mx-auto pt-8 px-4">
                    <div class="bg-teal-100 border border-teal-300 text-teal-700 px-4 py-3 rounded" role="alert">
                        <strong class="font-bold">Sukses!</strong>
                        <span class="block sm:inline">{!! session('success') !!}</span>
                        {{-- <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Close</title>
                                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                            </svg>
                        </span> --}}
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="max-w-7xl mx-auto py-4 px-4">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>

        @yield('content')

        <footer class="absolute bottom-0 flex justify-center w-full py-8">
            <div>
                &copy;2020 - CV Atalla Putra Mandiri
            </div>
        </footer>

    </main>

    @stack('js')

</body>


</html>

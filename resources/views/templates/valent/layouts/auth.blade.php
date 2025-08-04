<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="msapplication-TileColor" content="#07030c">
    <meta name="theme-color" content="#07030c">

    <link rel="apple-touch-icon" href="{{ asset('assets/images/' . site('favicon')) }}">
    <link rel="icon" href="{{ asset('assets/images/' . site('favicon')) }}">

    <title>{{ $page_title }} | {{ site('name') }}</title>
    <meta name="author" content="support@rescron.com">
    <meta name="description" content="{{ site('seo_description') }}">
    <meta property="og:url" content="{{ request()->url }}">
    <meta property="og:title" content="{{ $page_title }} | {{ site('name') }}">
    <meta property="og:description" content="{{ site('seo_description') }}">
    <meta property="og:image" content="{{ asset('assets/images/' . site('cover')) }}">
    <meta name="robots" content="noindex">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    {{-- sweet alert css --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="{{ asset('/assets/templates/valent/css/output.css?v=1.2') }}">
    <link rel="stylesheet" href="{{ asset('/assets/templates/valent/css/front_main.css') }}">

    <style>
        .button-spinner {
            border: 4px solid #f3f3f3;
            /* Light grey background */
            border-top: 4px solid #3498db;
            /* Blue color for the spinner */
            border-radius: 50%;
            width: 25px;
            height: 25px;
            animation: spin 1s linear infinite;
            /* Spinning animation */
            display: inline-block;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .not-allowed-cursor {
            cursor: not-allowed;
        }
    </style>
</head>

<body class="bg-black"
    style="background-image: url({{ asset('/assets/templates/valent/images/dash_background.png') }});">

    @if (site('preloader') == 1)
        @include('templates.' . site('template') . '.loaders.front_preloader')
    @endif

    <!-- template-->
    <div class="w-full h-screen">

        @yield('contents')

    </div>


    {{-- Include SweetAlert2 JavaScript file --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>

    <script src="{{ asset('/assets/templates/valent/scripts/front_main.js') }}"></script>

    @yield('scripts')

    @stack('scripts')

    {{-- livechat --}}
    {!! json_decode(site('livechat')) !!}
</body>

</html>

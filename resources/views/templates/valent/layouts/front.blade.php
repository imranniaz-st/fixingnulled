<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="msapplication-TileColor" content="#07030c">
    <meta name="theme-color" content="#07030c">

    <title> {{ $page_title }} | {{ site('name') }}</title>

    <meta name="author" content="support@rescron.com">
    <meta name="description" content="{{ $short_description }}">
    <meta property="og:url" content="{{ request()->url }}">
    <meta property="og:title" content="{{ $page_title }} | {{ site('name') }}">
    <meta property="og:description" content="{{ $short_description }}">
    <meta property="og:image" content="{{ asset('assets/images/' . site('cover')) }}">
    <meta name="robots" content="{{ site('robot') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>



    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.1/dist/css/splide.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/assets/templates/valent/css/output.css?v=1.2') }}">
    <link rel="stylesheet" href="{{ asset('/assets/templates/valent/css/front_main.css') }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/' . site('favicon')) }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/' . site('favicon')) }}" type="image/x-icon">


    @yield('css')

</head>
@php
    $bg_style =
        'style="background-image: url(' .
        asset('/assets/templates/valent/images/front_background.png') .
        ') !important;"';
    if (request()->routeIs('about')) {
        $bg_style =
            'style="background-image: url(' .
            asset('/assets/templates/valent/images/2front_background_about_us.png') .
            ') !important;"';
    } elseif (request()->routeIs('pricing')) {
        $bg_style =
            'style="background-image: url(' .
            asset('/assets/templates/valent/images/front_background_Ai_Bots.png') .
            ') !important;"';
    } elseif (request()->routeIs('trades')) {
        $bg_style =
            'style="background-image: url(' .
            asset('/assets/templates/valent/images/front_background_Live_rading.png') .
            ') !important;"';
    } elseif (request()->routeIs('tos')) {
        $bg_style =
            'style="background-image: url(' .
            asset('/assets/templates/valent/images/front_background_TOS.png') .
            ') !important;"';
    } elseif (request()->routeIs('contact')) {
        $bg_style =
            'style="background-image: url(' .
            asset('/assets/templates/valent/images/front_background_TOS.png') .
            ') !important;"';
    } elseif (request()->routeIs('faqs')) {
        $bg_style =
            'style="background-image: url(' .
            asset('/assets/templates/valent/images/front_background_TOS.png') .
            ') !important;"';
    } elseif (request()->routeIs('privacy')) {
        $bg_style =
            'style="background-image: url(' .
            asset('/assets/templates/valent/images/front_background_TOS.png') .
            ') !important;"';
    }

@endphp

<body class="bg-black" {!! $bg_style !!}>

    @if (site('preloader') == 1)
        @include('templates.' . site('template') . '.loaders.front_preloader')
    @endif

    <div class="w-full">
        <header class="w-full">
            <nav class="fixed top-0 w-full lg:py-7 py-3 bg-blue-200 bg-opacity-15 backdrop-blur-md z-50">
                <div class="lg:w-[90%] mx-auto flex justify-between items-center lg:px-0 px-4 relative"
                    x-data="{
                        mobilenavbar: true,
                    }">
                    <div>
                        <a href="{{ route('home') }}"><img
                                src="{{ asset('/assets/templates/valent/images/' . site('logo_rec')) }}" alt="logo"
                                class="lg:h-20 h-12"></a>
                    </div>

                    <button class="lg:hidden block p-2 text-white rounded focus:outline-none" id="toggle-sidebar"
                        x-on:click="mobilenavbar = !mobilenavbar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"></path>
                        </svg>
                    </button>

                    <div class="lg:relative absolute top-16 left-0 lg:top-0 lg:left-auto lg:flex lg:w-auto w-full bg-[#090E12] lg:border lg:rounded-full lg:py-2 py-4 lg:px-6 xl:h-[60px] lg:h-[70px] h-auto hidden"
                        id="nav-menu" x-bind:class="{ 'hidden': mobilenavbar, 'block': !mobilenavbar }" x-transition>
                        <ul class="lg:flex flex-col lg:flex-row gap-2 text-white sm:text-center lg:text-left">
                            <li><a href="{{ route('home') }}"
                                    class="py-2 px-4 rounded-lg hover:text-[#0040BC] block @if (request()->routeIs('home')) lg:bg-gradient-to-r from-[#0040BC] to-[#031A45] @endif">Home</a>
                            </li>
                            <li><a href="{{ route('about') }}"
                                    class="py-2 px-4 rounded-lg hover:text-[#0040BC] block @if (request()->routeIs('about')) lg:bg-gradient-to-r from-[#0040BC] to-[#031A45] @endif">About
                                    Us</a></li>
                            <li><a href="{{ route('pricing') }}"
                                    class="py-2 px-4 rounded-lg hover:text-[#0040BC] block @if (request()->routeIs('pricing')) lg:bg-gradient-to-r from-[#0040BC] to-[#031A45] @endif">Ai
                                    Bots</a></li>
                            <li><a href="{{ route('trades') }}"
                                    class="py-2 px-4 rounded-lg hover:text-[#0040BC] block @if (request()->routeIs('trades')) lg:bg-gradient-to-r from-[#0040BC] to-[#031A45] @endif">Live
                                    Ai
                                    Trades</a></li>
                            <li><a href="{{ route('tos') }}"
                                    class="py-2 px-4 rounded-lg hover:text-[#0040BC] block @if (request()->routeIs('tos')) lg:bg-gradient-to-r from-[#0040BC] to-[#031A45] @endif">TOS</a>
                            </li>
                            <li><a href="{{ route('contact') }}"
                                    class="py-2 px-4 rounded-lg hover:text-[#0040BC] block @if (request()->routeIs('contact')) lg:bg-gradient-to-r from-[#0040BC] to-[#031A45] @endif">Contact</a>
                            </li>
                            <li><a href="{{ route('faqs') }}"
                                    class="py-2 px-4 rounded-lg hover:text-[#0040BC] block @if (request()->routeIs('faqs')) lg:bg-gradient-to-r from-[#0040BC] to-[#031A45] @endif">FAQ</a>
                            </li>
                        </ul>
                    </div>

                    <div class="lg:block hidden w-52">
                        <a href="{{ route('user.login') }}"
                            class="border rounded-full py-4 px-10 block text-center text-white text-lg bg-gradient-to-r from-[#306FE6] via-[#3b82f6] to-[#0040BC] hover:text-[#0040BC] hover:bg-gradient-to-r hover:from-[#3F7DF2] hover:via-[#FFFFFF] hover:to-[#09C241] transition duration-200 ease-in-out">Login</a>
                    </div>
                </div>
            </nav>

            {{-- header --}}
            @yield('header')

        </header>

        {{-- main content --}}
        <main>

            @yield('contents')


            <!--Counter-->
            <section class="w-full mb-10 lg:mb-40 bg-blue-300 bg-opacity-15 backdrop-blur-md">
                <div class="w-[90%] mx-auto py-10">
                    <div class="grid lg:grid-cols-4 grid-cols-2 lg:gap-10 gap-4 w-full">
                        <div class="text-center">
                            <p class="text-white font-bold lg:text-5xl text-2xl lg:mb-3"> <span
                                    class="counter_number">3.5</span> k</p>
                            <p class="text-[#B4B1B1] lg:text-2xl text-xl">Users</p>
                        </div>

                        <div class="text-center">
                            <p class="text-white font-bold lg:text-5xl text-2xl lg:mb-3">USD <span
                                    class="counter_number">5.5</span> M+</p>
                            <p class="text-[#B4B1B1] lg:text-2xl text-xl">Deposits</p>
                        </div>

                        <div class="text-center">
                            <p class="text-white font-bold lg:text-5xl text-2xl lg:mb-3">USD <span
                                    class="counter_number">10.2</span> M+</p>
                            <p class="text-[#B4B1B1] lg:text-2xl text-xl">Withdrawals</p>
                        </div>

                        <div class="text-center">
                            <p class="text-white font-bold lg:text-5xl text-2xl lg:mb-3"> <span
                                    class="counter_number">200</span> +</p>
                            <p class="text-[#B4B1B1] lg:text-2xl text-xl">Countries </p>
                        </div>
                    </div>
                </div>
            </section>


        </main>

        <footer class="w-full">
            <div class="pt-1 bg-gradient-to-r from-[#ffffff4f] from-[60%] to-[#ffffff]"></div>
            <div class="w-full bg-[#fff] bg-opacity-10">
                <div class="w-[90%] mx-auto py-10 px-3">
                    <div class="lg:flex gap-3">
                        <div class="w-full mb-6">
                            <div class="mb-4">
                                <a href="{{ route('home') }}"><img
                                        src="{{ asset('/assets/templates/valent/images/' . site('logo_rec')) }}"
                                        alt="logo" class="lg:h-20 h-12 mb-4"></a>
                                <p class="text-[#8C8787] px-6">All Servers Operational</p>
                            </div>
                            <div class="lg:px-6 py-2">
                                <ul class="flex gap-4">

                                    @php
                                        $socialMedia = [
                                            'instagram',
                                            'facebook',
                                            'pinterest',
                                            'twitter',
                                            'youtube',
                                            'linkedin',
                                            'snapchat',
                                            'tiktok',
                                            'reddit',
                                            'whatsapp',
                                        ];
                                    @endphp
                                    @foreach ($socialMedia as $media)
                                        @if (site($media))
                                            <li>
                                                <div class="p-2 bg-[#F9F8F8] rounded-lg bg-opacity-20">
                                                    <a href="{{ site($media) }}">
                                                        <img src="{{ asset('/assets/templates/valent/images/front_icon/white_social_icon_' . $media . '.svg') }}"
                                                            alt="icon" style="width: 25px; height: 25px;">
                                                    </a>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="w-full grid lg:grid-cols-3 grid-cols-2">
                            <div class="col-span-1">
                                <p class="text-white text-2xl">Company</p>
                                <ul class="py-4 space-y-4">
                                    <li><a href="{{ route('about') }}" class="text-[#A39D9D] hover:text-white">About
                                            Us</a>
                                    </li>
                                    <li><a href="{{ route('about') }}" class="text-[#A39D9D] hover:text-white">Our
                                            Vision</a>
                                    </li>
                                    <li><a href="{{ route('about') }}" class="text-[#A39D9D] hover:text-white">Our
                                            Mission</a>
                                    </li>
                                    <li><a href="{{ route('contact') }}"
                                            class="text-[#A39D9D] hover:text-white">Contact
                                            Us</a></li>
                                </ul>
                            </div>

                            <div class="col-span-1">
                                <p class="text-white text-2xl">Resources</p>
                                <ul class="py-4 space-y-4">
                                    <li><a href="{{ route('tos') }}" class="text-[#A39D9D] hover:text-white">TOS</a>
                                    </li>
                                    <li><a href="{{ route('privacy') }}"
                                            class="text-[#A39D9D] hover:text-white">Privacy
                                            Policy</a></li>
                                    <li><a href="{{ route('about') }}"
                                            class="text-[#A39D9D] hover:text-white">Community</a>
                                    </li>
                                    <li><a href="{{ route('faqs') }}" class="text-[#A39D9D] hover:text-white">FAQ</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="lg:col-span-1 col-span-2">
                                <p class="text-white text-2xl">Contact Us</p>
                                <ul class="py-4 space-y-4">
                                    <li>
                                        <div class="flex gap-4">
                                            <img src="{{ asset('/assets/templates/valent/images/front_icon/gray_mdi_location.svg') }}"
                                                alt="icon">
                                            <p class="text-[#A39D9D]"> {{ site('address') }},
                                                {{ site('city') }},{{ site('state') }}, {{ site('country') }}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex gap-4">
                                            <img src="{{ asset('/assets/templates/valent/images/front_icon/gray_call-sharp.svg') }}"
                                                alt="icon">
                                            <p class="text-[#A39D9D]">{{ site('phone') }}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex gap-4">
                                            <img src="{{ asset('/assets/templates/valent/images/front_icon/gray_email.svg') }}"
                                                alt="icon">
                                            <p class="text-[#A39D9D]">{{ site('email') }}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        {{-- cookie consent --}}
        <div class="w-full fixed z-50 bottom-0 left-0 bg-blue-300 bg-opacity-15 backdrop-blur-md hidden"
            id="cookie-consent">
            <div class="w-full bg-purple-500 p-5">
                <div class="w-full grid grid-cols-1 gap-3  md:flex space-x-2 justify-center items-center text-white">
                    <p class="text-center">We use cookies to tailor your experience on {{ site('name') }}. Learn more
                        in
                        our <a href="{{ route('privacy') }}" class="border-b">privacy policy</a></p>
                    <div class="text-center py-6">
                        <a id="consented"
                            class="border rounded-full py-4 px-10  text-center text-white text-lg bg-gradient-to-r from-[#306FE6] via-[#3b82f6] to-[#0040BC] hover:text-[#0040BC] hover:bg-gradient-to-r hover:from-[#3F7DF2] hover:via-[#FFFFFF] hover:to-[#09C241] transition duration-200 ease-in-out"
                            role="button">
                            <span>Accept Cookies</span>

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>

    <script src="{{ asset('/assets/templates/valent/scripts/front_main.js') }}"></script>

    {{-- cookie --}}
    <script>
        ///counter up 
        $(".counter_number").counterUp({
            time: 3000
        });



        window.onload = function() {
            // Check if the "cookie-consent" cookie exists
            if (!document.cookie.includes('cookie-consent')) {
                $('#cookie-consent').removeClass('hidden');
            }
        };

        function setCookie(cookieName, cookieValue) {
            var expirationDate = new Date();
            expirationDate.setFullYear(expirationDate.getFullYear() + 10); // Set expiration date to 10 years from now

            var cookieString = cookieName + '=' + cookieValue + '; expires=' + expirationDate.toUTCString() + '; path=/';

            document.cookie = cookieString;
        }


        $('#consented').on('click', function(e) {
            e.preventDefault();
            setCookie('cookie-consent', true);
            $('#cookie-consent').addClass('hidden');
        });
    </script>

    @yield('scripts')

    @stack('scripts')

    {{-- livechat --}}
    {!! json_decode(site('livechat')) !!}
</body>

</html>

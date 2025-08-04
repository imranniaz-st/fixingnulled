<!Doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="msapplication-TileColor" content="#07030c">
    <meta name="theme-color" content="#07030c">
    <title> {{ $page_title }} | {{ site('name') }}</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    {{-- sweet alert css --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="{{ asset('/assets/templates/valent/css/output.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/templates/valent/css/dashboard_main.css') }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/' . site('favicon')) }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/' . site('favicon')) }}" type="image/x-icon">

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
            position: absolute;
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


        /* logout button */
        .logoutBtn {
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .logoutBtn:hover {
            background-color: darkred;
        }
    </style>

    <style>
        body {
            display: flex;
            justify-content: center;
        }

        #sidebar {
            width: 300px;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            z-index: 10;
        }

        /* Fixed header styles */
        .fixed-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            background: #010510;
            padding: 1rem;
            height: auto;
        }

        #main-content {
            width: 100%;
            padding-top: 80px;
        }

        /* Mobile styles */
        @media (max-width: 767px) {
            #main-content {
                padding: 80px 1rem 1rem 1rem;
                margin: 0;
            }

            .fixed-header {
                padding: 0.5rem;
            }

            .grid {
                grid-template-columns: 1fr;
            }
        }

        /* Tablet and iPad Pro styles */
        @media (min-width: 768px) and and (max-width: 1439px) {

            #main-content {
                padding: 80px 2rem 2rem 2rem;
                margin: 0;
                width: 100%;
                transition: margin-left 0.3s ease;
            }
        }

        /* Laptop styles */
        @media (min-width: 1440px) {
            #main-content {
                margin-left: 300px;
                width: calc(100% - 300px);
            }
        }

        /* Adjust table responsiveness */
        @media (max-width: 768px) {
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>

    @yield('css')

</head>

<body class="bg-black"
    style="  background-image: url({{ asset('/assets/templates/valent/images/dash_background.png') }});">

    @if (site('preloader') == 1)
        @include('templates.' . site('template') . '.loaders.preloader')
    @endif


    <!-- Sidebar (hidden on mobile, visible on desktop) -->
    <div class="flex relative overflow-hidden">
        <!-- Sidebar -->
        <div id="sidebar"
            class="w-auto bg-[#010510] text-white min-h-screen px-5 py-20 hidden xl:block lg:relative absolute z-10"
            data-aos="fade-right">

            <div class="flex justify-end xl:hidden mb-4">
                <button id="toggle-close" class=" p-2 ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: rgb(255, 255, 255);">
                        <path
                            d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z">
                        </path>
                    </svg>
                </button>
            </div>

            <a href=""><img src="{{ asset('/assets/templates/dome/images/' . site('logo_rec')) }}" alt="logo"
                    class="block"></a>
            <div class="my-10 text-gray-400 text-xl px-10 w-[300px]">
                <ul class="w-full">
                    <li class="p-3 mb-3 hover:bg-[#1252CC] hover:text-white rounded-lg">
                        <a href="{{ route('user.dashboard') }}"
                            class="flex items-center gap-3 @if (request()->routeIs('user.dashboard')) active @endif">
                            <svg width="20" height="20" viewBox="0 0 14 14" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect class="icon @if (request()->routeIs('user.dashboard')) active @endif" x="0.105225"
                                    y="0.105286" width="4" height="4" rx="1.4" fill="white"
                                    fill-opacity="0.45" />
                                <rect class="icon @if (request()->routeIs('user.dashboard')) active @endif" x="0.105225"
                                    y="6.10529" width="4" height="4" rx="1.4" fill="white"
                                    fill-opacity="0.45" />
                                <rect class="icon @if (request()->routeIs('user.dashboard')) active @endif" x="6.10522"
                                    y="0.105286" width="4" height="4" rx="1.4" fill="white"
                                    fill-opacity="0.45" />
                                <rect class="icon @if (request()->routeIs('user.dashboard')) active @endif" x="6.10522"
                                    y="6.10529" width="7" height="7" rx="1.4" fill="white"
                                    fill-opacity="0.45" />
                            </svg>
                            Dashboard</a>
                    </li>
                    <li class="p-3 mb-3 hover:bg-[#1252CC] hover:text-white rounded-lg">
                        <a href="{{ route('user.deposits.index') }}"
                            class="flex items-center gap-3 @if (request()->routeIs('user.deposits.index')) active @endif">
                            <svg width="20" height="27" viewBox="0 0 20 27" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path class="icon @if (request()->routeIs('user.deposits.index')) active @endif"
                                    d="M19.4688 20.9514V25.3125C19.4688 25.5363 19.3799 25.7509 19.2216 25.9091C19.0634 26.0673 18.8488 26.1562 18.625 26.1562C18.4012 26.1562 18.1866 26.0673 18.0284 25.9091C17.8701 25.7509 17.7812 25.5363 17.7812 25.3125V20.9514C17.7773 19.8684 17.5506 18.7978 17.1151 17.8062C16.6796 16.8146 16.0448 15.9232 15.25 15.1875V21.3416C15.2498 21.5232 15.1911 21.6999 15.0825 21.8454C14.974 21.9909 14.8213 22.0976 14.6473 22.1495C14.4733 22.2013 14.2872 22.1957 14.1167 22.1334C13.9461 22.0711 13.8002 21.9554 13.7007 21.8035L12.5743 20.0834C12.5658 20.0707 12.5574 20.057 12.55 20.0433C12.3845 19.7511 12.1098 19.5366 11.7862 19.447C11.4626 19.3574 11.1167 19.4 10.8245 19.5655C10.5324 19.731 10.3179 20.0057 10.2283 20.3293C10.1387 20.6529 10.1813 20.9988 10.3468 21.291L12.6808 24.8548C12.8033 25.042 12.8464 25.2703 12.8006 25.4894C12.7548 25.7084 12.6239 25.9003 12.4366 26.0228C12.2493 26.1453 12.0211 26.1884 11.802 26.1427C11.583 26.0969 11.3911 25.9659 11.2686 25.7787L8.92082 22.1927L8.89551 22.1526C8.85543 22.083 8.81852 22.0124 8.78477 21.9417H0.90625C0.682474 21.9417 0.467863 21.8528 0.309629 21.6946C0.151395 21.5363 0.0625 21.3217 0.0625 21.098V10.125C0.0625 9.67744 0.24029 9.24822 0.556757 8.93175C0.873225 8.61528 1.30245 8.43749 1.75 8.43749H6.8125V13.5C6.8125 13.7238 6.90139 13.9384 7.05963 14.0966C7.21786 14.2548 7.43247 14.3437 7.65625 14.3437C7.88003 14.3437 8.09464 14.2548 8.25287 14.0966C8.41111 13.9384 8.5 13.7238 8.5 13.5V8.43749H13.5625C14.0101 8.43749 14.4393 8.61528 14.7557 8.93175C15.0722 9.24822 15.25 9.67744 15.25 10.125V13.038C16.545 13.9132 17.6065 15.0917 18.3418 16.471C19.0771 17.8502 19.464 19.3883 19.4688 20.9514ZM8.5 3.72409L10.4343 5.65945C10.5926 5.81777 10.8073 5.90671 11.0312 5.90671C11.2552 5.90671 11.4699 5.81777 11.6282 5.65945C11.7865 5.50112 11.8755 5.28639 11.8755 5.06249C11.8755 4.83859 11.7865 4.62386 11.6282 4.46554L8.2532 1.09054C8.17484 1.01209 8.08179 0.949856 7.97936 0.907395C7.87693 0.864934 7.76713 0.843079 7.65625 0.843079C7.54537 0.843079 7.43557 0.864934 7.33314 0.907395C7.23071 0.949856 7.13766 1.01209 7.0593 1.09054L3.6843 4.46554C3.52597 4.62386 3.43703 4.83859 3.43703 5.06249C3.43703 5.28639 3.52597 5.50112 3.6843 5.65945C3.84262 5.81777 4.05735 5.90671 4.28125 5.90671C4.50515 5.90671 4.71988 5.81777 4.8782 5.65945L6.8125 3.72409V8.43749H8.5V3.72409Z"
                                    fill="white" fill-opacity="0.45" />
                            </svg>
                            Deposit</a>
                    </li>
                    <li
                        class="p-3 mb-3 hover:bg-[#1252CC] hover:text-white rounded-lg @if (request()->routeIs('user.bots.index')) active @endif">
                        <a href="{{ route('user.bots.index') }}" class="flex items-center gap-3">
                            <svg width="20" height="20" viewBox="0 0 13 13" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path class="icon @if (request()->routeIs('user.bots.index')) active @endif"
                                    d="M12.3482 5.80569V3.86437C12.3482 3.51824 12.2113 3.18628 11.9675 2.94153C11.7238 2.69678 11.3932 2.55928 11.0484 2.55928H7.14898V1.70314C7.3472 1.52435 7.47394 1.26724 7.47394 0.978817C7.47394 0.719219 7.37123 0.470253 7.18841 0.286689C7.00558 0.103125 6.75762 0 6.49907 0C6.24053 0 5.99257 0.103125 5.80974 0.286689C5.62692 0.470253 5.52421 0.719219 5.52421 0.978817C5.52421 1.26724 5.65095 1.52435 5.84917 1.70314V2.55928H1.94972C1.60499 2.55928 1.27438 2.69678 1.03061 2.94153C0.786852 3.18628 0.649907 3.51824 0.649907 3.86437V5.8207L0.603114 5.82396C0.43932 5.83584 0.286074 5.90953 0.174187 6.03022C0.0622992 6.15092 6.64499e-05 6.30966 0 6.47455V7.77964C0 7.95271 0.0684722 8.11868 0.190353 8.24106C0.312235 8.36343 0.477541 8.43219 0.649907 8.43219V11.6949C0.649907 12.041 0.786852 12.373 1.03061 12.6177C1.27438 12.8625 1.60499 13 1.94972 13H11.0484C11.3932 13 11.7238 12.8625 11.9675 12.6177C12.2113 12.373 12.3482 12.041 12.3482 11.6949V8.43219C12.5206 8.43219 12.6859 8.36343 12.8078 8.24106C12.9297 8.11868 12.9981 7.95271 12.9981 7.77964V6.51501C13.0058 6.41373 12.9898 6.31207 12.9514 6.2181C12.8201 5.89966 12.5387 5.82331 12.3482 5.80569ZM3.24954 6.47455C3.24954 5.75414 3.68628 5.16946 4.2244 5.16946C4.76252 5.16946 5.19926 5.75414 5.19926 6.47455C5.19926 7.19496 4.76252 7.77964 4.2244 7.77964C3.68628 7.77964 3.24954 7.19496 3.24954 6.47455ZM9.0974 10.3898C8.44685 10.3879 3.89944 10.3898 3.89944 10.3898V9.08473C3.89944 9.08473 8.44945 9.08343 9.10001 9.08473L9.0974 10.3898ZM8.77375 7.77964C8.23563 7.77964 7.79889 7.19496 7.79889 6.47455C7.79889 5.75414 8.23563 5.16946 8.77375 5.16946C9.31187 5.16946 9.74861 5.75414 9.74861 6.47455C9.74861 7.19496 9.31187 7.77964 8.77375 7.77964Z"
                                    fill="white" fill-opacity="0.45" />
                            </svg>
                            Ai Bot</a>
                    </li>
                    <li class="p-3 mb-3 hover:bg-[#1252CC] hover:text-white rounded-lg">
                        <a href="{{ route('user.withdrawals.index') }}"
                            class="flex items-center gap-3 @if (request()->routeIs('user.withdrawals.index')) active @endif">
                            <svg width="20" height="27" viewBox="0 0 20 27" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path class="icon @if (request()->routeIs('user.withdrawals.index')) active @endif"
                                    d="M8.5 5.90625H6.8125V1.6875C6.8125 1.46372 6.90139 1.24911 7.05963 1.09088C7.21786 0.932645 7.43247 0.84375 7.65625 0.84375C7.88003 0.84375 8.09464 0.932645 8.25287 1.09088C8.41111 1.24911 8.5 1.46372 8.5 1.6875V5.90625ZM15.25 13.038V7.59375C15.25 7.1462 15.0722 6.71697 14.7557 6.40051C14.4393 6.08404 14.0101 5.90625 13.5625 5.90625H8.5V12.3071L10.4343 10.3718C10.5127 10.2934 10.6058 10.2312 10.7082 10.1888C10.8106 10.1464 10.9204 10.1245 11.0312 10.1245C11.1421 10.1245 11.2519 10.1464 11.3543 10.1888C11.4567 10.2312 11.5498 10.2934 11.6282 10.3718C11.7066 10.4502 11.7688 10.5433 11.8112 10.6457C11.8536 10.7481 11.8755 10.8579 11.8755 10.9688C11.8755 11.0796 11.8536 11.1894 11.8112 11.2918C11.7688 11.3942 11.7066 11.4873 11.6282 11.5657L8.2532 14.9407C8.17484 15.0192 8.08179 15.0814 7.97936 15.1238C7.87693 15.1663 7.76713 15.1882 7.65625 15.1882C7.54537 15.1882 7.43557 15.1663 7.33314 15.1238C7.23071 15.0814 7.13766 15.0192 7.0593 14.9407L3.6843 11.5657C3.52597 11.4074 3.43703 11.1927 3.43703 10.9688C3.43703 10.7448 3.52597 10.5301 3.6843 10.3718C3.84262 10.2135 4.05735 10.1245 4.28125 10.1245C4.50515 10.1245 4.71988 10.2135 4.8782 10.3718L6.8125 12.3071V5.90625H1.75C1.30245 5.90625 0.873225 6.08404 0.556757 6.40051C0.24029 6.71697 0.0625 7.1462 0.0625 7.59375V21.0938C0.0625 21.3175 0.151395 21.5321 0.309629 21.6904C0.467863 21.8486 0.682474 21.9375 0.90625 21.9375H8.78477C8.81852 22.0082 8.85543 22.0788 8.89551 22.1484L8.92082 22.1885L11.2686 25.7745C11.3911 25.9617 11.583 26.0927 11.802 26.1384C12.0211 26.1842 12.2493 26.1411 12.4366 26.0186C12.6239 25.8961 12.7548 25.7042 12.8006 25.4851C12.8464 25.2661 12.8033 25.0378 12.6808 24.8505L10.3468 21.2868C10.1813 20.9946 10.1387 20.6487 10.2283 20.3251C10.3179 20.0015 10.5324 19.7267 10.8245 19.5613C11.1167 19.3958 11.4626 19.3532 11.7862 19.4428C12.1098 19.5324 12.3845 19.7469 12.55 20.0391C12.5574 20.0528 12.5658 20.0665 12.5743 20.0791L13.7007 21.7993C13.8002 21.9512 13.9461 22.0669 14.1167 22.1292C14.2872 22.1915 14.4733 22.1971 14.6473 22.1452C14.8213 22.0934 14.974 21.9867 15.0825 21.8412C15.1911 21.6956 15.2498 21.519 15.25 21.3374V15.1875C16.0453 15.9237 16.6805 16.8157 17.1159 17.8081C17.5514 18.8005 17.7779 19.8719 17.7812 20.9556V25.3125C17.7812 25.5363 17.8701 25.7509 18.0284 25.9091C18.1866 26.0674 18.4012 26.1562 18.625 26.1562C18.8488 26.1562 19.0634 26.0674 19.2216 25.9091C19.3799 25.7509 19.4688 25.5363 19.4688 25.3125V20.9514C19.464 19.3884 19.0771 17.8502 18.3418 16.471C17.6065 15.0917 16.545 13.9132 15.25 13.038Z"
                                    fill="white" fill-opacity="0.45" />
                            </svg>
                            Withdrawal</a>
                    </li>
                    <li class="p-3 mb-3 hover:bg-[#1252CC] hover:text-white rounded-lg">
                        <a href="{{ route('user.transfers.index') }}"
                            class="flex items-center gap-3 @if (request()->routeIs('user.transfers.index')) active @endif">
                            <svg width="20" height="20" viewBox="0 0 16 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path class="icon @if (request()->routeIs('user.transfers.index')) active @endif"
                                    fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12.323 5.95973C12.5818 5.18325 11.8431 4.44453 11.0666 4.70336L1.16187 8.00493C0.461394 8.23842 0.251525 9.12744 0.773626 9.64954L3.06656 11.9425L7.30282 9.72349L5.08383 13.9597L7.37678 16.2527C7.89888 16.7748 8.7879 16.5649 9.02139 15.8645L12.323 5.95973Z"
                                    fill="white" fill-opacity="0.45" />
                                <circle class="icon @if (request()->routeIs('user.transfers.index')) active @endif" cx="1.5"
                                    cy="15.5" r="1.5" fill="white" fill-opacity="0.45" />
                            </svg>
                            P2p</a>
                    </li>
                    <li class="p-3 mb-3 hover:bg-[#1252CC] hover:text-white rounded-lg">
                        <a href="{{ route('user.referrals') }}"
                            class="flex items-center gap-3 @if (request()->routeIs('user.referrals')) active @endif">
                            <svg width="20" height="20" viewBox="0 0 18 13" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path class="icon @if (request()->routeIs('user.referrals')) active @endif"
                                    d="M14.25 11.1429V13H5.25V11.1429C5.25 11.1429 5.25 7.42857 9.75 7.42857C14.25 7.42857 14.25 11.1429 14.25 11.1429ZM12 2.78572C12 2.23475 11.868 1.69616 11.6208 1.23806C11.3736 0.779947 11.0222 0.422895 10.611 0.212051C10.1999 0.00120701 9.7475 -0.0539594 9.31105 0.053528C8.87459 0.161015 8.47368 0.426329 8.15901 0.815918C7.84434 1.20551 7.63005 1.70187 7.54323 2.24225C7.45642 2.78262 7.50097 3.34274 7.67127 3.85176C7.84157 4.36078 8.12996 4.79585 8.49997 5.10195C8.86998 5.40805 9.30499 5.57143 9.75 5.57143C10.3467 5.57143 10.919 5.27794 11.341 4.75551C11.7629 4.23309 12 3.52453 12 2.78572ZM14.4 7.48429C14.81 7.95257 15.1405 8.51727 15.3723 9.14542C15.6041 9.77357 15.7325 10.4526 15.75 11.1429V13H18V11.1429C18 11.1429 18 7.93929 14.4 7.48429ZM13.5 1.05997e-06C13.2734 1.73656e-05 13.0482 0.0438798 12.8325 0.130001C13.2713 0.909044 13.5065 1.83596 13.5065 2.78572C13.5065 3.73547 13.2713 4.66239 12.8325 5.44143C13.0482 5.52755 13.2734 5.57141 13.5 5.57143C14.0967 5.57143 14.669 5.27794 15.091 4.75551C15.5129 4.23309 15.75 3.52453 15.75 2.78572C15.75 2.0469 15.5129 1.33834 15.091 0.815918C14.669 0.293495 14.0967 1.05997e-06 13.5 1.05997e-06ZM6 4.64286H3.75V1.85714H2.25V4.64286H0V6.5H2.25V9.28571H3.75V6.5H6V4.64286Z"
                                    fill="white" fill-opacity="0.45" />
                            </svg>
                            My Referals</a>
                    </li>
                    <li class="p-3 mb-3 hover:bg-[#1252CC] hover:text-white rounded-lg">
                        <a href="{{ route('user.transactions.index') }}"
                            class="flex items-center gap-3 @if (request()->routeIs('user.transactions.index')) active @endif">
                            <svg width="27" height="27" viewBox="0 0 27 27" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <mask id="mask0_12_5027" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="5"
                                    y="5" width="18" height="18">
                                    <path
                                        d="M20.1562 6.75H7.96875C7.64552 6.75 7.33552 6.8784 7.10696 7.10696C6.8784 7.33552 6.75 7.64552 6.75 7.96875V20.1562C6.75 20.4795 6.8784 20.7895 7.10696 21.018C7.33552 21.2466 7.64552 21.375 7.96875 21.375H20.1562C20.4795 21.375 20.7895 21.2466 21.018 21.018C21.2466 20.7895 21.375 20.4795 21.375 20.1562V7.96875C21.375 7.64552 21.2466 7.33552 21.018 7.10696C20.7895 6.8784 20.4795 6.75 20.1562 6.75Z"
                                        fill="white" stroke="white" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M12.8438 16.9062L14.875 18.5312L18.125 14.4688M10 10.4062H18.125M10 13.6562H13.25"
                                        stroke="black" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </mask>
                                <g mask="url(#mask0_12_5027)">
                                    <path class="icon @if (request()->routeIs('user.transactions.index')) active @endif"
                                        d="M4.3125 4.3125H23.8125V23.8125H4.3125V4.3125Z" fill="white"
                                        fill-opacity="0.45" />
                                </g>
                            </svg>
                            My Transactions
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="fixed-header">
            <section class="w-full">
                <div class="flex justify-between items-center">
                    <button class="xl:hidden p-2 text-white rounded" id="toggle-sidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgb(255, 255, 255);">
                            <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"></path>
                        </svg>
                    </button>

                    <aside class="w-full lg:px-10">
                        <div class="flex justify-end p-2">
                            <button id="right_dropdown_btn"
                                class="flex items-center justify-center gap-2 text-lg text-[#979797] hover:text-white">
                                <img src="{{ asset('storage/profile/' . user()->photo) }}" alt="profile"
                                    class="rounded-full" style="width: 40px; height: 40px;">
                                <span>{{ user()->username }}</span>
                                <img src="{{ asset('/assets/templates/valent/images/icon/dropdown_icon.svg') }}"
                                    alt="icon">
                            </button>
                        </div>
                    </aside>
                </div>

                <aside id="right-dropdown"
                    class="hidden absolute z-20 right-0 lg:w-[300px] bg-[#2d3039] bg-opacity-70 rounded-xl p-0 m-0">
                    <div class=" bg-[#2d3039] bg-opacity-70 rounded-xl">
                        <ul class="py-6 px-10 mb-12">
                            <li class="mb-3"><a href="{{ route('user.profile.index') }}"
                                    class="text-white text-xl flex gap-2"><img
                                        src="{{ asset('/assets/templates/valent/images/icon/user_icon.svg') }}"
                                        alt="icon"> My Profile</a></li>
                            <li class="mb-3"><a href="{{ route('user.profile.edit') }}"
                                    class="text-white text-xl flex gap-2"><img
                                        src="{{ asset('/assets/templates/valent/images/icon/user_edit_icon.svg') }}"
                                        alt="icon">Edit Profile</a></li>
                            <li class="mb-3"><a href="{{ route('user.kyc.index') }}"
                                    class="text-white text-xl flex gap-2"><img
                                        src="{{ asset('/assets/templates/valent/images/icon/kyc_icon.svg') }}"
                                        alt="icon">KYC</a></li>
                        </ul>
                        <div
                            class="absolute bottom-0 left-0 right-0 flex items-center justify-center bg-[#EA0E11] rounded-b-xl">
                            <form action="{{ route('user.logout') }}" method="post" class=" gen-form"
                                data-action="redirect" data-url="{{ url('/') }}">
                                @csrf
                                <button type="submit" role="button"
                                    class="text-xl text-center text-white px-4 py-2 rounded flex gap-2 slogout">
                                    <img src="{{ asset('/assets/templates/valent/images/icon/logout_icon.svg') }}"
                                        alt="icon"> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </aside>

            </section>
        </div>

        <!-- Main Content -->
        <div id="main-content" class="flex-1 relative container mx-auto xl:max-w-screen-xl" data-aos="fade-left">




            <!-- Main Body-->
            <main id="main" class="px-4 py-10">

                @yield('contents')

                {{-- logout --}}
                {{-- <div id="logOutModal"
                    class="h-screen fixed inset-0 bg-opacity-50 flex  items-center justify-end lg:px-6 px-2 hidden"
                    style="z-index: 50;">
                    <div class="bg-gradient-to-r from-[#0038A5] to-[#022058] rounded-lg lg:w-3/5 w-full lg:p-10 p-4 relative z-10 mt-20 lg:mr-20"
                        style="height:30vh;">

                        <div class="flex justify-end items-center lg:mb-10 mb-4">
                            <button id="closeLogOutModal" class="text-gray-400 hover:text-gray-600">
                                <img src="{{ asset('/assets/templates/valent/images/icon/close_icon.svg') }}"
                                    alt="icon">
                            </button>
                        </div>

                        <h2 class="text-xl font-semibold mb-4 text-white text-center">Do you really want to Logout?
                        </h2>

                        <!-- Modal Content -->
                        <form action="{{ route('user.logout') }}" method="post" class="mt-5 gen-form"
                            data-action="redirect" data-url="{{ url('/') }}">
                            @csrf

                            <div class="w-full">
                                <div class="text-center">
                                    <button type="submit"
                                        class="logoutBtn rounded-full px-10 py-2 lg:w-52 w-full transition delay-100 duration-200 ease-in-out ">
                                        <span class="px-2">Log Out</span>
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div> --}}

            </main>
            <!--End of main body-->

        </div>
    </div>

    {{-- qrcode --}}
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

    {{-- Include SweetAlert2 JavaScript file --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('/assets/templates/valent/scripts/dashboard_main.js') }}"></script>

    @yield('scripts')
    @stack('scripts')


    {{-- logout --}}
    {{-- <script>
        // Open Logout Modal  
        $(document).on("click", ".logout", function() {
            $("#logOutModal").removeClass("hidden");
            $("#right-dropdown").addClass("hidden");
        });

        // Close Logout Modal  
        $(document).on("click", "#closeLogOutModal", function() {
            $("#logOutModal").addClass("hidden");
        });

        // Close modal when clicking outside  
        $(document).on("click", function(e) {
            if (!$(e.target).closest("#logOutModalContent").length && !$(e.target).is(".logout")) {
                $("#logOutModal").addClass("hidden");
            }
        });
    </script> --}}

    {{-- livechat --}}
    {!! json_decode(site('livechat')) !!}



</body>

</html>

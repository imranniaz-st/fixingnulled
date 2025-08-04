@php
    use App\Models\DepositCoin;
    use App\Models\Bot;
    use Faker\Factory as Faker;

    $page_title = 'Home';
    $faker = Faker::create();
    //    $logos = DepositCoin::inRandomOrder()->take(20)->get('logo_url');

    $bots = Bot::get();

    // $deposit_methods = ['usdttrc20'];
    // $methods = DepositCoin::where('status', 1)->get();
    // foreach ($methods as $method) {
    //     array_push($deposit_methods, $method->code);
    // }

    // // Check if the count is less than 20
    // while (count($deposit_methods) < 20) {
    //     $deposit_methods[] = 'usdttrc20';
    // }

    $actions = [
        'deposited',
        'withdrew',
        'withdrew',
        'deposited',
        'withdrew',
        'deposited',
        'withdrew',
        'withdrew',
        'withdrew',
        'withdrew',
        'withdrew',
        'withdrew',
    ];

    $whys = [
        'Cutting-Edge Precision',
        'Trendsetter Advantage',
        'Adaptive Excellence',
        'Seamless Profits',
        'Data-Driven Triumph',
        'Strategic Partner',
        'Constant Success',
        'Market Pioneer',
        'Automated Mastery',
    ];
    $reviews = [
        [
            'image' => 'review-image-1.jpg',
            'name' => 'Adrian',
            'country' => 'UK',
            'testimony' =>
                site('name') .
                "'s precision trading is a game-changer, consistently delivering impressive profits. I trust it for my financial success.",
            'date' => '5/03/2023',
        ],
        [
            'image' => 'review-image-2.jpg',
            'name' => 'Madison',
            'country' => 'USA',
            'testimony' =>
                'Effortless trading with ' .
                site('name') .
                '. Its adaptability and data-driven approach make it a standout choice. Highly recommended!',
            'date' => '7/02/2024',
        ],
        [
            'image' => 'review-image-3.jpg',
            'name' => 'Schneider',
            'country' => 'Germany',
            'testimony' =>
                'Seamless trades, constant profits - ' .
                site('name') .
                " simplifies trading. It's a must-have for anyone in the market.",
            'date' => '5/04/2024',
        ],
        [
            'image' => 'review-image-4.jpg',
            'name' => 'Tommy',
            'country' => 'South Africa',
            'testimony' =>
                site('name') .
                "'s innovative strategies and consistent returns have transformed my trading experience. It's a valuable asset to any trader.",
            'date' => '2/05/2024',
        ],
        [
            'image' => 'review-image-5.jpg',
            'name' => 'Jannet',
            'country' => 'USA',
            'testimony' =>
                'I rely on ' .
                site('name') .
                " for its adaptability in fluctuating markets. It's a proven partner in achieving financial goals.",
            'date' => '13/06/2024',
        ],
        [
            'image' => 'review-image-6.jpg',
            'name' => 'Thomas',
            'country' => 'England',
            'testimony' =>
                site('name') .
                "'s automated precision is remarkable. It's a powerful tool for navigating today's complex trading landscape.",
            'date' => '27/08/2024',
        ],
        [
            'image' => 'review-image-7.jpg',
            'name' => 'Atlan',
            'country' => 'Germany',
            'testimony' =>
                'Maximized profits with ' .
                site('name') .
                '. Its results speak volumes. A reliable and intelligent trading companion.',
            'date' => '1/10/2024',
        ],
        [
            'image' => 'review-image-8.jpg',
            'name' => 'Kelvin',
            'country' => 'UK',
            'testimony' =>
                'Trading with ' .
                site('name') .
                ' is effortless and rewarding. It adapts to market changes seamlessly. Truly impressive!',
            'date' => '15/10/2024',
        ],
        [
            'image' => 'review-image-9.jpg',
            'name' => 'Jude',
            'country' => 'Canada',
            'testimony' =>
                site('name') .
                ' has changed my trading game. Its data-driven approach delivers consistent gains. An invaluable tool for success.',
            'date' => '7/11/2024',
        ],
        [
            'image' => 'review-image-10.jpg',
            'name' => 'Jude',
            'country' => 'Australia',
            'testimony' =>
                'Effortless trading made possible by ' .
                site('name') .
                ' .  Its strategic prowess sets it apart. A game-changer for traders.',
            'date' => '23/1/2025',
        ],
    ];

    $short_description = site('seo_description');

@endphp

@extends('templates.' . site('template') . '.layouts.front')

@section('css')
    <style>
        .splide__arrow {
            border-radius: 50%;
            padding: 10px;
            z-index: 10;
            display: none;
        }

        .splide__arrow--prev {
            left: -40px;
            /* Position left arrow outside */
        }

        .splide__arrow--next {
            right: -40px;
            /* Position right arrow outside */
        }

        .gecko-watermark {
            display: none !important;
        }

        .testimonial-contaiiner {
            max-height: 50vh;
        }

        .testimonial-button {
            transform: translateY(110px);
        }
    </style>
@endsection

@section('header')
    <div class="w-[90%] mx-auto lg:h-[100vh] h-auto flex items-center justify-center overflow-hidden">
        <div class="max-w-screen-lg text-center lg:mt-20 mt-32 animate-pulse">
            <p class="text-white font-bold lg:text-6xl text-2xl lg:mb-3"><span
                    class="font-bold bg-gradient-to-r from-[#3F7DF2] to-[#09C241] bg-clip-text text-transparent">Seamless
                    Trading, </span> Consistent</p>
            <p class="text-white font-bold lg:text-6xl text-xl lg:mb-10 mb-4"><span
                    class="font-bold bg-gradient-to-r from-[#3F7DF2] to-[#09C241] bg-clip-text text-transparent">Profits -
                    Powered by </span> AI Brilliance</p>
            <p class="lg:text-2xl text-lg bg-gradient-to-r from-[#ffffff] to-[#B4B1B1] bg-clip-text text-transparent">
                {{ site('name') }} leverages cutting-edge AI robots, meticulously trained on vast trading data and
                sophisticated algorithms, to decode market trends and execute trades with pinpoint accuracy. Our AI bots
                consistently deliver an impressive average of 5% daily PNL.</p>

            <div class="flex justify-center gap-10 py-20 text-center">
                <a href="{{ route('user.register') }}"
                    class="border lg:w-52 rounded-full lg:py-4 py-2 px-10 block text-center text-white text-lg  bg-gradient-to-r from-[#306FE6] via-[#3b82f6] to-[#0040BC] hover:text-[#0040BC] hover:bg-gradient-to-r hover:from-[#3F7DF2] hover:via-[#FFFFFF] hover:to-[#09C241] transition delay-100 duration-200 ease-in-out">Sign
                    Up</a>
                <a href="{{ route('user.login') }}"
                    class="border rounded-full lg:py-4 py-2 px-10 block text-center text-white text-lg animate_card ">Login</a>
            </div>

        </div>
    </div>
@endsection



@section('contents')
    {{-- slider for icons --}}
    <section class="w-full mb-10 bg-blue-300 bg-opacity-15" data-aos="fade-up">
        <div class="w-[90%] mx-auto py-10">
            <div class="flex items-center justify-center w-full">
                <div class="glide w-full px-10">
                    <div class="glide__track" data-glide-el="track">
                        <ul class="glide__slides gap-10">
                            <li class="glide__slide"><img
                                    src="{{ asset('/assets/templates/valent/images/front_icon/slide_image.svg') }}"
                                    alt="icon"></li>
                            <li class="glide__slide"><img
                                    src="{{ asset('/assets/templates/valent/images/front_icon/slide_image1.svg') }}"
                                    alt="icon"></li>
                            <li class="glide__slide"><img
                                    src="{{ asset('/assets/templates/valent/images/front_icon/slide_image2.svg') }}"
                                    alt="icon"></li>
                            <li class="glide__slide"><img
                                    src="{{ asset('/assets/templates/valent/images/front_icon/slide_image3.svg') }}"
                                    alt="icon"></li>
                            <li class="glide__slide"><img
                                    src="{{ asset('/assets/templates/valent/images/front_icon/slide_image4.svg') }}"
                                    alt="icon"></li>
                            <li class="glide__slide"><img
                                    src="{{ asset('/assets/templates/valent/images/front_icon/slide_image5.svg') }}"
                                    alt="icon"></li>
                            <li class="glide__slide"><img
                                    src="{{ asset('/assets/templates/valent/images/front_icon/slide_image6.svg') }}"
                                    alt="icon"></li>
                            <li class="glide__slide"><img
                                    src="{{ asset('/assets/templates/valent/images/front_icon/slide_image7.svg') }}"
                                    alt="icon"></li>
                            <li class="glide__slide"><img
                                    src="{{ asset('/assets/templates/valent/images/front_icon/slide_image8.svg') }}"
                                    alt="icon"></li>
                            <li class="glide__slide"><img
                                    src="{{ asset('/assets/templates/valent/images/front_icon/slide_image9.svg') }}"
                                    alt="icon"></li>
                            <li class="glide__slide"><img
                                    src="{{ asset('/assets/templates/valent/images/front_icon/slide_image10.svg') }}"
                                    alt="icon"></li>
                            <li class="glide__slide"><img
                                    src="{{ asset('/assets/templates/valent/images/front_icon/slide_image11.svg') }}"
                                    alt="icon"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- unlocking market --}}
    <section class="w-full mb-10 py-10" data-aos="fade-up">
        <div class="w-[90%] mx-auto mb-10 px-3">
            <div class="grid lg:grid-cols-3 grid-cols-1 gap-3">
                <div class="col-span-2">
                    <p class="text-white font-bold lg:text-5xl text-2xl lg:mb-3 leading-relaxed">
                        <span
                            class="font-bold bg-gradient-to-r from-[#3F7DF2] to-[#09C241] bg-clip-text text-transparent leading-relaxed">Unlocking
                            Markets, </span>Amplifying <br> Returns
                    </p>
                </div>
                <div class="lg:px-4">
                    <p class="text-[#B4B1B1] lg:text-2xl text-lg leading-[1.75]">
                        Your ultimate trading companion, utilizing cutting-edge technology to unlock new market potentials
                        and amplify your investment returns like never before.
                    </p>
                </div>
            </div>
        </div>

        {{-- card --}}
        <div class="w-[90%] mx-auto mb-10 px-3">
            <div class="grid lg:grid-cols-3 grid-cols-1 text-white">
                <div class="col-span-1 relative mb-3">
                    <div class="lg:absolute bottom-0 bg-white bg-opacity-10 py-10 px-10 rounded-l-3xl">
                        <p
                            class="text-4xl font-bold mb-10 bg-gradient-to-r from-[#3F7DF2] to-[#0040BC] bg-clip-text text-transparent">
                            01</p>
                        <p class="text-xl font-bold mb-10">Guaranteed Profit</p>
                        <p class="">Leveraging advanced technology to navigate challenging market conditions, ensuring
                            your financial goals remain achievable even in bearish market scenarios.</p>
                    </div>
                </div>

                <div class="col-span-1 mb-3">
                    <div class="py-20 px-10 bg-gradient-to-r from-[#0040BC] to-[#031A45] rounded-t-3xl">
                        <p class="text-4xl font-bold mb-10">02</p>
                        <p class="text-xl font-bold mb-10">Automated Process</p>
                        <p class="text-xl mb-5">Our advanced technology streamlines processes, allowing you to navigate
                            markets seamlessly and achieve maximum success.</p>
                        <p class="text-xl">Navigate uncertainty with {{ site('name') }}</p>
                    </div>
                </div>

                <div class="col-span-1 relative mb-3">
                    <div class="lg:absolute bottom-0 bg-white bg-opacity-10 py-10 px-10 rounded-r-3xl">
                        <p
                            class="text-4xl font-bold mb-10 bg-gradient-to-r from-[#3F7DF2] to-[#0040BC] bg-clip-text text-transparent">
                            03</p>
                        <p class="text-xl font-bold mb-10">Bullish Or Bearish</p>
                        <p class="">Harness the power of our Guaranteed Profit approach and let AI elevate your
                            trading endeavors, ensuring consistent gains.</p>
                    </div>
                </div>
            </div>
        </div>

    </section>

    {{-- slider for coins --}}
    <section class="w-full mb-10 bg-blue-200 bg-opacity-15" data-aos="fade-up">
        <div class="flex justify-center py-10">
            <div class="livecoinwatch-widget-5" lcw-base="USD" lcw-color-tx="#ffffff" lcw-marquee-1="coins"
                lcw-marquee-2="movers" lcw-marquee-items="10"></div>
        </div>
    </section>

    {{-- prcicng --}}
    <section class="w-full mb-10" data-aos="fade-up">
        <div class="w-[90%] mx-auto py-10 px-3">
            <div class="w-full mb-10">
                <p class="text-center text-[#B4B1B1] text-lg">Pricing</p>
                <p class="text-white font-bold lg:text-5xl text-2xl lg:mb-3 leading-relaxed text-center">
                    <span
                        class="font-bold bg-gradient-to-r from-[#3F7DF2] via-[#09C241] to-[#ffffff] to-[70%] bg-clip-text text-transparent leading-relaxed">AI
                        Trading Portfolios</span>
                </p>
            </div>

            <div class="w-full mb-10">
                <div class="grid lg:grid-cols-3 grid-cols-1 gap-10">

                    @foreach ($bots as $bot)
                        <div
                            class="col-span-1 relative bg-[#020E25] text-white p-6 rounded-xl border border-transparent shadow-lg before:absolute before:inset-0 before:-m-0.5 before:rounded-xl before:bg-gradient-to-t before:from-[#ffffff4f] before:via-[#09C241]  before:to-[#3F7DF2] before:-z-10">
                            <div class="flex gap-4 mb-4">
                                <img src="{{ asset('storage/bots/' . $bot->logo) }}" alt="icon"
                                    class="rounded-full h-7 w-7">
                                <p class="text-white">{{ $bot->name }}</p>
                            </div>

                            <div class="flex text-white py-10 justify-center items-center gap-4">
                                <p class="lg:text-6xl text-4xl font-extrabold">{{ $bot->daily_min }}% -
                                    {{ $bot->daily_max }}%</p>
                                <p class="font-bold">/day</p>
                            </div>

                            <div class="block lg:py-7 py-4">
                                <p class="flex justify-between">
                                    <span class="block text-[#B4B1B1] text-left">Portfolio Range</span>
                                    <span class="block text-white text-right">{{ site('currency_symbol') . $bot->min }} -
                                        {{ site('currency_symbol') . $bot->max }}</span>
                                </p>

                                <p class="flex justify-between">
                                    <span class="block text-[#B4B1B1] text-left">Daily PNL</span>
                                    <span class="block text-white text-right">{{ $bot->daily_min }}% -
                                        {{ $bot->daily_max }}%</span>
                                </p>

                                <p class="flex justify-between">
                                    <span class="block text-[#B4B1B1] text-left">Trading Duration</span>
                                    <span class="block text-white text-right">{{ $bot->duration }}
                                        {{ $bot->duration_type }}</span>
                                </p>

                                <p class="flex justify-between">
                                    <span class="block text-[#B4B1B1] text-left">Capital Returned</span>
                                    <span class="block text-white text-right">Yes</span>
                                </p>
                            </div>

                            <div class="block text-center lg:py-7">
                                <a href="{{ route('user.bots.index') }}"
                                    class="border rounded-full lg:py-4 py-2 px-10 block text-center text-white text-lg hover:bg-gradient-to-r hover:from-[#3F7DF2] from-[50%] hover:via-[#09C241] via-[30%] hover:to-[#ffffff] to-[70%] hover:bg-clip-text hover:text-transparent">Activate</a>
                            </div>

                            <div class="block lg:py-7 py-4">
                                <p class="text-white font-bold mb-3">Tradings Days</p>
                                @php
                                    $trading_days_display = [
                                        'monday' => in_array('monday', json_decode(site('trading_days'))),
                                        'tuesday' => in_array('tuesday', json_decode(site('trading_days'))),
                                        'wednesday' => in_array('wednesday', json_decode(site('trading_days'))),
                                        'thursday' => in_array('thursday', json_decode(site('trading_days'))),
                                        'friday' => in_array('friday', json_decode(site('trading_days'))),
                                        'saturday' => in_array('saturday', json_decode(site('trading_days'))),
                                        'sunday' => in_array('sunday', json_decode(site('trading_days'))),
                                    ];
                                @endphp
                                @foreach ($trading_days_display as $day => $day_display)
                                    <p class="flex justify-between">
                                        @if (in_array($day, json_decode(site('trading_days'))))
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4.5 9L7.5 12L13.5 6" stroke="url(#paint0_linear_138_1407)"
                                                    stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                                                <defs>
                                                    <linearGradient id="paint0_linear_138_1407" x1="2.52439"
                                                        y1="10.2353" x2="15.0389" y2="10.0987"
                                                        gradientUnits="userSpaceOnUse">
                                                        <stop stop-color="#3F7DF2" />
                                                        <stop offset="1" stop-color="#0040BC" />
                                                    </linearGradient>
                                                </defs>
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="w-4 h-4 text-red-500" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                            </svg>
                                        @endif
                                        <span class="block text-[#B4B1B1] text-left ">{{ ucfirst($day) }}</span>
                                    </p>
                                @endforeach

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

    {{-- why choose us --}}
    <section class="w-full mb-10" data-aos="fade-up">
        <div class="w-[90%] mx-auto lg:py-10 px-3">

            <div class="grid lg:grid-cols-2 grid-cols-1">
                <div class="col-span-1 mb-6">
                    <img src="{{ asset('/assets/templates/valent/images/why-choose_us_frame.svg') }}" alt="why_us"
                        class="block lg:h-[816.73px] animate-pulse">
                </div>

                <div class="col-span-1 h-full">
                    <div class="flex items-center h-full">
                        <div class="flex-1 justify-end">
                            <div class="w-full">
                                <p class="text-sm text-[#B4B1B1] lg:text-right text-center">Supercharged Ai</p>
                                <p
                                    class="text-white font-bold lg:text-5xl text-2xl lg:mb-3 leading-relaxed lg:text-right text-center">
                                    <span
                                        class="font-bold bg-gradient-to-r from-[#3F7DF2] via-[#09C241] to-[#ffffff] to-[70%] bg-clip-text text-transparent leading-relaxed">Why
                                        Choose {{ site('name') }}?</span>
                                </p>
                            </div>

                            <div class="flex justify-end">
                                <div class="max-w-xl ">
                                    <p
                                        class="text-[#B4B1B1]  lg:text-2xl text-lg lg:text-right text-center leading-relaxed font-light">
                                        {{ site('name') }} doesn't just follow trends - it pioneers them. It empowers
                                        traders to navigate both bullish and bearish market conditions with unwavering
                                        confidence. By leveraging sophisticated algorithms and real-time data streams,
                                        {{ site('name') }} adapts to ever-changing market dynamics, seizing opportunities
                                        while minimizing risks.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <img src="{{ asset('/assets/templates/valent/images/bitcoin-3d-illustration 1.png') }}" alt="crypto"
                    class="absolute mt-[40rem] right-0 lg:block hidden -z-10 animate-pulse">
            </div>
        </div>
    </section>

    {{-- how it works --}}
    <section class="w-full mb-10" data-aos="fade-up">
        <div class="w-[90%] mx-auto py-10 px-3">


            <div class="grid lg:grid-cols-2 grid-cols-1">
                <div class="col-span-1 mb-6">
                    <div class="w-full">
                        <p class="text-sm text-[#B4B1B1] lg:text-left text-center">Getting started</p>
                        <p
                            class="text-white font-bold lg:text-5xl text-2xl lg:mb-3 leading-relaxed lg:text-left text-center">
                            <span
                                class="font-bold bg-gradient-to-r from-[#3F7DF2] to-[#09C241] bg-clip-text text-transparent leading-relaxed">How
                                It Works</span>
                        </p>
                        <img src="{{ asset('/assets/templates/valent/images/crypto_coin_illustration_3d.png') }}"
                            alt="crypto" class="absolute left-0 lg:block hidden -z-10 animate-pulse">
                        <div class="max-w-xl">
                            <p
                                class="text-[#B4B1B1] lg:text-2xl text-lg lg:text-left text-center leading-relaxed font-light ">
                                Our user-friendly interface and intuitive features ensure that even newcomers can quickly
                                grasp the essentials and embark on a seamless journey into the world of efficient and
                                profitable trading.</p>
                        </div>
                    </div>
                </div>

                <div class="col-span-1 mb-6">
                    <div class="w-full text-white">
                        <section class="p-6 rounded-md shadow-lg  mx-auto">
                            <div class="relative flex flex-col items-center">

                                <!-- Step 1: Sign Up (Left) -->
                                <div class="flex items-center w-full">
                                    <div class="w-1/2 text-right pr-4">
                                        <p class="text-lg font-semibold mb-4">Step 1</p>
                                        <p class="text-sm font-medium">Sign Up</p>
                                        <span class="text-sm text-[#B4B1B1]">Signing up is a breeze - just a few clicks,
                                            and you're in.</span>
                                    </div>
                                    <div class="relative flex flex-col items-center">
                                        <span class="block w-4 h-4 bg-[#3F7DF2] rounded-full"></span>
                                        <span class="w-1 lg:h-28 h-48 bg-[#3F7DF2]"></span>
                                    </div>
                                    <div class="w-1/2"></div>
                                </div>

                                <!-- Step 2: Deposit (Right) -->
                                <div class="flex items-center w-full">
                                    <div class="w-1/2"></div>
                                    <div class="relative flex flex-col items-center">
                                        <span
                                            class="block w-4 h-4 bg-[#3F7DF2] border border-blue-500 rounded-full"></span>
                                        <span class="w-1 lg:h-28 h-48 bg-white"></span>
                                    </div>
                                    <div class="w-1/2 text-left pl-4">
                                        <p class="text-lg font-semibold mb-4">Step 2</p>
                                        <p class="text-sm font-medium">Deposit Funds</p>
                                        <span class="text-sm text-[#B4B1B1]">Add money to your {{ site('name') }}
                                            following our user friendly funding system.</span>
                                    </div>
                                </div>

                                <!-- Step 3: Activate (Left) -->
                                <div class="flex items-center w-full">
                                    <div class="w-1/2 text-right pr-4">
                                        <p class="text-lg font-semibold mb-4">Step 3</p>
                                        <p class="text-sm font-medium">Activate Bot</p>
                                        <span class="text-sm text-[#B4B1B1]">Select from our wide range of AI trading bots
                                            and activate a portfolio.</span>
                                    </div>
                                    <div class="relative flex flex-col items-center">
                                        <span class="block w-4 h-4 bg-white rounded-full"></span>
                                        <span class="w-1 lg:h-28 h-48 bg-[#3F7DF2]"></span>
                                    </div>
                                    <div class="w-1/2"></div>
                                </div>

                                <!-- Step 4: Withdrawal (Right) -->
                                <div class="flex items-center w-full">
                                    <div class="w-1/2"></div>
                                    <div class="relative flex flex-col items-center">
                                        <span
                                            class="block w-4 h-4 bg-[#3F7DF2] border border-[#3F7DF2] rounded-full"></span>
                                        <span class="w-1 lg:h-28 h-48 bg-white"></span>
                                    </div>
                                    <div class="w-1/2 text-left pl-4">
                                        <p class="text-lg font-semibold mb-4">Step 4</p>
                                        <p class="text-sm font-medium">Withdraw</p>
                                        <span class="text-sm text-[#B4B1B1]">Withdraw your capital and profits to your
                                            external wallet at anytime.</span>
                                    </div>
                                </div>

                                <!-- Step 3: Activate (Left) -->
                                <div class="flex items-center w-full">
                                    <div class="w-1/2"></div>
                                    <div class="relative flex flex-col items-center">
                                        <span class="block w-4 h-4 bg-white rounded-full"></span>
                                    </div>
                                    <div class="w-1/2"></div>
                                </div>

                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- testimonials --}}
    <section class="w-full mb-10 overflow-hidden" data-aos="fade-up">
        <div class="w-[90%] mx-auto lg:py-10 px-3">
            <div class="w-full lg:flex justify-between">
                <div class="max-w-2xl">
                    <p class="text-white font-bold lg:text-5xl text-2xl lg:mb-3 leading-relaxed lg:text-left text-center">
                        <span
                            class="font-bold bg-gradient-to-r from-[#3F7DF2] via-[#09C241] to-[#ffffff] to-[70%] bg-clip-text text-transparent leading-relaxed">Dont
                            Just Take Our Word <br> for it</span>
                    </p>
                </div>

                <div class="max-w-md">
                    <p class="text-[#B4B1B1]  lg:text-2xl text-lg lg:text-left text-center leading-relaxed font-light ">
                        Here is what our many users around the world are saying about our amazing product.</p>
                </div>
            </div>

            <div class="w-full relative testimonial-contaiiner">

                <!-- Custom Navigation Buttons -->
                <div class="lg:flex hidden justify-between mt-6 w-full absolute h-full testimonial-button">
                    <button id="prevBtn"
                        class="bg-white bg-opacity-15 text-white px-4 py-2 rounded-l-3xl border border-opacity-15 border-white h-28">
                        <img src="{{ asset('/assets/templates/valent/images/front_icon/white-typcn_arrow-left.svg') }}"
                            alt="icon">
                    </button>
                    <button id="nextBtn"
                        class="bg-gradient-to-r from-[#3F7DF2] to-[#0040BC] text-white px-4 py-2 rounded-r-3xl border border-opacity-15 border-white h-28">
                        <img src="{{ asset('/assets/templates/valent/images/front_icon/white-typcn_arrow-right.svg') }}"
                            alt="icon">
                    </button>
                </div>

                <!--slide-->
                <div id="testimonial-slider" class="splide lg:w-[90%] mx-auto">
                    <div class="splide__track">
                        <ul class="splide__list gap-2">
                            <!-- Testimonial 1 -->
                            @foreach ($reviews as $review)
                                <li class="splide__slide p-4">
                                    <div class="block lg:p-20 p-10  bg-blue-200 bg-opacity-15 border rounded-lg shadow-md">
                                        <div class="lg:flex justify-between items-center">
                                            <div class="flex gap-4">
                                                <img src="{{ asset('/assets/templates/valent/images/' . $review['image']) }}"
                                                    alt="icon" class="rounded-full h-10 w-10">
                                                <div>
                                                    <p class="text-lg text-white">{{ $review['name'] }}</p>
                                                    <p class="text-[#B4B1B1] ">{{ $review['country'] }}</p>
                                                </div>
                                            </div>

                                            <div class="flex gap-2">
                                                <img src="{{ asset('/assets/templates/valent/images/front_icon/yellow_symbols_star.svg') }}"
                                                    alt="star" class="h-4 w-4">
                                                <img src="{{ asset('/assets/templates/valent/images/front_icon/yellow_symbols_star.svg') }}"
                                                    alt="star" class="h-4 w-4">
                                                <img src="{{ asset('/assets/templates/valent/images/front_icon/yellow_symbols_star.svg') }}"
                                                    alt="star" class="h-4 w-4">
                                                <img src="{{ asset('/assets/templates/valent/images/front_icon/yellow_symbols_star.svg') }}"
                                                    alt="star" class="h-4 w-4">
                                                <img src="{{ asset('/assets/templates/valent/images/front_icon/yellow_symbols_star.svg') }}"
                                                    alt="star" class="h-4 w-4">
                                            </div>
                                        </div>

                                        <div class="w-full py-14">
                                            <p class="lg:text-2xl text-lg text-white">{{ $review['testimony'] }}</p>
                                        </div>

                                        <div class="w-full">
                                            <p class="text-[#B4B1B1] ">{{ $review['date'] }}</p>
                                        </div>

                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- market data --}}
    <section class="w-full mb-10" data-aos="fade-up">
        <div class="w-[90%] mx-auto py-10 px-3">
            <div class="w-full">
                <p class="text-sm text-[#B4B1B1] text-center">Market Data</p>
                <p class="text-white font-bold lg:text-5xl text-2xl lg:mb-3 leading-relaxed text-center">
                    <span
                        class="font-bold bg-gradient-to-r from-[#3F7DF2] via-[#09C241] to-[#ffffff] to-[70%] bg-clip-text text-transparent leading-relaxed">Market
                        HeatMap</span>
                </p>
            </div>

            <div id="cryptoApp" class="p-4">
                <div class="w-full grid lg:grid-cols-5 grid-cols-2 lg:gap-10 gap-3">
                    <!-- Coins will be appended here by jQuery -->
                </div>
            </div>

        </div>
    </section>

    {{-- trade from anywhere --}}
    <section class="w-full mb-10 bg-cover bg-no-repeat bg-center"
        style="background-image: url({{ asset('/assets/templates/valent/images/earth_gradient.png') }}"
        data-aos="fade-up">
        <div class="w-[90%] mx-auto py-4 px-3">
            <div class="w-full py-10 mb-10">
                <p class="text-white font-bold lg:text-5xl text-2xl lg:mb-3 leading-relaxed text-center">
                    <span
                        class="font-bold bg-gradient-to-r from-[#3F7DF2] via-[#09C241] to-[#ffffff] to-[70%] bg-clip-text text-transparent leading-relaxed">Trade
                        From Anywhere</span>
                </p>
                <div class="max-w-screen-lg mx-auto">
                    <p class="lg:text-2xl text-lg text-[#B4B1B1] text-center">Whether you're at home or on the go, seize
                        market opportunities anytime, anywhere, and secure your financial future effortlessly. Trade from
                        any and every city</p>
                </div>
            </div>

            <div class="w-full bg-blue-200 bg-opacity-10 border border-opacity-15 border-white p-10 rounded-3xl">
                <p class="text-2xl text-white mb-6">Recent Trades by {{ site('name') }}</p>

                <div class="block overflow-auto w-full max-h-[60vh]">
                    <table class="w-full">
                        <thead class="text-center text-white">
                            <th class="p-6 text-left lg:min-w-52 min-w-[40vw]">Market</th>
                            <th class="p-6 text-right lg:min-w-52 min-w-[40vw]">Price</th>
                            <th class="p-6 text-right lg:min-w-52 min-w-[40vw]">Time</th>
                            <th class="p-6 text-right lg:min-w-52 min-w-[40vw]">PNL</th>
                        </thead>
                        <tbody id="tradeTableBody"></tbody>
                    </table>
                </div>

            </div>


        </div>
    </section>

    {{-- unlocking wealth --}}
    <section class="w-full mb-10" data-aos="fade-up">
        <div class="w-[90%] mx-auto py-10 px-3">
            <div class="grid lg:grid-cols-2">
                <div class="col-span-1">
                    <img src="{{ asset('/assets/templates/valent/images/laptop_chart_balls.png') }}" alt="crypto"
                        class="absolute left-0 lg:block hidden -z-10 animate-pulse">
                </div>
                <div class="col-span-1 flex lg:justify-end items-center lg:h-[60vh]">
                    <div class="w-full">
                        <p
                            class="text-white font-bold lg:text-5xl text-2xl lg:mb-3 leading-relaxed lg:text-right text-center">
                            <span
                                class="font-bold bg-gradient-to-r from-[#3F7DF2] via-[#09C241] to-[#ffffff] to-[70%] bg-clip-text text-transparent leading-relaxed">Unlocking
                                Wealth <br> with Simplicity</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


<script src="https://widgets.coingecko.com/gecko-coin-price-chart-widget.js"></script>
<script defer src="https://www.livecoinwatch.com/static/lcw-widget.js"></script>
<script type="text/javascript" src="https://files.coinmarketcap.com/static/widget/coinPriceBlock.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.1/dist/js/splide.min.js"></script>

@section('scripts')
    <script>
        new Glide('.glide', {
            type: 'carousel',
            startAt: 0,
            perView: 9,
            focusAt: 'center',
            autoplay: 3000,
            hoverpause: true,
            gap: 6,
            rewind: true
        }).mount();
    </script>

    <script>
        ////////////////////// testimonials customized button
        $(document).ready(function() {
            var splide = new Splide('#testimonial-slider', {
                type: 'loop',
                perPage: 2,
                perMove: 1,
                autoplay: true,
                interval: 4000, // Adjust autoplay speed
                pauseOnHover: true,
                pagination: false, // Hide default pagination
                arrows: false, // Hide default arrows
                breakpoints: {
                    1024: {
                        perPage: 1, // Display 1 slide at a time on smaller screens
                    },
                },
            }).mount();

            // Custom Buttons Functionality
            $('#prevBtn').on('click', function() {
                splide.go('-1');
            });

            $('#nextBtn').on('click', function() {
                splide.go('+1');
            });
        });
    </script>

    <script>
        //recent trades table data

        let tradeData = @json(recentTrades());


        function updateTradeTable() {
            const tableBody = document.getElementById("tradeTableBody");
            tableBody.innerHTML = ""; // Clear existing rows

            tradeData.forEach((trade) => {
                const row = document.createElement("tr");
                row.className = `border-b border-opacity-25 border-blue-200 py-6 ${
                trade.profit.startsWith("-") ? "text-[#EA0A0E]" : "text-[#00AA39]"
                }`;

                row.innerHTML = `
                <td class="p-2 py-6"><p class="px-4">${trade.pair}</p></td>
                <td class="p-2 py-6 text-right"><p class="px-4">${trade.amount}</p></td>
                <td class="p-2 py-6 text-right"><p class="px-4 recent_trade_time"></p></td>
                <td class="p-2 py-6 text-right"><p class="px-4">${trade.profit}</p></td>
                `;

                tableBody.appendChild(row);
            });
        }

        function updateTradeTimes() {
            const tradeTimeElements = document.querySelectorAll('.recent_trade_time');
            const currentTime = new Date().toLocaleTimeString();

            tradeTimeElements.forEach((element) => {
                element.textContent = currentTime;
            });
        }

        // Function to swap first row to last every 2 seconds
        function rotateRows() {
            if (tradeData.length > 1) {
                const firstRow = tradeData.shift(); // Remove first row
                tradeData.push(firstRow); // Add it to the end
                updateTradeTable(); // Refresh the table with new order
                updateTradeTimes();
            }
        }

        // Initial table setup
        updateTradeTable();

        // Start row rotation every 2 seconds
        setInterval(rotateRows, 1000);
    </script>

    <script>
        //////////////////////// Market heatmap data
        $(document).ready(function() {
            const coins = [{
                    id: "bitcoin",
                    name: "Bitcoin",
                    logo: "{{ asset('/assets/templates/valent/images/heatmarket_coin/bitcoin-btc-logo.png') }}",
                    price: 0,
                    change: 0,
                    symbol: "BTC",
                },
                {
                    id: "ethereum",
                    name: "Ethereum",
                    logo: "{{ asset('/assets/templates/valent/images/heatmarket_coin/ethereum-eth-logo.png') }}",
                    price: 0,
                    change: 0,
                    symbol: "ETH",
                },
                {
                    id: "ripple",
                    name: "Ripple",
                    logo: "{{ asset('/assets/templates/valent/images/heatmarket_coin/ripple-logo.webp') }}",
                    price: 0,
                    change: 0,
                    symbol: "XRP",
                },
                {
                    id: "binancecoin",
                    name: "Binance Coin",
                    logo: "{{ asset('/assets/templates/valent/images/heatmarket_coin/binance-coin-bnb-logo.png') }}",
                    price: 0,
                    change: 0,
                    symbol: "BNB",
                },
                {
                    id: "solana",
                    name: "Solana",
                    logo: "{{ asset('/assets/templates/valent/images/heatmarket_coin/solana-sol-logo.png') }}",
                    price: 0,
                    change: 0,
                    symbol: "SOL",
                },
                {
                    id: "dogecoin",
                    name: "Dogecoin",
                    logo: "{{ asset('/assets/templates/valent/images/heatmarket_coin/dogecoin-doge-logo.png') }}",
                    price: 0,
                    change: 0,
                    symbol: "DOGE",
                },
                {
                    id: "cardano",
                    name: "Cardano",
                    logo: "{{ asset('/assets/templates/valent/images/heatmarket_coin/cardano-ada-logo.png') }}",
                    price: 0,
                    change: 0,
                    symbol: "ADA",
                },
                {
                    id: "tron",
                    name: "Tron",
                    logo: "{{ asset('/assets/templates/valent/images/heatmarket_coin/tron-trx-logo.png') }}",
                    price: 0,
                    change: 0,
                    symbol: "TRX",
                },
                {
                    id: "avalanche-2",
                    name: "Avalanche",
                    logo: "{{ asset('/assets/templates/valent/images/heatmarket_coin/avalanche-avax-logo.png') }}",
                    price: 0,
                    change: 0,
                    symbol: "AVAX",
                },
                {
                    id: "sui",
                    name: "Sui",
                    logo: "{{ asset('/assets/templates/valent/images/heatmarket_coin/sui-sui-logo.png') }}",
                    price: 0,
                    change: 0,
                    symbol: "SUI",
                },
                {
                    id: "pepe",
                    name: "Pepe",
                    logo: "{{ asset('/assets/templates/valent/images/heatmarket_coin/pepe-pepe-logo.png') }}",
                    price: 0,
                    change: 0,
                    symbol: "PEPE",
                },
                {
                    id: "toncoin",
                    name: "Toncoin",
                    logo: "{{ asset('/assets/templates/valent/images/heatmarket_coin/toncoin-ton-logo.png') }}",
                    price: 0,
                    change: 0,
                    symbol: "TON",
                },
                {
                    id: "stellar",
                    name: "Stellar",
                    logo: "{{ asset('/assets/templates/valent/images/heatmarket_coin/stellar-xlm-logo.png') }}",
                    price: 0,
                    change: 0,
                    symbol: "XLM",
                },
                {
                    id: "chainlink",
                    name: "Chainlink",
                    logo: "{{ asset('/assets/templates/valent/images/heatmarket_coin/chainlink-link-logo.png') }}",
                    price: 0,
                    change: 0,
                    symbol: "LINK",
                },
                {
                    id: "shiba-inu",
                    name: "Shiba Inu",
                    logo: "{{ asset('/assets/templates/valent/images/heatmarket_coin/shiba-inu-shib-logo.png') }}",
                    price: 0,
                    change: 0,
                    symbol: "SHIB",
                },
            ];

            function fetchData() {
                const apiUrl =
                    `https://api.coingecko.com/api/v3/simple/price?ids=${coins.map(coin => coin.id).join(",")}&vs_currencies=usd&include_24hr_change=true`;

                $.ajax({
                    url: apiUrl,
                    type: "GET",
                    success: function(data) {
                        coins.forEach(coin => {
                            if (data[coin.id]) {
                                coin.price = parseFloat(data[coin.id].usd).toFixed(2);
                                coin.change = parseFloat(data[coin.id].usd_24h_change);
                            }
                        });
                        renderCoins();
                    },
                    error: function(error) {
                        console.error("Error fetching cryptocurrency data:", error);
                    }
                });
            }

            function renderCoins() {
                const container = $('#cryptoApp .grid');
                container.empty(); // Clear previous data before appending new

                coins.forEach(coin => {
                    const coinElement = `
                        <div class="bg-white bg-opacity-10 text-white p-4 rounded-lg shadow-md border-t-2 border-l-2 border-[#09C241] border-opacity-20">
                            <div class="flex items-center mb-4">
                                <img src="${coin.logo}" alt="${coin.name}" class="w-8 h-8 mr-2" />
                                <div>
                                    <h3 class="font-bold">${coin.name}</h3>
                                    <p class="text-sm text-gray-400">${coin.symbol}</p>
                                </div>
                            </div>
                            <p class="text-sm text-[#6F6A6A]">Price</p>
                            <p class="text-lg font-bold">$${coin.price}</p>
                            <p class="text-sm mt-2 ${coin.change > 0 ? 'text-green-500' : 'text-red-500'}">
                                ${coin.change > 0 ? '+' : ''}${coin.change.toFixed(2)}%
                            </p>
                        </div>
                    `;
                    container.append(coinElement);
                });
            }

            fetchData(); // Fetch data on page load
            setInterval(fetchData, 30000); // Refresh data every 30 seconds
        });
    </script>
@endsection

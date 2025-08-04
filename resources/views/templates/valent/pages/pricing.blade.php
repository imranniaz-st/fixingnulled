@php
    use App\Models\Bot;

    $page_title = 'AI Bot Pricing';
    $short_description = 'We have vering portfolio ranges for our bots. Select any hat best fits your pocket';
    $bots = Bot::get();

@endphp

{{-- layout --}}
@extends('templates.'. site('template') .'.layouts.front')


@section('css')
@endsection


@section('header')
    <div class="w-[90%] mx-auto lg:h-[545px] h-[30vh] flex items-center justify-center overflow-hidden">
        <div class="max-w-screen-lg text-center lg:mt-20 mt-32 lg:py-0 py-10" data-aos="fade-up">
            <p class="text-white font-light lg:text-9xl text-2xl lg:mb-3 lg:mt-44"><span class="font-bold">AI</span> Bot</p>
            <p class="lg:text-2xl text-lg text-white font-extralight"
                style="font-family: 'Noto Sans', sans-serif; font-weight: 100; ">
                <a href="" class="text-[#D8D8D8] text-opacity-45">Home</a> / <a href="">Ai Bots</a>
            </p>
        </div>
    </div>
@endsection


@section('contents')
    {{-- bots --}}
    <section class="w-full mb-10" data-aos="fade-up">
        <img src="{{ asset('/assets/templates/valent/images/3d-delivery-robot-working1.png') }}" alt="img"
            class="absolute right-0 lg:block hidden -z-10 animate-pulse w-[678px]">
        <div class="w-[90%] mx-auto py-10 b-">
            <div class="lg:flex justify-start items-center lg:h-[70vh]">
                <div class="col-span-1">
                    <p class="text-[#B4B1B1] lg:text-left text-center">Bots</p>
                    <p class="text-[#3F7DF2] lg:text-5xl text-2xl lg:mb-3 lg:text-left text-center">AI Bot</p>
                    <p class="text-white font-bold lg:text-7xl text-4xl lg:mb-3 lg:text-left text-center">Pricing </p>
                    <p
                        class="text-[#B4B1B1] lg:text-2xl text-lg leading-relaxed max-w-xl lg:text-left text-center lg:py-14 py-6">
                        {{ $short_description }}</p>
                </div>
                <div class="lg:hidden block">
                    <img src="{{ asset('/assets/templates/valent/images/3d-delivery-robot-working1.png') }}" alt="img"
                        class="lg:w-auto w-1/2 mx-auto animate-pulse">
                </div>
            </div>
        </div>
    </section>

    {{-- pricing --}}
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
                            class="col-span-1 relative bg-[#020E25] text-white p-6 rounded-xl border border-transparent shadow-lg  before:absolute before:inset-0 before:-m-0.5 before:rounded-xl before:bg-gradient-to-t before:from-[#ffffff4f] before:via-[#09C241]  before:to-[#3F7DF2] before:-z-10">
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
@endsection

@section('scripts')
@endsection

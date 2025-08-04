@php
    use App\Models\Bot;

    $page_title = 'FAQ';
    $short_description = 'Below are some frequently asked questions from our users';
    $faqs = [
        [
            'question' => 'What is ' . site('name') . '?',
            'answer' =>
                site('name') .
                ' is an advanced trading platform that utilizes AI technology to analyze market trends and execute trades with high precision.',
        ],
        [
            'question' => 'How can I get started with ' . site('name') . '?',
            'answer' =>
                'Getting started is simple. Sign up for an account, complete the verification process, and you can begin trading.',
        ],
        [
            'question' => 'Is my personal information secure with ' . site('name') . '?',
            'answer' =>
                'Yes, we take data security seriously. We employ industry-standard measures to protect your information.',
        ],
        [
            'question' => 'Can I trade on ' . site('name') . ' from anywhere?',
            'answer' =>
                'Absolutely ' . site('name') . ' allows you to trade from anywhere with an internet connection.',
        ],

        [
            'question' => 'Do I need prior trading experience to use ' . site('name') . '?',
            'answer' =>
                'No, ' .
                site('name') .
                ' is designed for both beginners and experienced traders. We offer educational resources to help you get started.',
        ],
        [
            'question' => 'What fees are associated with using ' . site('name') . '?',
            'answer' =>
                'We charge competitive fees, which are transparently displayed on our platform. There are no hidden charges.',
        ],
        [
            'question' => 'Can I withdraw my profits easily?',
            'answer' =>
                'Yes, withdrawing your profits is straightforward. You can initiate withdrawals through your account.',
        ],
        [
            'question' => 'Is customer support available?',
            'answer' =>
                'Absolutely. Our customer support team is here to assist you with any questions or issues you may have.',
        ],
        [
            'question' => 'How often are trading signals generated?',
            'answer' =>
                site('name') .
                ' generates trading signals continuously, ensuring you have access to up-to-date market information.',
        ],
    ];

@endphp

{{-- layout --}}
@extends('templates.' . site('template') . '.layouts.front')



@section('css')
@endsection



@section('header')
    <div class="w-[90%] mx-auto lg:h-[545px] h-[30vh] flex items-center justify-center overflow-hidden">
        <div class="max-w-screen-lg text-center lg:mt-20 mt-32 lg:py-0 py-10" data-aos="fade-up">
            <p class="text-white font-light lg:text-9xl text-2xl lg:mb-3 lg:mt-44"><span class="font-bold">FAQ</span></p>
            <p class="lg:text-2xl text-lg text-white font-extralight"
                style="font-family: 'Noto Sans', sans-serif; font-weight: 100; ">
                <a href="" class="text-[#D8D8D8] text-opacity-45">Home</a> / <a href="">FAQ</a>
            </p>
        </div>
    </div>
@endsection



@section('contents')
    {{-- breadcrum --}}
    <section class="w-full mb-10" data-aos="fade-up">
        <img src="{{ asset('/assets/templates/valent/images/tos-coin-cardrb_39641.png') }}" alt="img"
            class="absolute right-0 lg:block hidden -z-10 animate-pulse w-[678px]">
        <div class="w-[90%] mx-auto py-10">
            <div class="lg:flex justify-start items-center lg:h-[70vh]">
                <div class="col-span-1">
                    <p class="text-[#B4B1B1] lg:text-left text-center">FAQ</p>
                    <p class="text-[#3F7DF2] lg:text-5xl text-2xl lg:mb-3 lg:text-left text-center">Our</p>
                    <p class="text-white font-bold lg:text-7xl text-4xl lg:mb-3 lg:text-left text-center">FAQ </p>
                    <p
                        class="text-[#B4B1B1] lg:text-2xl text-lg leading-relaxed max-w-xl lg:text-left text-center lg:py-14 py-6">
                        {{ $short_description }} </p>
                </div>
                <div class="lg:hidden block">
                    <img src="{{ asset('/assets/templates/valent/images/tos-coin-cardrb_39641.png') }}" alt="img"
                        class="lg:w-auto w-1/2 mx-auto animate-pulse">
                </div>
            </div>
        </div>
    </section>

    {{-- faq --}}
    <section class="w-full mb-10" data-aos="fade-up">
        <div class="w-[90%] mx-auto py-10">
            <div class="max-w-screen-lg mx-auto">
                <ul class="w-full">
                    @foreach ($faqs as $faq)
                        <li class="mb-5" x-data="{
                            expanded: false,
                            showAdd: false,
                        }">
                            <div class="border-green-500 border-opacity-15"
                                x-bind:class="expanded ? 'border-0' : 'border-b'">
                                <p class="text-lg stext-2xl flex gap-x-20 mb-6"
                                    x-on:click="expanded = !expanded; showAdd = !showAdd">
                                    <span x-bind:class="expanded ? 'text-white' : 'text-white'"> {{ $faq['question'] }}
                                    </span>
                                    <img x-bind:src="showAdd ?
                                        '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                        '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                        alt="icon">

                                </p>
                                <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                    <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                        <p class="text-white"> {{ $faq['answer'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection

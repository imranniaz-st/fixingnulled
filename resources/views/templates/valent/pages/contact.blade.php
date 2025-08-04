@php

    $page_title = 'Contact Us';
    $short_description = 'We are available 24/7. You can reach us via any of the means below.';

@endphp

{{-- layout --}}
@extends('templates.'. site('template') .'.layouts.front')


@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
@endpush

@section('header')
    <div class="w-[90%] mx-auto lg:h-[545px] h-[30vh] flex items-center justify-center overflow-hidden">
        <div class="max-w-screen-lg text-center lg:mt-20 mt-32 lg:py-0 py-10" data-aos="fade-up">
            <p class="text-white font-light lg:text-9xl text-2xl lg:mb-3 lg:mt-44"><span class="font-bold">Contact</span> Us
            </p>
            <p class="lg:text-2xl text-lg text-white font-extralight"
                style="font-family: 'Noto Sans', sans-serif; font-weight: 100; ">
                <a href="" class="text-[#D8D8D8] text-opacity-45">Home</a> / <a href="">Contact Us</a>
            </p>
        </div>
    </div>
@endsection


@section('contents')
    <section class="w-full mb-10" data-aos="fade-up">
        <img src="{{ asset('/assets/templates/valent/images/3d-dail-phone_rb_39641.png') }}" alt="img"
            class="absolute right-0 lg:block hidden -z-10 animate-pulse w-[678px]">
        <div class="w-[90%] mx-auto py-10">
            <div class="lg:flex justify-start items-center lg:h-[70vh]">
                <div class="col-span-1">
                    <p class="text-[#B4B1B1] lg:text-left text-center">Connect wih us</p>
                    <p class="text-[#3F7DF2] lg:text-5xl text-2xl lg:mb-3 lg:text-left text-center">Contact</p>
                    <p class="text-white font-bold lg:text-7xl text-4xl lg:mb-3 lg:text-left text-center">Us </p>
                    <p
                        class="text-[#B4B1B1] lg:text-2xl text-lg leading-relaxed max-w-xl lg:text-left text-center lg:py-14 py-6">
                        {{ $short_description }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- contact --}}
    <section class="w-full mb-10" data-aos="fade-up">
        <div class="w-[90%] mx-auto lg:py-10">
            <div
                class="w-full relative bg-[#020E25] text-white p-6 rounded-xl border border-transparent shadow-lg 
          before:absolute before:inset-0 before:-m-0.5 before:rounded-xl before:bg-gradient-to-t before:from-[#ffffff4f] before:via-[#09C241]  before:to-[#3F7DF2]
          before:-z-10">
                <p class="text-center text-white py-10 lg:text-2xl">Feedback Form</p>
                <form action="{{ route('contact-validate') }}" method="post" enctype="multipart/form-data"
                    class="lg:p-10 text-white gen-form" data-action="reset">
                    @csrf
                    <div class="w-full mb-10">
                        <input type="email" name="email" id="email"
                            class="w-full p-4 border-white border border-opacity-15 bg-transparent rounded-xl"
                            placeholder="Email Address*" required>
                    </div>
                    <div class="w-full mb-10">
                        <input type="text" name="subject" id="subject"
                            class="w-full p-4 border-white border border-opacity-15 bg-transparent rounded-xl"
                            placeholder="Subject" required>
                    </div>
                    <div class="w-full mb-10">
                        <textarea name="message" id="message"
                            class="w-full lg:h-[20vh] h-10vh p-4 border-white border border-opacity-15 bg-transparent rounded-xl"
                            placeholder="Message" required></textarea>
                    </div>
                    <div class="w-full mb-10">
                        <button type="submit"
                            class="w-full border rounded-full py-4 px-10 block text-center text-white text-lg bg-gradient-to-r from-[#306FE6] via-[#3b82f6] to-[#0040BC] hover:text-[#0040BC] hover:bg-gradient-to-r hover:from-[#3F7DF2] hover:via-[#FFFFFF] hover:to-[#09C241] transition duration-200 ease-in-out">Send
                            Message</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="w-full mb-10" data-aos="fade-up">
        <div class="w-[90%] mx-auto py-10">
            <div class="bg-[#0040BC] rounded-t-2xl py-4 lg:px-20 px-4 lg:flex justify-between gap-4">

                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 bg-white bg-opacity-15 rounded-full">
                        <img src="{{ asset('/assets/templates/valent/images/front_icon/email_rb_21491822861.svg') }}"
                            alt="icon" class=" w-[60px]">
                    </div>
                    <div>
                        <p class="text-white text-xl font-bold">Email</p>
                        <p class="text-white text-lg font-extralight">{{ site('email') }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 bg-white bg-opacity-15 rounded-full">
                        <img src="{{ asset('/assets/templates/valent/images/front_icon/3d-rendering-blue-handset1.svg') }}"
                            alt="icon" class=" w-[60px]">
                    </div>
                    <div>
                        <p class="text-white text-xl font-bold">Phone</p>
                        <p class="text-white text-lg font-extralight">{{ site('phone') }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 bg-white bg-opacity-15 rounded-full">
                        <img src="{{ asset('/assets/templates/valent/images/front_icon/location-pin-icon-b1.svg') }}"
                            alt="icon" class=" w-[60px]">
                    </div>
                    <div>
                        <p class="text-white text-xl font-bold">Location</p>
                        <p class="text-white text-lg font-extralight">{{ site('address') }}, {{ site('city') }},
                            {{ site('state') }}, {{ site('country') }}</p>
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
@endsection

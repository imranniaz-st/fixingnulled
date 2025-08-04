@php
    use App\Models\Bot;

    $page_title = 'Privacy Policy';
    $short_description =
        'Prior to availing any of our services, we kindly request that you review and acknowledge our Privacy Policy. ';

@endphp

{{-- layout --}}
@extends('templates.'. site('template') .'.layouts.front')


@section('css')
@endsection

@section('header')
    <div class="w-[90%] mx-auto lg:h-[545px] h-[30vh] flex items-center justify-center overflow-hidden">
        <div class="max-w-screen-lg text-center lg:mt-20 mt-32 lg:py-0 py-10" data-aos="fade-up">
            <p class="text-white font-light lg:text-9xl text-2xl lg:mb-3 lg:mt-44"><span class="font-bold">Privacy</span></p>
            <p class="lg:text-2xl text-lg text-white font-extralight"
                style="font-family: 'Noto Sans', sans-serif; font-weight: 100; ">
                <a href="" class="text-[#D8D8D8] text-opacity-45">Home</a> / <a href="">Privacy</a>
            </p>
        </div>
    </div>
@endsection


@section('contents')
    {{-- bots --}}
    <section class="w-full mb-10" data-aos="fade-up">
        <img src="{{ asset('/assets/templates/valent/images/tos-coin-cardrb_39641.png') }}" alt="img"
            class="absolute right-0 lg:block hidden -z-10 animate-pulse w-[678px]">
        <div class="w-[90%] mx-auto py-10">
            <div class="lg:flex justify-start items-center lg:h-[70vh]">
                <div class="col-span-1">
                    <p class="text-[#3F7DF2] lg:text-5xl text-2xl lg:mb-3 lg:text-left text-center">Privacy</p>
                    <p class="text-white font-bold lg:text-7xl text-4xl lg:mb-3 lg:text-left text-center">Policy </p>
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

    {{-- terms of services --}}
    <section class="w-full mb-10" data-aos="fade-up">
        <div class="w-[90%] mx-auto py-10">
            <div class="max-w-screen-lg mx-auto">
                <ul class="w-full">
                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6" x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-white'"> 1. Introduction </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">Welcome to {{ site('name') }}. At {{ site('name') }}, we respect
                                        your privacy and are committed to protecting your
                                        personal information. This Privacy Policy is designed to help you understand how we
                                        collect, use,
                                        disclose, and safeguard your personal information. By using our services, you
                                        consent to the
                                        practices described in this Privacy Policy.</p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6" x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-white'"> 2. Information We Collect
                                </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">
                                    <p class="font-bold text-sm text-white">2.1 Personal Information</p>
                                    <p class="text-sm text-white">Personal Information is information that can be used to
                                        identify you as an individual. The types of
                                        Personal Information we may collect include but are not limited to:
                                    <ul class="text-white" style="list-style-type: disc; padding: 10px 30px;">
                                        <li>Your name</li>
                                        <li>Email address</li>
                                        <li>Contact information</li>
                                        <li>Financial information (for account verification and trading purposes)</li>
                                        <li>User-generated content (such as comments, reviews, or support requests)</li>
                                    </ul>
                                    </p>
                                    <p class="text-sm text-white mb-5">We collect this information when you voluntarily
                                        provide
                                        it to us, such as when you create an
                                        account, communicate with us, or use our Services.</p>

                                    <p class="font-bold text-sm text-white mt-3">2.2 Non-Personal Information</p>
                                    <p class="text-sm text-white">Non-Personal Information is data that cannot be used to
                                        identify you directly. This information
                                        includes:
                                    <ul class="text-white" style="list-style-type: disc; padding: 10px 30px;">
                                        <li>Device information (e.g., device type, operating system)</li>
                                        <li>Usage data (e.g., pages visited, time spent on our platform)</li>
                                        <li>Log data (e.g., IP address, browser type)</li>
                                        <li>Cookies and similar technologies (see Section 5)</li>
                                    </ul>
                                    </p>
                                    <p class="text-sm text-white">>We may collect Non-Personal Information automatically as
                                        you interact with our Services.</p>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6" x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-white'">3. How We Use Your Information
                                </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">We use the information we collect for various purposes, including
                                        but not limited to:</p>
                                    <p class="text-sm text-white">
                                    <ul class="text-white" style="list-style-type: disc; padding: 10px 30px;">
                                        <li>Providing and maintaining our Services</li>
                                        <li>Personalizing and improving user experience</li>
                                        <li>Analyzing and monitoring usage patterns</li>
                                        <li>Sending notifications and updates</li>
                                        <li>Responding to your requests and inquiries</li>
                                        <li>Complying with legal obligations</li>
                                    </ul>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6" x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-white'"> 4. Data Retention </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">We retain your information only as long as necessary for the
                                        purposes outlined in this Privacy Policy
                                        or as required by law. When your information is no longer needed, we will securely
                                        delete or
                                        anonymize it.</p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6" x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-white'"> 5. Cookies and Similar
                                    Technologies </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">{{ site('name') }} uses cookies and similar technologies to
                                        enhance user experience and collect Non-Personal
                                        Information. You can manage cookie preferences through your browser settings, but
                                        disabling cookies
                                        may affect the functionality of our Services.</p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6" x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-white'"> 6. Third-Party Services and
                                    Links </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">Our Services may contain links to third-party websites or
                                        services. We are not responsible for the
                                        privacy practices or content of these third parties. We recommend reviewing their
                                        privacy policies
                                        before using their services.</p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6" x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-white'"> 7. Data Security </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white"> We take data security seriously and employ industry-standard
                                        measures to protect your information.
                                        However, no method of transmission over the internet or electronic storage is
                                        entirely secure, and
                                        we cannot guarantee absolute security. </p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6" x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-white'"> 8. Children's Privacy </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white"> Our Services are not intended for children under the age of 18.
                                        We do not knowingly collect Personal
                                        Information from children. If you are a parent or guardian and believe that your
                                        child has provided
                                        us with Personal Information, please contact us. </p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6" x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-white'"> 9. Your Privacy Choices
                                </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white"> You have rights regarding your Personal Information, including:</p>
                                    <ul class="text-white" style="list-style-type: disc; padding: 10px 30px;">
                                        <li>Accessing and updating your information</li>
                                        <li>Deleting your account</li>
                                        <li>Opting out of marketing communications</li>
                                        <li>Managing cookie preferences</li>
                                        <li>Withdrawing consent (where applicable)</li>
                                    </ul>
                                    <p class="text-white text-sm">You can exercise these rights by contacting us through the information provided in Section 11.</p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6" x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-white'"> 10. Changes to this Privacy Policy </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">We may update this Privacy Policy periodically to reflect changes in our practices or for legal
                                        reasons. Any modifications will be effective upon posting on our website. We encourage you to review
                                        this Privacy Policy regularly to stay informed about how we collect and protect your information.</p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6" x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-white'"> 11. Contact Information </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white"> If you have questions or concerns about this Privacy Policy or our data practices, please contact us
                                        at [{{ site('email') }}]. </p>
                                </div>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </section>
@endsection


@section('scripts')
@endsection

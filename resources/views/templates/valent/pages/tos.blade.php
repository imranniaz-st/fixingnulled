@php
    use App\Models\Bot;

    $page_title = 'Terms of Service';
    $short_description =
        'Prior to availing any of our services, we kindly request that you review and acknowledge our Acceptable Use Terms of Service. Your utilization of our services constitutes your agreement to abide by the terms and conditions outlined therein. We appreciate your understanding and compliance.';

@endphp

{{-- layout --}}
@extends('templates.'. site('template') .'.layouts.front')


@section('css')
@endsection

@section('header')
    <div class="w-[90%] mx-auto lg:h-[545px] h-[30vh] flex items-center justify-center overflow-hidden">
        <div class="max-w-screen-lg text-center lg:mt-20 mt-32 lg:py-0 py-10" data-aos="fade-up">
            <p class="text-white font-light lg:text-9xl text-2xl lg:mb-3 lg:mt-44"><span class="font-bold">TOS</span></p>
            <p class="lg:text-2xl text-lg text-white font-extralight"
                style="font-family: 'Noto Sans', sans-serif; font-weight: 100; ">
                <a href="" class="text-[#D8D8D8] text-opacity-45">Home</a> / <a href="">TOS</a>
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
                    <p class="text-[#B4B1B1] lg:text-left text-center">TOS</p>
                    <p class="text-[#3F7DF2] lg:text-5xl text-2xl lg:mb-3 lg:text-left text-center">Terms of</p>
                    <p class="text-white font-bold lg:text-7xl text-4xl lg:mb-3 lg:text-left text-center">Service </p>
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
                            <p class="text-lg  flex gap-x-20 mb-6"
                                x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-white'"> Acceptance of Terms </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white"> Welcome to {{ site('name') }}! By accessing or using our
                                        services, including but
                                        not limited to our website,
                                        trading platform, and any associated software or applications (collectively referred
                                        to as the
                                        "Services"), you agree to be bound by these Terms of Service ("Terms"). If you do
                                        not agree to these
                                        Terms, please do not use our Services.
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
                            <p class="text-lg  flex gap-x-20 mb-6"
                                x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-[#6F6A6A]'">Description of Services
                                </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">{{ site('name') }} provides a trading platform that utilizes
                                        advanced AI technology to analyze market trends
                                        and execute trades. Our Services are designed to facilitate trading activities, and
                                        we do not
                                        provide financial advice. You are solely responsible for your trading decisions.</p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6"
                                x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-[#6F6A6A]'">Eligibility </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">You must be at least 18 years old and have the legal capacity to enter into this agreement to use
                                        our Services. By using our Services, you represent and warrant that you meet these eligibility
                                        criteria.</p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6"
                                x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-[#6F6A6A]'">Registration and Account
                                    Security </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">To access certain features of our Services, you may need to register for an account. You agree to
                                        provide accurate, current, and complete information during the registration process and to keep your
                                        account information updated. You are responsible for maintaining the confidentiality of your account
                                        credentials and for all activities that occur under your account. You must immediately notify us of
                                        any unauthorized use of your account.</p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6"
                                x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-[#6F6A6A]'">Privacy Policy </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">Your use of our Services is also governed by our Privacy Policy. Please review our Privacy Policy to
                                        understand how we collect, use, and protect your personal information.</p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6"
                                x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-[#6F6A6A]'">Prohibited Activities
                                </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white mb-3">You agree not to engage in any of the following prohibited activities while using our Services:</p>
                                    <p class="text-white">
                                        <ul class="list-disc text-sm text-white" style="list-style-type: disc; padding:0px 30px;">
                                            <li>Violating any applicable laws or regulations.</li>
                                            <li>Impersonating any person or entity or providing false information.</li>
                                            <li>Attempting to gain unauthorized access to our Services or computer systems.</li>
                                            <li>Interfering with the proper functioning of our Services.</li>
                                            <li>Engaging in any activity that could harm, disable, or overburden our infrastructure.</li>
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
                            <p class="text-lg  flex gap-x-20 mb-6"
                                x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-[#6F6A6A]'">Termination of Services
                                </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white"> We reserve the right to terminate or suspend your access to our Services at our discretion, without
                                        notice, for any reason, including if we believe you have violated these Terms. You may also
                                        terminate your account at any time by discontinuing use of our Services.</p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6"
                                x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-[#6F6A6A]'">Disclaimer of Warranties
                                </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">Our Services are provided "as is" and "as available" without warranties of any kind, either express
                                        or implied. We do not guarantee the accuracy, reliability, or availability of our Services or the
                                        results obtained through their use. You use our Services at your own risk.</p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6"
                                x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-[#6F6A6A]'">Limitation of Liability
                                </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">To the fullest extent permitted by applicable law, {{ site('name') }} and its affiliates, officers,
                                        directors, employees, and agents shall not be liable for any indirect, incidental, special,
                                        consequential, or punitive damages, or any loss of profits or revenues, whether incurred directly or
                                        indirectly, or any loss of data, use, goodwill, or other intangible losses, resulting from:
                                        <ol class="text-white text-sm" style="list-style-type: lower-alpha; padding:10px 30px;">
                                            <li>your use or inability to use our Services,</li>
                                            <li>any unauthorized access to or use of our servers and/or any personal information stored therein, </li>
                                            <li>any interruption or cessation of our Services,</li>
                                            <li>any bugs, viruses, or other harmful code that may be transmitted to or through our Services, or</li>
                                            <li>any errors, inaccuracies, omissions, or any other aspect of our Services.</li>
                                        </ol>
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
                            <p class="text-lg  flex gap-x-20 mb-6"
                                x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-[#6F6A6A]'">Intellectual Property
                                </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">All content included in or made available through our Services, including text, graphics, logos,
                                        button icons, images, audio clips, digital downloads, and data compilations, is the property of
                                        {{ site('name') }} or its content suppliers and is protected by United States and international copyright
                                        laws.</p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6"
                                x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-[#6F6A6A]'">Changes to Terms </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">We reserve the right to modify or revise these Terms at any time. The most current version of these
                                        Terms will be posted on our website. Your continued use of our Services following the posting of any
                                        changes constitutes your acceptance of those changes.</p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6"
                                x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-[#6F6A6A]'">Governing Law </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">These Terms are governed by and construed in accordance with the laws of the State of
                                        {{ site('country') }}, without regard to its conflict of law principles.</p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6"
                                x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-[#6F6A6A]'">Contact Information </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">If you have any questions about these Terms or our Services, please contact us at
                                        {{ site('email') }}.</p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6"
                                x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-[#6F6A6A]'">User Responsibilities</span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">As a user of {{ site('name') }}'s Services, you agree to:</p>
                                    <p class="text-white">
                                        <ul class="list-disc text-sm text-white" style="list-style-type: disc; padding:0px 30px;">
                                            <li>Comply with all applicable laws and regulations related to trading and financial transactions.</li>
                                            <li>Keep your account information, including passwords, secure and confidential.</li>
                                            <li>Use our Services only for lawful purposes.</li>
                                            <li>Refrain from attempting to disrupt or interfere with the proper functioning of our Services.</li>
                                            <li>Report any security breaches or unauthorized access to our Services promptly.</li>
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
                            <p class="text-lg  flex gap-x-20 mb-6"
                                x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-[#6F6A6A]'">Account Suspension and Termination </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">{{ site('name') }} reserves the right to suspend or terminate user accounts for violations of these Terms or
                                        for any other reason, at its sole discretion.</p>
                                    <p class="text-white"></p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6"
                                x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-[#6F6A6A]'">Third-Party Links and Services </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">Our Services may contain links to third-party websites or services. {{ site('name') }} does not endorse or
                                        control these third-party websites or services and is not responsible for their content or
                                        practices. Use of third-party websites or services is at your own risk.</p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6"
                                x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-[#6F6A6A]'">Indemnification </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">You agree to indemnify and hold {{ site('name') }}, its affiliates, officers, directors, employees, and
                                        agents harmless from any claims, losses, damages, liabilities, and expenses (including attorney's
                                        fees) arising from or related to your use of our Services or violation of these Terms.</p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6"
                                x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-[#6F6A6A]'">Dispute Resolution </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">Any disputes arising from or relating to these Terms or your use of our Services shall be resolved
                                        through arbitration in accordance with the rules of the {{ site('country') }} Arbitration
                                        Association. The arbitration shall take place in {{ site('city') }}, {{ site('state') }}, and the
                                        decision of the arbitrator shall be final and binding.</p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6"
                                x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-[#6F6A6A]'">Entire Agreement </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">These Terms constitute the entire agreement between you and {{ site('name') }} with respect to the subject
                                        matter hereof and supersedes all prior or contemporaneous communications and proposals, whether oral
                                        or written, between the parties.</p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6"
                                x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-[#6F6A6A]'">Assignment </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">You may not assign or transfer these Terms, in whole or in part, without the prior written consent
                                        of {{ site('name') }}. {{ site('name') }} may freely assign these Terms without restriction.</p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6"
                                x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-[#6F6A6A]'">Waiver and Severability
                                </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">The failure of {{ site('name') }} to enforce any right or provision of these Terms shall not constitute a
                                        waiver of such right or provision. If any provision of these Terms is found by a court of competent
                                        jurisdiction to be invalid, the parties nevertheless agree that the court should endeavor to give
                                        effect to the parties' intentions as reflected in the provision, and the other provisions of these
                                        Terms remain in full force and effect.</p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6"
                                x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-[#6F6A6A]'">No Third-Party
                                    Beneficiaries </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">These Terms do not create any third-party beneficiary rights.</p>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="mb-5" x-data="{
                        expanded: false,
                        showAdd: false,
                    }">
                        <div class="border-green-500 border-opacity-15" x-bind:class="expanded ? 'border-0' : 'border-b'">
                            <p class="text-lg  flex gap-x-20 mb-6"
                                x-on:click="expanded = !expanded; showAdd = !showAdd">
                                <span x-bind:class="expanded ? 'text-white' : 'text-[#6F6A6A]'">Contact Us </span>
                                <img x-bind:src="showAdd ?
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_minus_sign.svg') }}' :
                                    '{{ asset('/assets/templates/valent/images/front_icon/green_add_sign.svg') }}'"
                                    alt="icon">

                            </p>
                            <div class="w-full pl-8" x-cloak x-transition x-show="expanded">
                                <div class="w-full border-l-8 border-[#09C241] px-10 overflow-hidden">
                                    <p class="text-white">If you have any questions or concerns about these Terms, please contact us at {{ site('email') }}.</p>
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

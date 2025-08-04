@extends('templates.' . site('template') . '.layouts.auth')

@section('css')
    <style>
        input {
            background-color: transparent;
            color: inherit;
            /* Keeps text color consistent */
            border: none;
            outline: none;
        }
    </style>
@endsection


@section('contents')
    {{-- Main login secton --}}
    <div class="h-screen w-full flex items-center relative  @if (user()) hidden @endif"
        data-aos="zoom-in-up" id="loginFormContainer">
        <img src="{{ asset('/assets/templates/valent/images/other-crypto-coins-revolve-around-bitcoin-3d-rendering-b 1.png') }}"
            alt="crypto" class="w-[924px] absolute right-0 lg:block hidden">

        <div class="w-full h-[60vh] grid lg:grid-cols-2 lg:p-0 p-4">

            <div class="col-span-1">
                <div class="max-w-screen-sm mx-auto" data-aos="fade-right">

                    <a href="{{ route('home') }}">
                        <p class="text-white flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
                                <path d="M12.707 17.293 8.414 13H18v-2H8.414l4.293-4.293-1.414-1.414L4.586 12l6.707 6.707z">
                                </path>
                            </svg>
                            <span>Back</span>
                        </p>
                    </a>

                    <div class="px-4 lg:px-10 mt-6 space-y-6">
                        <p class="bg-green-500 text-gray-300 p-1 rounded-lg text-xs text-center hidden noticeMsg"
                            id="noticeMsgOtp" style="background: #1ce01c; color:#fff; margin:10px 0px;">s</p>
                    </div>

                    <div class="text-white mb-10">
                        <p class="text-4xl mb-4 font-thin">Welcome <span
                                class="font-bold bg-gradient-to-r from-[#3F7DF2] via-[#09C241] to-[#ffffff] bg-clip-text text-transparent">Back</span>
                        </p>
                        <p class="">Please enter your details</p>
                    </div>

                    <form action="{{ route('user.login-validate') }}" method="POST" id="loginForm">
                        @csrf
                        <div class="w-full mb-10">
                            <fieldset class="border py-1 px-3 rounded-2xl">
                                <legend class="px-3 mx-8 text-white"><label for="amount" class="text-white text-sm">Email
                                        or Username</label></legend>
                                <div class="w-full text-white flex gap-4">
                                    <img src="{{ asset('/assets/templates/valent/images/icon/user_card_gradient.svg') }}"
                                        alt="icon">
                                    <div class="w-full">
                                        <input type="text" id="email" name="email"
                                            class="w-full p-4 bg-transparent text-xl text-white border-0 focus:outline-none flex-1"
                                            placeholder="Enter Email or Username" required
                                            @if (env('DEMO_MODE')) value="user@user.com" @endif>
                                    </div>
                                </div>
                            </fieldset>

                            <span>
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>

                        </div>


                        <div class="w-full mb-4">
                            <fieldset class="border py-1 px-3 rounded-2xl">
                                <legend class="px-3 mx-8 text-white"><label for="amount"
                                        class="text-white text-sm">Password</label></legend>
                                <div class="w-full text-white flex gap-4">
                                    <img src="{{ asset('/assets/templates/valent/images/icon/pass_card_gradient.svg') }}"
                                        alt="icon">
                                    <div class="w-full">
                                        <input type="password" id="password" name="password"
                                            class="w-full p-4 bg-transparent text-xl text-white border-0 focus:outline-none flex-1"
                                            placeholder="Enter Password"
                                            @if (env('DEMO_MODE')) value="password" @endif>
                                    </div>
                                </div>
                            </fieldset>

                            <span>
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>

                        </div>

                        <div class="w-full  mb-10 flex justify-between text-white">
                            <p class="flex gap-3"><input type="checkbox" name="remember" id="remember"> <label
                                    for="remember">Remember me</label></p>
                            <a href="{{ route('user.forgot-password.index') }}">Forgot password</a>
                        </div>

                        <div class="w-full mb-4">
                            <div class="text-center">
                                <button type="submit" id="loginBtn"
                                    class="border bg-gradient-to-r from-[#3271E8] to-[#0A4AC5] text-white hover:bg-blue-600 rounded-full px-10 py-4 w-full hover:text-[#0040BC] hover:bg-gradient-to-r hover:from-[#3F7DF2] hover:via-[#FFFFFF] hover:to-[#09C241] transition delay-100 duration-200 ease-in-out">Login</button>
                            </div>
                        </div>

                        <div class="w-full mb-4">
                            <p class="text-center text-[#B4B1B1]"> Don’t have an account? <a
                                    href="{{ route('user.register') }}" class="text-white"> Sign Up</a></p>
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>

    {{-- Otp Login section --}}
    <div class="w-full h-screen  @if (!user()) hidden @endif" id="verifyFormContainer">
        <div class="h-screen w-full flex items-center relative" data-aos="zoom-in-up">
            <img src="{{ asset('/assets/templates/valent/images/blockchain-3d-render-icon-b 1.png') }}" alt="crypto"
                class="w-[924px] absolute right-0 lg:block hidden">

            <div class="w-full h-[60vh] grid lg:grid-cols-2 lg:p-0 p-4">

                <div class="col-span-1">

                    <div class="max-w-screen-sm mx-auto" data-aos="fade-right">

                        <a href="{{ route('home') }}">
                            <p class="text-white flex gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
                                    <path
                                        d="M12.707 17.293 8.414 13H18v-2H8.414l4.293-4.293-1.414-1.414L4.586 12l6.707 6.707z">
                                    </path>
                                </svg>
                                <span>Back</span>
                            </p>
                        </a>

                        <div class="px-4 lg:px-10 mt-6 space-y-6">
                            <p class="bg-green-500 text-gray-300 p-1 rounded-lg text-xs text-center hidden noticeMsg"
                                id="noticeMsgOtp" style="background: #1ce01c; color:#fff; margin:10px 0px;"></p>
                        </div>

                        <div class="text-white mb-10">
                            <p class="text-4xl mb-4 font-thin">Please enter <span
                                    class="font-bold bg-gradient-to-r from-[#3F7DF2] via-[#09C241] to-[#ffffff] bg-clip-text text-transparent">OTP</span>
                            </p>
                            <p class="">Please enter your otp code</p>
                        </div>

                        <form action="{{ route('user.login-verify') }}" method="POST" id="verifyForm">
                            @csrf
                            <div class="w-full mb-10 flex items-center justify-center">

                                <div class="flex lg:gap-10 gap-6 text-white">
                                    <input type="number" maxlength="1" name="otp[]"
                                        class="otp-input w-10 h-10 text-center text-xl bg-transparent border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                                    <input type="number" maxlength="1" name="otp[]"
                                        class="otp-input w-10 h-10 text-center text-xl bg-transparent border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                                    <input type="number" maxlength="1" name="otp[]"
                                        class="otp-input w-10 h-10 text-center text-xl bg-transparent border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                                    <input type="number" maxlength="1" name="otp[]"
                                        class="otp-input w-10 h-10 text-center text-xl bg-transparent border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                                    <input type="number" maxlength="1" name="otp[]"
                                        class="otp-input w-10 h-10 text-center text-xl bg-transparent border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                                    <input type="number" maxlength="1" name="otp[]"
                                        class="otp-input w-10 h-10 text-center text-xl bg-transparent border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                                </div>
                                <input type="hidden" name="otp" id="otp" value="">

                                <span>
                                    @error('otp')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="w-full mb-4 pt-10">
                                <div class="text-center">
                                    <button type="submit" id="verifyBtn"
                                        class="border bg-gradient-to-r from-[#3271E8] to-[#0A4AC5] text-white hover:bg-blue-600 rounded-full px-10 lg:py-4 py-2 w-full hover:text-[#0040BC] hover:bg-gradient-to-r hover:from-[#3F7DF2] hover:via-[#FFFFFF] hover:to-[#09C241] transition delay-100 duration-200 ease-in-out">Submit</button>
                                </div>

                                <div class="text-center text-white py-5">
                                    <button type="button" class="hover:text-purple-700" id="resendBtn">Resend
                                        OTP</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#noticeMsgLogin').text("verifyText").show();

        $(document).ready(function() {

            $('#loginForm').submit(function(e) {
                e.preventDefault();

                var form = $(this);
                var formData = form.serialize();
                var clicked = $('#loginBtn');

                //disable the submit button
                clicked.addClass('relative disabled');
                clicked.append('<span class="button-spinner"></span>');
                clicked.prop('disabled', true);

                clicked.addClass('bg-gray-500');
                clicked.removeClass('bg-gradient-to-r hover:bg-blue-600 hover:bg-gradient-to-r');

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        var verifyText = response.message;
                        var verify = response.verify;
                        $('.noticeMsg').html(verifyText).show();

                        if (verify == 1) {
                            //hide register form and display verification form
                            $('#loginFormContainer').hide();
                            $('#verifyFormContainer').show();

                            //update page title
                            $('#page-title').html('Verify OTP');
                        } else {
                            var url = '{{ route('user.dashboard') }}';
                            window.location.href = url;
                        }




                    },
                    error: function(xhr, status, error) {
                        $('#loginBtn').show();
                        var errors = xhr.responseJSON.errors;

                        if (errors) {
                            $.each(errors, function(field, messages) {
                                var fieldErrors = '';
                                $.each(messages, function(index, message) {
                                    fieldErrors += message + '<br>';
                                });


                                toastNotify('error', fieldErrors);
                            });
                        } else {
                            toastNotify('error', 'An error occured, please try again later');
                        }


                    },
                    complete: function() {
                        clicked.removeClass('disabled');
                        clicked.find('.button-spinner').remove();
                        clicked.prop('disabled', false);

                        clicked.removeClass('bg-gray-500');
                        clicked.addClass(
                            'bg-gradient-to-r hover:bg-blue-600 hover:bg-gradient-to-r');

                    }

                });
            });


            //otp form
            $('#verifyForm').submit(function(e) {
                e.preventDefault();

                var form = $(this);
                var formData = form.serialize();
                var clicked = $('#verifyBtn');

                //disable the submit button
                clicked.addClass('relative disabled');
                clicked.append('<span class="button-spinner"></span>');
                clicked.prop('disabled', true);

                clicked.addClass('bg-gray-500');
                clicked.removeClass('bg-gradient-to-r hover:bg-blue-600 hover:bg-gradient-to-r');

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        var verifyText = response.message;

                        $('.noticeMsg').text(verifyText).show();
                        console.log(verifyText);

                        var url = '{{ route('user.dashboard') }}';
                        window.location.href = url;

                    },
                    error: function(xhr, status, error) {
                        $('#verifyBtn').show();
                        var errors = xhr.responseJSON.errors;

                        if (errors) {
                            $.each(errors, function(field, messages) {
                                var fieldErrors = '';
                                $.each(messages, function(index, message) {
                                    fieldErrors += message + '<br>';
                                });


                                toastNotify('error', fieldErrors);
                            });
                        } else {
                            toastNotify('success', 'An error occured, please try again later');
                        }


                    },
                    complete: function() {
                        clicked.removeClass('disabled');
                        clicked.find('.button-spinner').remove();
                        clicked.prop('disabled', false);


                        clicked.removeClass('bg-gray-500');
                        clicked.addClass(
                            'bg-gradient-to-r hover:bg-blue-600 hover:bg-gradient-to-r');

                    }

                });
            });

        });
    </script>


    <script>
        const resendBtn = document.getElementById('resendBtn');
        const loginBtn = document.getElementById('loginBtn');
        let isClickable = true;
        let countdown;

        function startCountdown() {
            if (isClickable) {
                isClickable = false;
                resendBtn.disabled = true;

                let secondsLeft = 120; // 2 minutes
                countdown = setInterval(() => {
                    if (secondsLeft > 0) {
                        const minutes = Math.floor(secondsLeft / 60);
                        const seconds = secondsLeft % 60;
                        const formattedTime = `${minutes}:${seconds.toString().padStart(2, '0')}`;
                        resendBtn.textContent = `Resend Again in ${formattedTime}`;
                        secondsLeft--;
                    } else {
                        resendBtn.textContent = 'Resend OTP';
                        resendBtn.disabled = false;
                        isClickable = true;
                        clearInterval(countdown);
                    }
                }, 1000); // Update every 1 second
            }
        }

        resendBtn.addEventListener('click', () => {
            startCountdown();
            // Define the CSRF token
            var csrfToken = '{{ csrf_token() }}';

            // Add the CSRF token to the request headers
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            // Send the AJAX request
            $.ajax({
                url: "{{ route('user.resend-otp') }}",
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    var verifyText = response.message;

                    toastNotify('success', verifyText);

                },
                error: function(xhr, status, error) {
                    var errors = xhr.responseJSON.errors;

                    if (errors) {
                        $.each(errors, function(field, messages) {
                            var fieldErrors = '';
                            $.each(messages, function(index, message) {
                                fieldErrors += message + '<br>';
                            });

                            toastNotify('error', fieldErrors);

                        });
                    } else {

                        toastNotify('error', 'An error occured, please try again later');

                    }
                }
            });




        });

        loginBtn.addEventListener('click', () => {
            startCountdown();
        });
    </script>

    {{-- <script>
        ////// Concatenate all input values
        $(document).ready(function() {
            $('.otp-input').on('input', function() {
                let otpValue = '';

                // Concatenate all input values
                $('.otp-input').each(function() {
                    otpValue += $(this).val();
                });

                // Set the hidden input value
                $('#otp').val(otpValue);
            });
        });

       
        $(document).ready(function() {
            const $inputs = $(".otp-input");

            $inputs.on("input", function(e) {
                const $this = $(this);
                const value = $this.val();

                if (value.length === 1) {
                    $this.next(".otp-input").focus();
                }
            });

            $inputs.on("keydown", function(e) {
                const $this = $(this);

                if (e.key === "Backspace" && !$this.val()) {
                    $this.prev(".otp-input").focus();
                }
            });

            $inputs.on("paste", function(e) {
                const pasteData = e.originalEvent.clipboardData.getData('text').slice(0, 4);

                $inputs.each(function(index) {
                    $(this).val(pasteData[index] || "");
                });
                $inputs.eq(pasteData.length).focus();
                e.preventDefault();
            });
        });
    </script> --}}

    <script>
        ////// Concatenate all input values
        $(document).ready(function() {
            $('.otp-input').on('input', function() {
                let otpValue = '';

                // Concatenate all input values
                $('.otp-input').each(function() {
                    otpValue += $(this).val();
                });

                // Set the hidden input value
                $('#otp').val(otpValue);
            });
        });


        $(document).ready(function() {
            const $inputs = $(".otp-input");

            $inputs.on("input", function(e) {
                const $this = $(this);
                const value = $this.val();

                // Allow only 1 character
                if (value.length > 1) {
                    $this.val(value.charAt(0)); // Keep only the first character
                }

                // Move focus to the next input if a character is entered
                if (value.length === 1) {
                    $this.next(".otp-input").focus();
                }
            });

            $inputs.on("keydown", function(e) {
                const $this = $(this);

                if (e.key === "Backspace" && !$this.val()) {
                    $this.prev(".otp-input").focus();
                }
            });

            $inputs.on("paste", function(e) {
                const pasteData = e.originalEvent.clipboardData.getData('text').slice(0, $inputs.length);

                // Fill inputs with pasted data, ensuring only one character per input
                $inputs.each(function(index) {
                    $(this).val(pasteData[index] || "");
                });

                // Focus on the next input after the last pasted character
                $inputs.eq(pasteData.length).focus();
                e.preventDefault();
            });
        });
    </script>
@endsection

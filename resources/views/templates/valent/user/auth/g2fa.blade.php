@extends('templates.' . site('template') . '.layouts.auth')

@section('contents')
    {{-- verification form --}}
    <div class="w-full h-screen " id="verifyFormContainer">
        <div class="h-screen w-full flex items-center relative" data-aos="zoom-in-up">
            <img src="{{ asset('/assets/templates/valent/images/blockchain-3d-render-icon-b 1.png') }}" alt="crypto"
                class="w-[924px] absolute right-0 {{-- lg:block --}} hidden">

            <div class="w-full h-[60vh] grid  lg:p-0 p-4">

                <div class="col-span-1">

                    <div class="max-w-screen-sm mx-auto" data-aos="fade-right">


                        <div class="px-4 lg:px-10 mt-6 space-y-6">
                            <p class="bg-green-500 text-gray-300 p-1 rounded-lg text-xs text-center hidden noticeMsg"
                                id="noticeMsgOtp" style="background: #1ce01c; color:#fff; margin:10px 0px;"></p>
                        </div>

                        <div class="text-white mb-10 text-center">
                            <p class="text-4xl mb-4 font-thin"><span
                                    class="font-bold bg-gradient-to-r from-[#3F7DF2] via-[#09C241] to-[#ffffff] bg-clip-text text-transparent">2FA</span>
                            </p>
                            <p class="">Please enter your 2FA code</p>
                        </div>

                        <form action="{{ route('user.g2fa.g2fa') }}" method="POST" class="px-4 lg:px-10 mt-6 space-y-6"
                            id="verifyForm">
                            @csrf
                            <div class="w-full mb-20 flex items-center justify-center">

                                <div class="flex lg:gap-10 gap-6 text-white">
                                    <input type="number" maxlength="1" name="otp[]" autofocus
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
                                <input type="hidden" name="otp" id="otp" value="" required maxlength="6">

                                <span>
                                    @error('otp')
                                        {{ $message }}
                                    @enderror
                                </span>

                            </div>

                            <div class="w-full mb-4">
                                <div class="text-center">
                                    <button type="submit" id="verifyBtn"
                                        class="border bg-gradient-to-r from-[#3271E8] to-[#0A4AC5] text-white hover:bg-blue-600 rounded-full px-10 lg:py-4 py-2 w-full hover:text-[#0040BC] hover:bg-gradient-to-r hover:from-[#3F7DF2] hover:via-[#FFFFFF] hover:to-[#09C241] transition delay-100 duration-200 ease-in-out">Verify</button>
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
    {{-- <script>
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


        //////////////////////////////// parse
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



    <script>
        $(document).ready(function() {

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
                        $('#noticeMsg').html(verifyText).show();
                        var url = "{{ route('user.dashboard') }}";
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


                                Swal.fire({
                                    icon: 'error',
                                    html: fieldErrors,
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter',
                                            Swal.stopTimer);
                                        toast.addEventListener('mouseleave',
                                            Swal.resumeTimer);
                                    }
                                });
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: 'An error occured, please try again later',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter',
                                        Swal.stopTimer);
                                    toast.addEventListener('mouseleave',
                                        Swal.resumeTimer);
                                }
                            });
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
@endsection

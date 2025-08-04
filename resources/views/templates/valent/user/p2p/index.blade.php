@extends('templates.' . site('template') . '.layouts.user')



@section('css')
    <style>
        #NewP2pModal {
            transition: opacity 0.3s ease, transform 0.3s ease;
            transform: translateX(100%);
            /* Start offscreen */
            opacity: 0;
        }

        #NewP2pModal.show {
            transform: translateX(0);
            /* Slide to visible position */
            opacity: 1;
            /* Fade in */
        }

        #NewP2pModal.hide {
            transform: translateX(100%);
            /* Slide offscreen */
            opacity: 0;
            /* Fade out */
        }
    </style>
@endsection


@section('contents')
    <!--p2p-->
    <div class="w-full py-6" id="pageContent">
        <div class="lg:max-w-screen-xl mx-auto p-4 mb-3 text-white">

            <div class="block py-4 mb-10">
                <div action="" class="lg:block hidden w-full" id="filterForm">
                    <div class="w-full flex border rounded-full">

                        <input type="text" placeholder="Txn ref" id="search-transfer-input" value="{{ request()->s }}"
                            class="py-3 h-14s px-6 rounded-l-full bg-transparent w-full text-white">

                        <div class="simple-pagination" data-paginator="transfers">
                            <a id="search-transfer-button" data-link="{{ route('user.transfers.index') }}" href=""
                                class=" paginator-link flex gap-4 items-center bg-gradient-to-r from-[#306FE6] via-[#3b82f6] to-[#0040BC] py-3 px-8 rounded-r-full text-white">
                                <img src="{{ asset('/assets/templates/valent/images/icon/search_icon.svg') }}"
                                    alt="icon">
                                Search
                            </a>
                        </div>

                    </div>
                </div>
            </div>


            <div class="block mb-3">
                <h1 class="text-xl lg:text-3xl font-bold">P2p</h1>
            </div>

            <div class="lg:flex justify-between items-center mb-5 py-5">
                <div class="mb-3 block p-2">
                    <p> <span class="bg-black text-white px-6 py-2 rounded-xl border-b-4 border-[#0040BC]">P2p
                            History</span>
                    </p>
                </div>
                <div class="mb-3 block p-2">
                    <button id="openNewP2pModal"
                        class="border rounded-full lg:px-10 pdx-5 lg:py-4 py-2 px-6 text-lg  bg-gradient-to-r from-[#306FE6] via-[#3b82f6] to-[#0040BC] hover:text-[#0040BC] hover:bg-gradient-to-r hover:from-[#3F7DF2] hover:via-[#FFFFFF] hover:to-[#09C241] transition delay-100 duration-200 ease-in-out">New
                        P2p</button>
                </div>



                <!-- new p2p Modal -->
                <div id="NewP2pModal" class="hidden fixed inset-0 bg-opacity-50 flex items-center justify-end lg:px-6 px-2">
                    <div
                        class="bg-gradient-to-r from-[#0038A5] to-[#022058] rounded-lg lg:w-3/5 w-full lg:p-10 p-4 relative mt-20 lg:mr-20">

                        <div class="flex justify-between items-center lg:mb-10 mb-4">
                            <h2 class="text-xl font-semibold mb-4 text-white">New Transfer</h2>
                            <button id="closeNewP2pModal" class="text-gray-400 hover:text-gray-600">
                                <img src="{{ asset('/assets/templates/valent/images/icon/close_icon.svg') }}"
                                    alt="icon">
                            </button>
                        </div>

                        <!-- Modal Content -->
                        <form action="{{ route('user.transfers.new') }}" method="post" id="transferForm">
                            @csrf

                            <div class="w-full mb-10">
                                <fieldset class="border py-1 px-3 rounded-2xl">
                                    <legend class="px-3 mx-8 text-white"><label for="amount"
                                            class="text-white text-sm">Full Name</label></legend>
                                    <div class="w-full text-white flex gap-4">
                                        <img src="{{ asset('/assets/templates/valent/images/icon/user_card_gradient.svg') }}"
                                            alt="icon">
                                        <div class="w-full">
                                            <input type="text" name="fullname" id="fullname"
                                                class="w-full p-4 bg-transparent text-xl text-white border-0 focus:outline-none flex-1"
                                                placeholder="Enter Fullname" required>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="w-full mb-10">
                                <fieldset class="border py-1 px-3 rounded-2xl">
                                    <legend class="px-3 mx-8 text-white"><label for="amount"
                                            class="text-white text-sm">Username</label></legend>
                                    <div class="w-full text-white flex gap-4">
                                        <img src="{{ asset('/assets/templates/valent/images/icon/user_icon_gradient.svg') }}"
                                            alt="icon">
                                        <div class="w-full">
                                            <input type="text" name="username" id="username"
                                                class="w-full p-4 bg-transparent text-xl text-white border-0 focus:outline-none flex-1"
                                                placeholder="Enter Username" required>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="w-full mb-10">
                                <fieldset class="border py-1 px-3 rounded-2xl">
                                    <legend class="px-3 mx-8 text-white"><label for="amount"
                                            class="text-white text-sm">Amount {{ site('currency') }}</label></legend>
                                    <div class="w-full text-white flex gap-4">
                                        <img src="{{ asset('/assets/templates/valent/images/icon/solar_dollar-broken.svg') }}"
                                            alt="icon">
                                        <div class="w-full">
                                            <input type="number" step="any" name="amount" id="amount"
                                                class="w-full p-4 bg-transparent text-xl text-white border-0 focus:outline-none flex-1"
                                                placeholder="Amount ({{ site('currency') }})" value="0" required>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>


                            <div class="w-full lg:mb-10 mb-4 lg:px-10 px-4">
                                <div class="flex gap-4 mb-3">
                                    <p class="text-lg text-white">Important Information</p>
                                    <img src="{{ asset('/assets/templates/valent/images/icon/caution_yellow.svg') }}"
                                        alt="icon">
                                </div>

                                <div class="w-full px-6 py-4 bg-blue-100 rounded-xl bg-opacity-20 text-sm">
                                    <table class="mb-3">
                                        <tr>
                                            <td><span class="text-[#40DDFF]">Minimum Deposit:</span></td>
                                            <td><span class="text-white">{{ formatAmount(site('min_transfer')) }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="text-[#40DDFF]">Maximum Deposit:</span></td>
                                            <td><span class="text-white">{{ formatAmount(site('max_transfer')) }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="text-[#40DDFF]">Fee:</span></td>
                                            <td><span class="text-white">{{ site('transfer_fee') }}%</span></td>
                                        </tr>
                                    </table>
                                    <p class="text-sm">
                                        <span class="text-[#F9810A]">Warning: </span>
                                        <span class="text-[#D8D8D8]">Confirm the receipient's full name before proceeding
                                            to
                                            make transfer.</span>
                                    </p>
                                </div>
                            </div>


                            <div class="w-full">
                                <div class="flex items-center justify-center">
                                    <button type="submit"
                                        class="bg-gradient-to-r from-[#3271E8] to-[#0A4AC5] text-white hover:bg-blue-600 rounded-full px-10 py-4 lg:w-96 w-full hover:text-[#0040BC] hover:bg-gradient-to-r hover:from-[#3F7DF2] hover:via-[#FFFFFF] hover:to-[#09C241] transition delay-100 duration-200 ease-in-out flex items-center justify-center">Transfer
                                        Now</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
                <!--new p2p modal-->


            </div>

            <div id="transfers">
                <div
                    class="block bg-blue-600 bg-opacity-10 border border-opacity-15 border-blue-200 rounded-t-2xl overflow-auto w-full min-h-[60vh]">
                    <table class="w-full" id="p2pTable">
                        <thead class="text-center  bg-gray-400 bg-opacity-25">
                            <th class="p-6 text-left lg:min-w-52 min-w-[50vw]">Date/Time</th>
                            <th class="p-6 text-right lg:min-w-52 min-w-[50vw]">User</th>
                            <th class="p-6 text-right lg:min-w-52 min-w-[50vw]">Ref</th>
                            <th class="p-6 text-right lg:min-w-52 min-w-[50vw]">Fee</th>
                            <th class="p-6 text-right lg:min-w-52 min-w-[50vw]">Amount</th>
                            <th class="p-6 text-right lg:min-w-52 min-w-[50vw]">Status</th>
                        </thead>
                        <tbody>
                            @forelse ($transfers as $transfer)
                                <tr class="border-b border-opacity-25 border-blue-200 py-6">
                                    <td class="p-2 py-6" data-p2p_tnx="{{ $transfer->ref }}">
                                        <p class="px-4">{{ date('d-m-y H:i:s', strtotime($transfer->created_at)) }}</p>
                                    </td>
                                    <td class="p-2 py-6 text-right">
                                        <p class="px-4">
                                            @if ($transfer->sender_id == user()->id)
                                                <span>to {{ $transfer->receiver_name }}</span>
                                            @else
                                                <span>from {{ $transfer->receiver_name }}</span>
                                            @endif
                                        </p>
                                    </td>
                                    <td class="p-2 py-6 text-right">
                                        <p class="px-4">{{ $transfer->ref }}</p>
                                    </td>
                                    <td class="p-2 py-6 text-right">
                                        <p class="px-4">
                                            @if ($transfer->sender_id == user()->id)
                                                {{ formatAmount($transfer->fee) }}
                                            @endif
                                        </p>
                                    </td>
                                    <td class="p-2 py-6 text-right">
                                        <p class="px-4">
                                            {{ formatAmount($transfer->amount) }}
                                        </p>
                                    </td>
                                    <td class="p-2 py-6 flex justify-end">
                                        <p
                                            class="text-end rounded-full w-auto bg-gray-500 bg-opacity-40 py-1 px-3 text-sm">
                                            @if ($transfer->sender_id == user()->id)
                                                <span class=" text-[#EA0A0E]">Sent</span>
                                            @else
                                                <span class=" text-[#309AFF]">Received</span>
                                            @endif
                                        </p>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td
                                        class="w-full flex justify-center items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500"
                                            fill="currentColor" class="bi bi-exclamation-triangle-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                        </svg>
                                        <span>Empty Record. No transfer found!</span>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                <div class="cursor-pointer simple-pagination" data-paginator="transfers">
                    {{ $transfers->links('templates.' . site('template') . '.paginations.simple') }}
                </div>
            </div>

        </div>
    </div>
    <!--end p2p-->
@endsection

@section('scripts')
    <script>
        // search transfer
        $(document).on('input keyup', '#search-transfer-input', function(e) {
            var ref = $(this).val();
            var base_link = $('#search-transfer-button').data('link');
            var encodedRef = encodeURIComponent(ref);

            // Append the query parameter to the URL
            var link = base_link + '?s=' + encodedRef;
            $('#search-transfer-button').attr('href', link);
        });
    </script>


    <script>
        // handle user form
        $(document).on('submit', '#userForm', function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = new FormData(this);
            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#fullname').val(response.name)

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
                        toastNotify('error', 'An Error occured, try again later');
                    }


                }
            });
        });


        // handle transfer form
        $(document).on('submit', '#transferForm', function(e) {
            e.preventDefault();
            var amount = $('#amount').val() * 1;
            var min_transfer = "{{ site('min_transfer') }}" * 1;
            var max_transfer = "{{ site('max_transfer') }}" * 1;
            var currency = "{{ site('currency') }}";

            //check the currency code
            var error = null;
            //check min and max transfer
            if (amount < min_transfer) {
                error = 'Minimum transfer amount is ' + currency + min_transfer;
            }

            if (amount > max_transfer) {
                error = 'Maximum transfer amount is ' + currency + max_transfer;
            }

            if (error === null) {
                var form = $(this);
                var formData = new FormData(this);

                var submitButton = $(this).find('button[type="submit"]');
                submitButton.addClass('relative disabled bg-gray-500');
                submitButton.append('<span class="button-spinner"></span>');
                submitButton.prop('disabled', true);

                submitButton.removeClass('bg-gradient-to-r hover:bg-gradient-to-r hover:bg-blue-600');
                submitButton.addClass('not-allowed-cursor');


                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {


                        loadPage(form.attr('action'), submitButton, '#pageContent');

                        $('html, body').animate({
                            scrollTop: 0 + 100
                        }, 800);
                        toastNotify('success', response.message);




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
                            toastNotify('error', 'An Error occured, try again later');
                        }


                    },
                    complete: function() {
                        submitButton.removeClass('disabled  bg-gray-500');
                        submitButton.find('.button-spinner').remove();
                        submitButton.prop('disabled', false);

                        submitButton.addClass(
                            'bg-gradient-to-r hover:bg-gradient-to-r hover:bg-blue-600');
                        submitButton.removeClass('not-allowed-cursor');

                    }
                });
            } else {

                toastNotify('error', error);

            }

        });


        //////////////// initiate p2p modal
        function initializeP2pModals() {
            // console.log("Modals Initialized");

            // Deposit modal toggle
            $(document).off("click", "#openNewP2pModal").on("click", "#openNewP2pModal", function() {
                $('#NewP2pModal').removeClass('hidden hide').addClass('show');
            });

            $(document).off("click", "#closeNewP2pModal").on("click", "#closeNewP2pModal", function() {
                $('#NewP2pModal').removeClass('show').addClass('hide');
                setTimeout(function() {
                    $('#NewP2pModal').addClass('hidden');
                }, 300);
            });

        }

        // Run modal initialization on page load
        $(document).ready(function() {
            initializeP2pModals();
        });
    </script>
@endsection

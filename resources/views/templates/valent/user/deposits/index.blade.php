@extends('templates.' . site('template') . '.layouts.user')


@section('css')
    <style>
        #NewDepositModal {
            transition: opacity 0.3s ease, transform 0.3s ease;
            transform: translateX(100%);
            /* Start offscreen */
            opacity: 0;
        }

        #NewDepositModal.show {
            transform: translateX(0);
            /* Slide to visible position */
            opacity: 1;
            /* Fade in */
        }

        #NewDepositModal.hide {
            transform: translateX(100%);
            /* Slide offscreen */
            opacity: 0;
            /* Fade out */
        }
    </style>
@endsection

@section('contents')
    <!--my deposit-->
    <div class="w-full py-6">
        <div id="deposits" class="lg:max-w-screen-xl mx-auto p-4 mb-3 text-white">

            <div class="block py-4 mb-10">
                <div action="" class="lg:block hidden w-full" id="filterForm">
                    <div class="w-full flex border rounded-full">

                        <input type="text" placeholder="Txn ref" id="search-deposit-input" value="{{ request()->s }}"
                            class="py-3 h-14s px-6 rounded-l-full bg-transparent w-full text-white">

                        <div class="simple-pagination" data-paginator="deposits">
                            <a id="search-deposit-button" data-link="{{ route('user.deposits.index') }}" href=""
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
                <h1 class="text-xl lg:text-3xl font-bold">Deposit</h1>
            </div>

            <div class="lg:flex justify-between items-center mb-5 py-5">
                <div class="mb-3 block p-2">
                    <p> <span class="bg-black text-white px-6 py-2 rounded-xl border-b-4 border-[#0040BC]">My Deposit
                            History</span></p>
                </div>
                <div class="mb-3 block p-2">
                    <button id="openNewDepositModal"
                        class="border rounded-full lg:px-10 pdx-5 lg:py-4 py-2 px-6 text-lg  bg-gradient-to-r from-[#306FE6] via-[#3b82f6] to-[#0040BC] hover:text-[#0040BC] hover:bg-gradient-to-r hover:from-[#3F7DF2] hover:via-[#FFFFFF] hover:to-[#09C241] transition delay-100 duration-200 ease-in-out">New
                        Deposit</button>
                </div>



                {{-- new deposit Modal --}}
                <div id="NewDepositModal"
                    class="fixed inset-0 bg-opacity-50 flex items-center justify-end lg:px-6 px-2 hidden"
                    style="z-index: 50;">
                    <div
                        class="bg-gradient-to-r from-[#0038A5] to-[#022058] rounded-lg lg:w-3/5 w-full lg:p-10 p-4 relative z-10 mt-20 lg:mr-20">

                        <div class="flex justify-between items-center lg:mb-10 mb-4">
                            <h2 class="text-xl font-semibold mb-4 text-white">New Deposit</h2>
                            <button id="closeDepositModal" class="text-gray-400 hover:text-gray-600">
                                <img src="{{ asset('/assets/templates/valent/images/icon/close_icon.svg') }}"
                                    alt="icon">
                            </button>
                        </div>

                        <!-- Modal Content -->
                        <form action="{{ route('user.deposits.new') }}" method="post" id="depositForm">
                            @csrf
                            <div class="w-full mb-10">
                                <fieldset class="border py-1 px-3 rounded-2xl">
                                    <legend class="px-3 mx-8 text-white"><label for="amount"
                                            class="text-white text-sm">Amount ({{ site('currency') }})</label></legend>
                                    <div class="w-full text-white flex gap-4">
                                        <img src="{{ asset('/assets/templates/valent/images/icon/solar_dollar-broken.svg') }}"
                                            alt="icon">
                                        <div class="w-full">
                                            <input type="number" step="any"
                                                placeholder="Amount ({{ site('currency') }})" id="amount" name="amount"
                                                class="w-full p-4 bg-transparent text-xl text-white border-0 focus:outline-none flex-1"
                                                value="0" required>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>


                            <!--Coin for deposit Dropdown -->
                            <div class="w-full lg:mb-10 mb-4">
                                <fieldset class="border py-1 px-3 rounded-2xl">
                                    <legend class="px-3 mx-8 text-white"><label for="amount"
                                            class="text-white text-sm">Coin for deposit</label></legend>
                                    <div class="relative ">
                                        <button id="coinForDepositDropdownButton"
                                            class="w-full p-4 bg-transparent text-xl text-white border-0 focus:outline-none flex-1 flex gap-2"
                                            type="button">
                                            <div class="flex items-center w-full">
                                                <img src="" class=" rounded-full mr-2" id="selectedCoinImg" />
                                                <span id="selectedCoinText">Select Coin</span>
                                            </div>
                                            <img src="{{ asset('/assets/templates/valent/images/icon/dropdown_arrow_blue.svg') }}"
                                                alt="icon">
                                        </button>

                                        <!-- Dropdown Menu -->
                                        <ul id="coinForDepositDropdownMenu"
                                            class="absolute z-10 hidden mt-1 max-h-60 lg:w-60 w-full overflow-auto rounded-md bg-gray-600 bg-opacity-90 shadow-lg right-0">
                                            @foreach ($coins as $coin)
                                                <li class="flex items-center px-4 py-2 text-gray-900 cursor-pointer hover:bg-blue-600"
                                                    data-value="{{ $coin->code }}" data-label="{{ $coin->name }}"
                                                    data-img="{{ 'https://nowpayments.io' . $coin->logo_url }}">
                                                    <img src="{{ 'https://nowpayments.io' . $coin->logo_url }}"
                                                        alt="coin" class="h-8 w-8 rounded-full mr-2" />
                                                    <p class="">
                                                        <span class="text-white" style="text-transform: uppercase;">
                                                            @if ($coin->network)
                                                                {{ $coin->network }}
                                                            @endif
                                                        </span>
                                                        <span class="text-white"> {{ $coin->name }}</span>
                                                    </p>
                                                </li>
                                            @endforeach

                                        </ul>


                                    </div>
                                    <!-- Hidden Input for selected coin -->
                                    <input type="hidden" value="" name="currency_code" id="currency_code" />
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
                                            <td><span class="text-white">{{ formatAmount(site('min_deposit')) }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="text-[#40DDFF]">Maximum Deposit:</span></td>
                                            <td><span class="text-white">{{ formatAmount(site('max_deposit')) }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="text-[#40DDFF]">Maximum Waiting Duration :</span></td>
                                            <td><span class="text-white">7 Days</span></td>
                                        </tr>
                                    </table>
                                    <p class="text-sm">
                                        <span class="text-[#F9810A]">Warning: </span>
                                        <span class="text-[#D8D8D8]">After selecting your preferred payment method and
                                            entering the amount you want to deposit, a new wallet address will be generated
                                            for your deposit. Send only the specified token and network to the generated
                                            address or qrcode. Sending wrong token or sending to a wrong wallet address will
                                            lead to permanent</span>
                                    </p>
                                </div>
                            </div>


                            <div class="w-full">
                                <div class="flex items-center justify-center">
                                    <button type="submit"
                                        class="bg-gradient-to-r from-[#3271E8] to-[#0A4AC5] text-white hover:bg-blue-600 rounded-full px-10 py-4 lg:w-96 w-full hover:text-[#0040BC] hover:bg-gradient-to-r hover:from-[#3F7DF2] hover:via-[#FFFFFF] hover:to-[#09C241] transition delay-100 duration-200 ease-in-out flex items-center justify-center">
                                        <span class="px-2">Pay Now</span>
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
                {{-- new deposit Modal --}}


                {{-- new deposit information Modal --}}
                <div id="NewDepositInformationModal"
                    class="fixed inset-0 bg-opacity-50 flex items-center justify-end lg:px-6 px-2 hidden">
                    <div
                        class="bg-gradient-to-r from-[#0038A5] to-[#022058] rounded-lg lg:w-3/5 w-full lg:p-10 p-4 relative mt-20 lg:mr-20">

                        <div class="flex justify-between items-center lg:mb-10 mb-4">
                            <h2 class="text-xl font-semibold mb-4 text-white">New Deposit</h2>

                            <div id="paymentLink" class="hidden mt-5 mb-5 w-full flex items-center justify-center">
                                <a href="" id="paymentLinkHref" target="_blank" rel="noopener noreferrer"
                                    class="w-full bg-blue-500 px-5 py-1 rounded uppercase">Pay Now</a>
                            </div>


                            <button id="closeNewDepositInfoModal" class="text-gray-400 hover:text-gray-600">
                                <img src="{{ asset('/assets/templates/valent/images/icon/close_icon.svg') }}"
                                    alt="icon">
                            </button>
                        </div>

                        <!-- Modal Content -->
                        <div class="flex w-full justify-center mb-10">
                            <div class="bg-blue-100 rounded-xl bg-opacity-20 p-5 lg:mb-10 mb-4">
                                <div id="wallet_qrcode" class="clipboard" data-copy=""></div>
                            </div>
                        </div>

                        <div class="w-full">
                            <div class="grid grid-cols-2 border-b border-blue-200 border-opacity-25 py-3">
                                <p class="text-left text-white">Status </p>
                                <p class="text-right text-gray-400 flex gap-3 justify-end items-center">
                                    <span class="w-4 h-4 bg-[#D8D8D8] rounded-full"></span>
                                    <span id="display_deposit_status"></span>
                                </p>
                            </div>
                            <div class="grid grid-cols-2 border-b border-blue-200 border-opacity-25 py-3">
                                <p class="text-left text-white">Valid Until </p>
                                <p class="text-right text-gray-400">
                                    <span id="display_deposit_valid_until"></span>

                                </p>
                            </div>
                            <div class="grid grid-cols-2 border-b border-blue-200 border-opacity-25 py-3">
                                <p class="text-left text-white">Amount </p>
                                <p class="text-right text-gray-400">{{ site('currency') }}<span
                                        id="display_deposit_amount"></span></p>
                            </div>
                            <div class="grid grid-cols-2 border-b border-blue-200 border-opacity-25 py-3">
                                <p class="text-left text-white">Fee </p>
                                <p class="text-right text-gray-400">{{ site('currency') }}<span
                                        id="display_deposit_fee"></span>
                                </p>
                            </div>
                            <div class="grid grid-cols-2 border-b border-blue-200 border-opacity-25 py-3">
                                <p class="text-left text-white">Pay Amount </p>
                                <p class="text-right text-gray-400">
                                    <span id="display_deposit_converted_amount" class="clipboard cursor-pointer"
                                        data-copy=""> </span>
                                    <span id="display_deposit_currency"></span>
                                </p>
                            </div>
                            <div class="grid grid-cols-2 border-b border-blue-200 border-opacity-25 py-3">
                                <p class="text-left text-white">Network </p>
                                <p class="text-right text-gray-400">
                                    <span id="display_deposit_network" class="clipboard cursor-pointer"
                                        data-copy=""></span>
                                </p>
                            </div>
                            <div class="grid grid-cols-2 border-b border-blue-200 border-opacity-25 py-3">
                                <p class="text-left text-white">Wallet Address </p>
                                <p class="text-right text-gray-400 flex gap-3 justify-end items-center">
                                    <span id="display_deposit_payment_wallet" class="clipboard cursor-pointer"
                                        data-copy=""></span>
                                    <img src="{{ asset('/assets/templates/valent/images/icon/copy_icon.svg') }}"
                                        alt="icon" id="display_deposit_payment_wallet_icon" data-copy=""
                                        class="clipboard" style="cursor: pointer;">
                                </p>
                            </div>
                            <div class="grid grid-cols-2 border-b border-blue-200 border-opacity-25 py-3">
                                <p class="text-left text-white">Txn Ref </p>
                                <p class="text-right text-gray-400">
                                    <span id="display_deposit_ref" class="clipboard cursor-pointer"
                                        data-copy=""></span>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
                {{-- new deposit information modal --}}


            </div>


            <div
                class="block bg-blue-600 bg-opacity-10 border border-opacity-15 border-blue-200 rounded-t-2xl overflow-auto w-full min-h-[60vh]">
                <table class="w-full" id="depositTable">
                    <thead class="text-center bg-gray-400 bg-opacity-25">
                        <th class="p-6 text-left lg:min-w-52 min-w-[50vw]">AI Bots/ID</th>
                        <th class="p-6 text-right lg:min-w-52 min-w-[50vw]">Amount</th>
                        <th class="p-6 text-left lg:min-w-52 min-w-[50vw]">Data</th>
                        <th class="p-6 text-left lg:min-w-52 min-w-[50vw]">Time</th>
                        <th class="p-6 text-left gap-2 lg:min-w-52 min-w-[50vw]">
                            <button id="status-dropdown-btn" class="flex gap-3 items-center">Status
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
                                    <path
                                        d="M11.178 19.569a.998.998 0 0 0 1.644 0l9-13A.999.999 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13z">
                                    </path>
                                </svg>
                            </button>
                            <aside id="status-dropdown"
                                class="hidden absolute right-20 lg:right-56 lg:w-[300px] bg-[#2d3039] bg-opacity-90 rounded-xl">
                                <ul class="py-6 px-10">
                                    <li><a href="" class="text-white text-xl flex gap-2 p-2"> All</a></li>
                                    <li><a href="" class="text-white text-xl flex items-center gap-2 p-2"> <span
                                                class="w-4 h-4 bg-[#E9790A] rounded-full"></span> Confirming</a></li>
                                    <li><a href="" class="text-white text-xl flex items-center gap-2 p-2"> <span
                                                class="w-4 h-4 bg-[#D8D8D8] rounded-full"></span> Waiting</a></li>
                                    <li><a href="" class="text-white text-xl flex items-center gap-2 p-2"> <span
                                                class="w-4 h-4 bg-[#40DDFF] rounded-full"></span> Partly Paid</a></li>
                                    <li><a href="" class="text-white text-xl flex items-center gap-2 p-2"> <span
                                                class="w-4 h-4 bg-[#08C949] rounded-full"></span> Finished</a></li>
                                    <li><a href="" class="text-white text-xl flex items-center gap-2 p-2"> <span
                                                class="w-4 h-4 bg-[#EA0A0E] rounded-full"></span> Expired</a></li>
                                </ul>
                            </aside>
                        </th>
                    </thead>
                    <tbody>
                        @forelse ($deposits as $deposit)
                            <tr class="border-t border-opacity-25 border-blue-200">
                                <td class="p-2" data-deposit_tnx="{{ $deposit->ref }}">
                                    <div class="flex items-center gap-4 ">
                                        <img class="w-12 h-12"
                                            src="{{ 'https://nowpayments.io' . $deposit->depositCoin->logo_url }}"
                                            alt="">
                                        <div class="block">
                                            <p class="text-md font-bold">
                                                {{ $deposit->depositCoin->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right p-2">
                                    <p class="text-md">{{ formatAmount($deposit->amount) }}</p>
                                    <p class=" text-gray-400">{{ $deposit->converted_amount . ' ' . $deposit->currency }}
                                    </p>
                                </td>
                                <td class="text-left p-2">
                                    <p class="text-md">{{ date('d-m-y', strtotime($deposit->created_at)) }}</p>
                                </td>
                                <td class="text-left p-2">
                                    <p class="text-md">{{ date('H:i:s', strtotime($deposit->created_at)) }}</p>
                                </td>
                                <td class="text-left p-2 flex justify-between" x-data="{ openDepositDetail: false, }">
                                    <div class="flex items-center gap-2">
                                        <p class="flex justify-end items-center space-x-1 gap-4">

                                            @if ($deposit->status == 'waiting')
                                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="0.0820312" y="0.322632" width="18" height="18"
                                                        rx="9" fill="#D8D8D8" fill-opacity="0.11" />
                                                    <circle cx="5" cy="5" r="5"
                                                        transform="matrix(-1 0 0 1 14.082 4.32263)" fill="#D8D8D8" />
                                                </svg>
                                                <span
                                                    class="text-gray-500 uppercase text-xs">{{ $deposit->status }}</span>
                                            @elseif ($deposit->status == 'finished')
                                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8.65505 1.74993C8.92055 1.48478 9.27577 1.32877 9.65064 1.31266C10.0255 1.29656 10.3928 1.42153 10.6801 1.66293L10.7761 1.75068L12.2011 3.17493H14.2156C14.5939 3.175 14.9582 3.31801 15.2355 3.57531C15.5128 3.8326 15.6827 4.18519 15.7111 4.56243L15.7156 4.67493V6.68943L17.1406 8.11443C17.4059 8.37996 17.5621 8.73533 17.5782 9.11038C17.5943 9.48542 17.4692 9.85288 17.2276 10.1402L17.1398 10.2354L15.7148 11.6604V13.6749C15.7149 14.0534 15.572 14.4179 15.3147 14.6953C15.0574 14.9728 14.7047 15.1428 14.3273 15.1712L14.2156 15.1749H12.2018L10.7768 16.5999C10.5113 16.8653 10.1559 17.0214 9.78085 17.0375C9.40581 17.0536 9.03836 16.9285 8.75105 16.6869L8.6558 16.5999L7.2308 15.1749H5.21555C4.83712 15.175 4.47263 15.0321 4.19514 14.7748C3.91766 14.5175 3.74769 14.1648 3.7193 13.7874L3.71555 13.6749V11.6604L2.29055 10.2354C2.0252 9.9699 1.86905 9.61452 1.85295 9.23948C1.83684 8.86443 1.96194 8.49698 2.20355 8.20968L2.29055 8.11443L3.71555 6.68943V4.67493C3.71562 4.29663 3.85863 3.93232 4.11593 3.65499C4.37323 3.37767 4.72582 3.2078 5.10305 3.17943L5.21555 3.17493H7.23005L8.65505 1.74993Z"
                                                        fill="#08C949" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M12.0238 6.91219L8.84078 10.0952L7.51478 8.76919C7.37405 8.62856 7.18321 8.5496 6.98426 8.54967C6.78531 8.54974 6.59453 8.62884 6.4539 8.76957C6.31327 8.9103 6.2343 9.10113 6.23438 9.30008C6.23445 9.49904 6.31355 9.68981 6.45428 9.83044L8.25728 11.6334C8.33389 11.7101 8.42485 11.7709 8.52497 11.8124C8.62509 11.8539 8.7324 11.8752 8.84078 11.8752C8.94915 11.8752 9.05646 11.8539 9.15658 11.8124C9.2567 11.7709 9.34766 11.7101 9.42428 11.6334L13.0843 7.97269C13.2209 7.83124 13.2965 7.64179 13.2948 7.44514C13.2931 7.2485 13.2142 7.06039 13.0751 6.92133C12.9361 6.78227 12.748 6.7034 12.5513 6.70169C12.3547 6.69998 12.1652 6.77558 12.0238 6.91219Z"
                                                        fill="#F0FCFF" />
                                                </svg>
                                                <span
                                                    class="text-green-500 uppercase text-xs">{{ $deposit->status }}</span>
                                            @elseif ($deposit->status == 'expired' || $deposit->status == 'failed' || $deposit->status == 'refunded')
                                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8.65505 1.80913C8.92055 1.54399 9.27577 1.38797 9.65064 1.37187C10.0255 1.35576 10.3928 1.48074 10.6801 1.72213L10.7761 1.80988L12.2011 3.23413H14.2156C14.5939 3.2342 14.9582 3.37721 15.2355 3.63451C15.5128 3.89181 15.6827 4.24439 15.7111 4.62163L15.7156 4.73413V6.74863L17.1406 8.17363C17.4059 8.43916 17.5621 8.79454 17.5782 9.16958C17.5943 9.54463 17.4692 9.91208 17.2276 10.1994L17.1398 10.2946L15.7148 11.7196V13.7341C15.7149 14.1126 15.572 14.4771 15.3147 14.7545C15.0574 15.032 14.7047 15.202 14.3273 15.2304L14.2156 15.2341H12.2018L10.7768 16.6591C10.5113 16.9245 10.1559 17.0806 9.78085 17.0967C9.40581 17.1128 9.03836 16.9877 8.75105 16.7461L8.6558 16.6591L7.2308 15.2341H5.21555C4.83712 15.2343 4.47263 15.0913 4.19514 14.834C3.91766 14.5767 3.74769 14.224 3.7193 13.8466L3.71555 13.7341V11.7196L2.29055 10.2946C2.0252 10.0291 1.86905 9.67373 1.85295 9.29868C1.83684 8.92364 1.96194 8.55618 2.20355 8.26888L2.29055 8.17363L3.71555 6.74863V4.73413C3.71562 4.35583 3.85863 3.99152 4.11593 3.7142C4.37323 3.43687 4.72582 3.267 5.10305 3.23863L5.21555 3.23413H7.23005L8.65505 1.80913Z"
                                                        fill="#EA0A0E" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M12.0238 6.9714L8.84078 10.1544L7.51478 8.8284C7.37405 8.68777 7.18321 8.6088 6.98426 8.60887C6.78531 8.60894 6.59453 8.68804 6.4539 8.82877C6.31327 8.9695 6.2343 9.16034 6.23438 9.35929C6.23445 9.55824 6.31355 9.74902 6.45428 9.88965L8.25728 11.6926C8.33389 11.7693 8.42485 11.8301 8.52497 11.8716C8.62509 11.9131 8.7324 11.9344 8.84078 11.9344C8.94915 11.9344 9.05646 11.9131 9.15658 11.8716C9.2567 11.8301 9.34766 11.7693 9.42428 11.6926L13.0843 8.0319C13.2209 7.89045 13.2965 7.70099 13.2948 7.50435C13.2931 7.3077 13.2142 7.11959 13.0751 6.98053C12.9361 6.84148 12.748 6.7626 12.5513 6.76089C12.3547 6.75918 12.1652 6.83478 12.0238 6.9714Z"
                                                        fill="#F0FCFF" />
                                                </svg>
                                                <span class="text-red-500 uppercase text-xs">{{ $deposit->status }}</span>
                                            @else
                                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="0.0820312" y="0.322632" width="18" height="18"
                                                        rx="9" fill="#D8D8D8" fill-opacity="0.11" />
                                                    <circle cx="5" cy="5" r="5"
                                                        transform="matrix(-1 0 0 1 14.082 4.32263)" fill="#D8D8D8" />
                                                </svg>
                                                <span
                                                    class="text-orange-500 uppercase text-xs">{{ $deposit->status }}</span>
                                            @endif
                                        </p>
                                    </div>
                                    <button data-link="{{ route('user.deposits.view', ['ref' => $deposit->ref]) }}"
                                        class="view-single-deposit flex gap-2 rounded-full lg:w-auto w-20 bg-gray-500 bg-opacity-40 py-2 px-4"
                                        style="cursor: pointer;">
                                        <img src="{{ asset('/assets/templates/valent/images/icon/eye_blue.svg') }}"
                                            alt="icon" class="w-4 h-5">
                                        <span class="text-sm text-[#309AFF]">View</span>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <div
                                class="w-full flex justify-center items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500"
                                    fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>
                                <span>Empty Record. No depsoit found!</span>
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>


            <div class="cursor-pointer simple-pagination" data-paginator="deposits">
                {{ $deposits->links('templates.' . site('template') . '.paginations.simple') }}
            </div>

        </div>
    </div>
    <!--end my deposit-->

    {{-- modal content --}}
    <div class="w-full">
        <div class="fixed inset-0 sbg-black bg-opacity-50 flex items-center justify-end lg:px-6 px-2 hidden text-white"
            id="modalContent">
            <div id="modalDisplay"></div>
        </div>
    </div>
@endsection





@section('scripts')
    <script>
        //# // search deposit
        $(document).on('input keyup', '#search-deposit-input', function(e) {
            var ref = $(this).val();
            var base_link = $('#search-deposit-button').data('link');
            var encodedRef = encodeURIComponent(ref);

            // Append the query parameter to the URL
            var link = base_link + '?s=' + encodedRef;
            $('#search-deposit-button').attr('href', link);
        });
    </script>

    <script>
        //close dposit details modal
        $('#modalDisplay').on('click', '#closeDepositDetail', function() {
            // You can add code to hide the modal here.
            $('#modalContent').addClass('hidden');
        });



        let interval;
        //single deposit
        $(document).on('click', '.view-single-deposit', function(e) {
            var clicked = $(this);
            clicked.addClass('relative disabled');
            clicked.append('<span class="button-spinner"></span>');
            clicked.prop('disabled', true);
            var link = $(this).data('link');

            $('#modalContent').removeClass('hidden');
            var html = $('#single-display-new-deposit-information');

            $.ajax({
                url: link,
                method: 'GET',
                success: function(response) {
                    var deposit = response.deposit;

                    var modalContent = `
                    <div id="single-display-new-deposit-information"
                            class="bg-gradient-to-r from-[#0038A5] to-[#022058] rounded-lg w-full lg:p-10 p-4 relative mt-20 lg:mr-20">

                            <div class="flex justify-between items-center lg:mb-10 mb-4">
                                <h2 class="text-xl font-semibold mb-4 text-white">Deposit Details</h2>
                                <button id="closeDepositDetail"
                                    class="closeDepositDetail text-gray-400 hover:text-gray-600">
                                    <img src="{{ asset('/assets/templates/valent/images/icon/close_icon.svg') }}" alt="icon">
                                </button>
                            </div>

                            <!-- Modal Content -->
                            <div class="flex w-full justify-center mb-10">
                                <div class="bg-blue-100 rounded-xl bg-opacity-20 p-2 lg:mb-10 mb-4">
                                    <div id="single_wallet_qrcode" class="clipboard" data-copy=""></div>
                                </div>
                            </div>

                            <div class="w-full">
                                <div class="grid grid-cols-2 border-b border-blue-200 border-opacity-25 py-3">
                                    <p class="text-left text-white">Status </p>
                                    <p class="text-right text-gray-400 flex gap-3 justify-end items-center">
                                        <span class="w-4 h-4 bg-[#D8D8D8] rounded-full"></span><span
                                            id="single_display_deposit_status"></span>
                                    </p>
                                </div>
                                <div class="grid grid-cols-2 border-b border-blue-200 border-opacity-25 py-3">
                                    <p class="text-left text-white">Valid Until </p>
                                    <p class="text-right text-gray-400"><span id="single_display_deposit_valid_until"></span></p>
                                </div>
                                <div class="grid grid-cols-2 border-b border-blue-200 border-opacity-25 py-3">
                                    <p class="text-left text-white">Amount </p>
                                    <p class="text-right text-gray-400">{{ site('currency') }}<span id="single_display_deposit_amount"></span>
                                    </p>
                                </div>
                                <div class="grid grid-cols-2 border-b border-blue-200 border-opacity-25 py-3">
                                    <p class="text-left text-white">Fee </p>
                                    <p class="text-right text-gray-400">{{ site('currency') }}<span id="single_display_deposit_fee"></span> </p>
                                </div>
                                <div class="grid grid-cols-2 border-b border-blue-200 border-opacity-25 py-3">
                                    <p class="text-left text-white">Pay Amount </p>
                                    <p class="text-right text-gray-400">
                                        <span id="single_display_deposit_converted_amount" class="clipboard cursor-pointer"
                                            data-copy=""> </span>
                                        <span id="single_display_deposit_currency"></span>
                                    </p>
                                </div>
                                <div class="grid grid-cols-2 border-b border-blue-200 border-opacity-25 py-3">
                                    <p class="text-left text-white">Network </p>
                                    <p class="text-right text-gray-400">
                                        <span id="single_display_deposit_network" class="clipboard cursor-pointer" data-copy=""></span>
                                    </p>
                                </div>
                                <div class="grid grid-cols-2 border-b border-blue-200 border-opacity-25 py-3">
                                    <p class="text-left text-white">Wallet Address </p>
                                    <p class="text-right text-gray-400 flex gap-3 justify-end items-center">
                                        <span id="wallet_address" class="wallet-address lg:text-md text-[12px]">
                                            <span id="single_display_deposit_payment_wallet" class="wallet_address clipboard cursor-pointer"
                                                data-copy=""></span>
                                        </span>
                                        <img src="{{ asset('/assets/templates/valent/images/icon/copy_icon.svg') }}" alt="icon"
                                            class="clipboard" style="cursor: pointer;" data-copy="" id="single_display_deposit_payment_wallet_icon">
                                    </p>
                                </div>
                                <div class="grid grid-cols-2 border-b border-blue-200 border-opacity-25 py-3">
                                    <p class="text-left text-white">Txn Ref </p>
                                    <p class="text-right text-gray-400"><span id="single_display_deposit_ref"
                                            class="clipboard cursor-pointer" data-copy=""></span></p>
                                </div>
                            </div>

                        </div>
                    `;

                    $('#modalContent').removeClass("hidden");
                    $('#modalDisplay').html(modalContent);

                    // Loop through the deposit object's properties
                    for (var key in deposit) {
                        if (deposit.hasOwnProperty(key)) {
                            var value = deposit[key];
                            var element = $('#single_display_deposit_' + key);
                            if (element.length > 0) {
                                element.text(value);
                            }


                            //update the copy attribute
                            if (element.hasClass('clipboard')) {
                                element.attr('data-copy', value);
                            }

                            // update clipboard attribute for only wallet view icon

                            if (key == 'payment_wallet') {
                                var walletViewIcon = $('#single_display_deposit_payment_wallet_icon');
                                walletViewIcon.attr('data-copy', deposit.payment_wallet);
                            }


                        }
                    }

                    // create qrcode
                    var qrCodeElement = document.getElementById('single_wallet_qrcode');
                    var qrCode = new QRCode(qrCodeElement, {
                        text: deposit.payment_wallet,
                        width: 200,
                        height: 200
                    });

                    var walletQrCodeDiv = document.getElementById('single_wallet_qrcode');
                    walletQrCodeDiv.setAttribute('data-copy', deposit.payment_wallet);
                    var imageElement = walletQrCodeDiv.querySelector('img');
                    imageElement.classList.add('rounded-lg', 'border', 'border-slate-800',
                        'hover:border-slate-600', 'cursor-pointer', 'p-1');
                    //imageElement.setAttribute('style', '');

                    //create a count down
                    var targetId = 'single_display_deposit_valid_until';
                    var targetDateString = deposit.valid_until;
                    if (interval) {
                        clearInterval(interval);
                    }

                    interval = setInterval(function() {
                        updateCountdown(targetId, targetDateString);
                    }, 1000);

                    // Check payment status
                    var ref = deposit.ref
                    setInterval(function() {
                        $.ajax({
                            url: "{{ url('/user/deposits/view') }}" + '/' + deposit
                                .ref,
                            method: 'GET',
                            success: function(response) {
                                var status = response.deposit.status;
                                $('#single_display_deposit_status').html(status);


                            }
                        });
                    }, 10000);


                },
                complete: function() {
                    clicked.removeClass('disabled');
                    clicked.find('.button-spinner').remove();
                    clicked.prop('disabled', false);

                }
            });

        });
        // select the deposit coin
        $(document).on('click', ".coin", function(e) {
            $('.coin_select').addClass('hidden');
            var target = '#' + $(this).data('target');
            $(target).toggleClass('hidden');

            var currency_code = $(this).data('currency_code');
            $("#currency_code").val(currency_code);

        });


        // filter the coins
        $(document).on('input keyup', '#coin-search-input', function() {
            var searchText = $(this).val().toLowerCase();

            $('.coin').hide().filter(function() {
                return $(this).text().toLowerCase().includes(searchText);
            }).show();
        });


        // handle deposit form
        $(document).on('submit', '#depositForm', function(e) {
            e.preventDefault();
            var amount = $('#amount').val() * 1;
            var currency_code = $('#currency_code').val();
            var min_deposit = "{{ site('min_deposit') }}" * 1;
            var max_deposit = "{{ site('max_deposit') }}" * 1;
            var currency = "{{ site('currency') }}";

            //check the currency code
            var error = null;
            if (!currency_code) {
                error = 'You have not selected a deposit method';
            }

            //check min and max deposit
            if (amount < min_deposit) {
                error = 'Minimum deposit amount is ' + currency + min_deposit;
            }

            if (amount > max_deposit) {
                error = 'Maximum deposit amount is ' + currency + max_deposit;
            }

            if (error === null) {
                var form = $(this);
                var formData = new FormData(this);

                var submitButton = $(this).find('button[type="submit"]');
                submitButton.addClass('relative disabled bg-gray-500');
                submitButton.append('<span class="button-spinner"></span>');
                // new modification
                submitButton.removeClass('bg-gradient-to-r hover:bg-gradient-to-r hover:bg-blue-600');
                submitButton.addClass('not-allowed-cursor');
                //
                submitButton.prop('disabled', true);
                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#amount').val(0);
                        var deposit = response.deposit;
                        $('#NewDepositModal').toggleClass('hidden');
                        $('#NewDepositInformationModal').toggleClass('hidden');

                        submitButton.addClass(
                            'bg-gradient-to-r hover:bg-gradient-to-r hover:bg-blue-600');
                        submitButton.removeClass('not-allowed-cursor');

                        if (deposit.link !== 'nill' && deposit.link !== 'undefined') {
                            // window.location.href = deposit.link;
                            // window.open(deposit.link, "_blank");
                            $("#paymentLink").removeClass('hidden');
                            $("#paymentLinkHref").attr('href', deposit.link);
                            window.location.href = deposit.link;
                        }

                        // Loop through the deposit object's properties
                        for (var key in deposit) {
                            if (deposit.hasOwnProperty(key)) {
                                var value = deposit[key];
                                var element = $('#display_deposit_' + key);
                                if (element.length > 0) {
                                    element.text(value);
                                }

                                //update the copy attribute
                                if (element.hasClass('clipboard')) {
                                    element.attr('data-copy', value);
                                }


                            }
                        }


                        //create a count down
                        var targetId = 'display_deposit_valid_until';
                        var targetDateString = deposit.valid_until;
                        const interval = setInterval(function() {
                            updateCountdown(targetId, targetDateString);
                        }, 1000);

                        // create qrcode
                        var qrCodeElement = document.getElementById('wallet_qrcode');
                        qrCodeElement.innerHTML = '';

                        var qrCode = new QRCode(qrCodeElement, {
                            text: deposit.payment_wallet,
                            width: 200,
                            height: 200
                        });

                        var walletQrCodeDiv = document.getElementById('wallet_qrcode');
                        walletQrCodeDiv.setAttribute('data-copy', deposit.payment_wallet);
                        var imageElement = walletQrCodeDiv.querySelector('img');
                        imageElement.classList.add('rounded-lg', 'border', 'border-slate-800',
                            'hover:border-slate-600', 'cursor-pointer', 'p-1');

                        $('html, body').animate({
                            scrollTop: 0 + 100
                        }, 800);
                        toastNotify('success', 'Deposit request initated successfully');

                        // Check payment status
                        var ref = deposit.ref
                        setInterval(function() {
                            $.ajax({
                                url: "{{ url('/user/deposits/view') }}" + '/' + deposit
                                    .ref,
                                method: 'GET',
                                success: function(response) {
                                    var status = response.deposit.status;
                                    $('#display_deposit_status').html(status);
                                }
                            });
                        }, 10000);

                        ///function to update deposit table
                        var link = window.location.href;
                        var clicked = false;
                        var targetDiv = "#depositTable"
                        loadPage(link, clicked, targetDiv);


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

                                submitButton.addClass(
                                    'bg-gradient-to-r hover:bg-gradient-to-r hover:bg-blue-600'
                                );
                                submitButton.removeClass('not-allowed-cursor');

                            });
                        } else {
                            toastNotify('error', 'An Error occured, try again later');

                            submitButton.addClass(
                                'bg-gradient-to-r hover:bg-gradient-to-r hover:bg-blue-600');
                            submitButton.removeClass('not-allowed-cursor');
                        }


                    },
                    complete: function() {
                        submitButton.removeClass('disabled');
                        submitButton.find('.button-spinner').remove();
                        submitButton.prop('disabled', false);

                    }
                });
            } else {

                toastNotify('error', error);

            }

        });
    </script>



    <script>
        function initializeDepositModals() {
            // console.log("Modals Initialized");

            // Deposit modal toggle
            $(document).off("click", "#openNewDepositModal").on("click", "#openNewDepositModal", function() {
                $('#NewDepositModal').removeClass('hidden hide').addClass('show');
            });

            $(document).off("click", "#closeDepositModal").on("click", "#closeDepositModal", function() {
                $('#NewDepositModal').removeClass('show').addClass('hidden hide');
                setTimeout(function() {
                    $('#NewDepositModal').addClass('hidden hide');
                }, 300);
            });

            $(document).off("click", "#closeNewDepositInfoModal").on("click", "#closeNewDepositInfoModal", function() {
                $('#NewDepositInformationModal').toggleClass('hidden');
            });

        }

        // Run modal initialization on page load
        $(document).ready(function() {
            initializeDepositModals();
        });


        $(document).ready(function() {

            //deposit information modal to be triggers if http status is 200
            var status = 404;
            if (status == 200) {
                $('#depositInfoModal').addClass('block').removeClass('hidden');
            }

            $("#closeNewDepositInfoModal").on("click", function() {
                $('#depositInfoModal').addClass('hidden').removeClass('block');
            });

        });

        $('#status-dropdown-btn').click(function() {
            $('#status-dropdown').toggleClass('hidden');
        });
    </script>

    <script>
        function initializeCoinDropdown() {
            $(document).off("click", "#coinForDepositDropdownButton").on("click", "#coinForDepositDropdownButton",
                function() {
                    const coinForDepositDropdownMenu = $('#coinForDepositDropdownMenu');
                    if (coinForDepositDropdownMenu.hasClass('hidden')) {
                        coinForDepositDropdownMenu
                            .removeClass('hidden')
                            .addClass('scale-100 opacity-100')
                            .slideDown(200);
                    } else {
                        coinForDepositDropdownMenu
                            .slideUp(200, function() {
                                $(this).addClass('hidden').removeClass('scale-100 opacity-100');
                            });
                    }
                });

            // Close dropdown when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#coinForDepositDropdownButton, #coinForDepositDropdownMenu').length) {
                    $('#coinForDepositDropdownMenu')
                        .slideUp(200, function() {
                            $(this).addClass('hidden').removeClass('scale-100 opacity-100');
                        });
                }
            });

            // Use event delegation for dynamically added <li> elements
            $(document).on('click', '#coinForDepositDropdownMenu li', function() {
                const label = $(this).data('label');
                const imgSrc = $(this).data('img');
                const value = $(this).data('value');

                // Update the button with the selected coin
                $('#selectedCoinText').text(label);
                $('#selectedCoinImg').attr('src', imgSrc).addClass('w-8 h-8');

                // Update the hidden input value
                $('#currency_code').val(value);

                // Hide the dropdown menu
                $('#coinForDepositDropdownMenu')
                    .slideUp(200, function() {
                        $(this).addClass('hidden').removeClass('scale-100 opacity-100');
                    });
            });
        }

        // Run modal initialization on page load
        $(document).ready(function() {
            initializeCoinDropdown();
        });
    </script>
@endsection

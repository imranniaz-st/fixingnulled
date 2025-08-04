@extends('templates.' . site('template') . '.layouts.user')

@section('css')
    <style>
        #NewWithdrawalModal {
            transition: opacity 0.3s ease, transform 0.3s ease;
            transform: translateX(100%);
            /* Start offscreen */
            opacity: 0;
        }

        #NewWithdrawalModal.show {
            transform: translateX(0);
            /* Slide to visible position */
            opacity: 1;
            /* Fade in */
        }

        #NewWithdrawalModal.hide {
            transform: translateX(100%);
            /* Slide offscreen */
            opacity: 0;
            /* Fade out */
        }
    </style>
@endsection


@section('contents')
    {{-- withdrawal --}}
    <div class="w-full py-6" data-aos="fade-up" id="pageContent">
        <div class="lg:max-w-screen-xl mx-auto lg:p-4 mb-3 text-white" id="refresh">


            <div class="hidden py-4 mb-10" id="filterForm">
                <div action="" class="lg:block hidden w-full">
                    <div class="w-full flex border rounded-full">

                        <input type="text" placeholder="Txn ref" id="search-withdrawal-input" value="{{ request()->s }}"
                            class="py-3 h-14s px-6 rounded-l-full bg-transparent w-full text-white">

                        <div class="simple-pagination" data-paginator="withdrawals">
                            <a id="search-withdrawal-button" data-link="{{ route('user.withdrawals.index') }}"
                                href=""
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
                <h1 class="text-xl lg:text-3xl font-bold">Withdrawal</h1>
            </div>


            <div class="lg:flex justify-between items-center mb-5 py-5">
                <div class="mb-3 block p-2">
                    <div class="flex gap-4">
                        <button id="myWithdrawalWalletsBtn"
                            class="bg-black text-white px-6 py-2 rounded-xl border-b-4 border-[#0040BC] lg:text-md text-sm">Withdrawal
                            Wallets</button>
                        <button id="myWithdrawalHistoryBtn"
                            class="bg-black text-white px-6 py-2 rounded-xl hover:border-b-4 border-[#0040BC] lg:text-md text-sm">My
                            Withdrawal History</button>
                    </div>
                </div>
                <div class="mb-3 block p-2">
                    <button id="openWithdrawalModal"
                        class="border rounded-full lg:px-10 pdx-5 lg:py-4 py-2 px-6 text-lg  bg-gradient-to-r from-[#306FE6] via-[#3b82f6] to-[#0040BC] hover:text-[#0040BC] hover:bg-gradient-to-r hover:from-[#3F7DF2] hover:via-[#FFFFFF] hover:to-[#09C241] transition delay-100 duration-200 ease-in-out">New
                        Withdrawal</button>
                </div>



                <!-- new withdrawal Modal -->
                <div id="NewWithdrawalModal"
                    class="hidden fixed inset-0 bg-opacity-50 flex items-center justify-end lg:px-6 px-2"
                    style="z-index: 50;">
                    <div
                        class="bg-gradient-to-r from-[#0038A5] to-[#022058] rounded-lg lg:w-3/5 w-full lg:p-10 p-4 relative mt-20 lg:mr-20">

                        <div class="flex justify-between items-center lg:mb-10 mb-4">
                            <h2 class="text-xl font-semibold mb-4 text-white">New Withdrawal</h2>
                            <button id="closeWithdrawalModal" class="text-gray-400 hover:text-gray-600">
                                <img src="{{ asset('/assets/templates/valent/images/icon/close_icon.svg') }}"
                                    alt="icon">
                            </button>
                        </div>

                        <!-- Modal Content -->
                        <form action="{{ route('user.withdrawals.new') }}" method="post" id="withdrawalForm"
                            {{-- class="gen-form" --}} data-action="reload">
                            @csrf

                            <!--Coin for deposit Dropdown -->
                            <div class="w-full lg:mb-10 mb-4">

                                @if (site('auto_withdraw') == 1)
                                    @if ($auto_wallets->count() > 0)
                                        <fieldset class="border py-1 px-3 rounded-2xl">
                                            <legend class="px-3 mx-8 text-white"><label for="amount"
                                                    class="text-white text-sm">Coin for withdrawal</label></legend>
                                            <div class="relative ">
                                                <button id="coinForDepositDropdownButton"
                                                    class="w-full p-4 bg-transparent text-xl text-white border-0 focus:outline-none flex-1 flex gap-2"
                                                    type="button">
                                                    <div class="flex items-center w-full">
                                                        <img src="" class=" rounded-full mr-2"
                                                            id="selectedCoinImg" />
                                                        <span id="selectedCoinText">Select Coin</span>
                                                    </div>
                                                    <img src="{{ asset('/assets/templates/valent/images/icon/dropdown_arrow_blue.svg') }}"
                                                        alt="icon">
                                                </button>

                                                <!-- Dropdown Menu -->
                                                <ul id="coinForDepositDropdownMenu"
                                                    class="absolute z-10 hidden mt-1 max-h-60 lg:w-60 w-full overflow-auto rounded-md bg-gray-600 bg-opacity-90 shadow-lg right-0">
                                                    @foreach ($coins as $coin)
                                                        @if (array_key_exists($coin->code, $auto_wallets_array))
                                                            <li class="flex items-center px-4 py-2 text-gray-900 cursor-pointer hover:bg-blue-600"
                                                                data-target="{{ $coin->code }}"
                                                                data-wallet="{{ $auto_wallets_array[$coin->code] }}"
                                                                data-currency_code="{{ $coin->code }}"
                                                                data-img="{{ 'https://nowpayments.io' . $coin->logo_url }}">
                                                                <img src="{{ 'https://nowpayments.io' . $coin->logo_url }}"
                                                                    alt="coin" class="h-8 w-8 rounded-full mr-2" />
                                                                <p class="" id="{{ $coin->code }}">
                                                                    <span class="text-white"
                                                                        style="text-transform: uppercase;">
                                                                        @if ($coin->network)
                                                                            {{ $coin->network }}
                                                                        @endif
                                                                    </span>
                                                                    <span class="text-white"> {{ $coin->name }}</span>
                                                                </p>
                                                            </li>
                                                        @endif
                                                    @endforeach

                                                </ul>


                                            </div>
                                            <!-- Hidden Input for selected coin -->
                                            <input type="hidden" value="" name="currency_code" id="currency_code" />
                                        </fieldset>
                                    @else
                                        <div
                                            class="w-full flex justify-center items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500"
                                                fill="currentColor" class="bi bi-exclamation-triangle-fill"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                            </svg>
                                            <span>You have not added any withdrawal wallet!</span>
                                        </div>
                                    @endif
                                @else
                                    <fieldset class="border py-1 px-3 rounded-2xl">
                                        <legend class="px-3 mx-8 text-white"><label for="amount"
                                                class="text-white text-sm">Coin for withdrawal</label></legend>
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
                                                        data-value="{{ $coin->code }}"
                                                        data-label="{{ $coin->name }}"
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
                                @endif

                            </div>


                            <div class="w-full mb-10">
                                <fieldset class="border py-1 px-3 rounded-2xl">
                                    <legend class="px-3 mx-8 text-white"><label for="amount"
                                            class="text-white text-sm">Amount ({{ site('currency') }})</label></legend>
                                    <div class="w-full text-white flex gap-4">
                                        <img src="{{ asset('/assets/templates/valent/images/icon/solar_dollar-broken.svg') }}"
                                            alt="icon">
                                        <div class="w-full">
                                            <input type="number" step="any" name="amount" id="amount"
                                                value="0"
                                                class="w-full p-4 bg-transparent text-xl text-white border-0 focus:outline-none flex-1"
                                                placeholder="Amount ({{ site('currency') }})" required>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="w-full mb-10">
                                <fieldset class="border py-1 px-3 rounded-2xl">
                                    <legend class="px-3 mx-8 text-white"><label for="amount"
                                            class="text-white text-sm">Wallet Address</label></legend>
                                    <div class="w-full text-white flex gap-4">
                                        <img src="{{ asset('/assets/templates/valent/images/icon/solar_dollar-broken.svg') }}"
                                            alt="icon">
                                        <div class="w-full">
                                            <input type="text" id="wallet_address" name="wallet_address"
                                                value="" @if (site('auto_withdraw') == 1) readonly @endif
                                                class="w-full p-4 bg-transparent text-xl text-white border-0 focus:outline-none flex-1"
                                                placeholder="Wallet address" required>
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
                                            <td><span class="text-[#40DDFF]">Minimum Withdrawal:</span></td>
                                            <td><span class="text-white">{{ formatAmount(site('min_withdrawal')) }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="text-[#40DDFF]">Maximum Withdrawal:</span></td>
                                            <td><span class="text-white">{{ formatAmount(site('max_withdrawal')) }}</span>
                                            </td>
                                        </tr>
                                    </table>
                                    <p class="text-sm">
                                        <span class="text-[#F9810A]">Warning: </span>
                                        <span class="text-[#D8D8D8]">Ensure your wallet address is valid. Withdrawals to
                                            wrong or invalid wallet address are not reversible.</span>
                                    </p>
                                </div>
                            </div>


                            <div class="w-full">
                                <div class="flex items-center justify-center">
                                    <button type="submit"
                                        class="bg-gradient-to-r from-[#3271E8] to-[#0A4AC5] text-white hover:bg-blue-600 rounded-full px-10 py-4 lg:w-96 w-full hover:text-[#0040BC] hover:bg-gradient-to-r hover:from-[#3F7DF2] hover:via-[#FFFFFF] hover:to-[#09C241] transition delay-100 duration-200 ease-in-out flex items-center justify-center">Pay
                                        Now</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
                <!--new withdrawal modal-->

            </div>

            <!--my withdrawal wallets-->
            <div id="myWithdrawalWallets" class="block mb-10">
                <div class="lg:grid grid-cols-2 gap-10" id="withdrawal-wallets">

                    <div class="block mb-10">
                        <div id="wallets"
                            class="block mb-10  bg-blue-600 bg-opacity-10 border border-opacity-15 border-blue-200 rounded-t-2xl overflow-auto min-h-[60vh] w-full">
                            <table class="w-full">
                                <thead class="text-center">
                                    <th class="p-6 text-left">Wallets/ID</th>
                                    <th class="p-6 text-right"></th>
                                </thead>
                                <tbody>
                                    @forelse ($auto_wallets as $wallet)
                                        <tr class="border-t border-opacity-25 border-blue-200">
                                            <td class="p-6">
                                                <div class="flex items-center gap-4 ">
                                                    <img src="{{ 'https://nowpayments.io' . $wallet->depositCoin->logo_url }}"
                                                        alt="coin" class="w-12 h-12">
                                                    <div class="block">
                                                        <p class="text-xl font-bold">{{ $wallet->depositCoin->name }}
                                                        </p>
                                                        <div class="flex">
                                                            <p id="withdrawal_history_address"
                                                                class="clipboard cursor-pointer text-left text-gray-400 text-sm"
                                                                data-copy="{{ $wallet->wallet_address }}">
                                                                {{ $wallet->wallet_address }}</p>
                                                            <img src="{{ asset('/assets/templates/valent/images/icon/copy_icon.svg') }}"
                                                                alt="icon" class="clipboard"
                                                                data-copy="{{ $wallet->wallet_address }}"
                                                                style="cursor: pointer;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-2 text-right">
                                                <p class="flex gap-2">
                                                    @if ($wallet->whitelisted == 1)
                                                        <span class="text-[#EA0A0E]">No</span>
                                                    @else
                                                        <span class="text-[#00AA39]">Yes</span>
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
                                                <span>Empty Record!</span>
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="block">
                        <div class="flex items-center h-full">
                            <div id="addWalletsAddress"
                                class="block mb-10  bg-blue-600 bg-opacity-10 border border-opacity-15 border-blue-200 rounded-2xl w-full p-6">

                                <div class="flex justify-between items-center lg:mb-10 mb-4">
                                    <h2 class="text-xl font-semibold mb-4 text-white">Add Wallet Address</h2>
                                </div>

                                <!-- Content -->
                                <form action="{{ route('user.auto-wallets.new') }}" method="post" id="addWalletForm"
                                    class="dgen-form" data-action="reload">
                                    @csrf

                                    <div class="w-full mb-5">

                                        <fieldset class="border py-1 px-3 rounded-2xl">
                                            <legend class="px-3 mx-8 text-white"><label for="amount"
                                                    class="text-white text-sm">Coin for withdrawal</label></legend>

                                            <div class="relative ">
                                                <button id="coinForDepositDropdownButton_2"
                                                    class="w-full p-4 bg-transparent text-xl text-white border-0 focus:outline-none flex-1 flex gap-2"
                                                    type="button">
                                                    <div class="flex items-center w-full">
                                                        <img src="" class=" rounded-full mr-2"
                                                            id="selectedCoinImg_2" />
                                                        <span id="selectedCoinText_2">Select Coin</span>
                                                    </div>
                                                    <img src="{{ asset('/assets/templates/valent/images/icon/dropdown_arrow_blue.svg') }}"
                                                        alt="icon">
                                                </button>

                                                <!-- Dropdown Menu -->
                                                <ul id="coinForDepositDropdownMenu_2"
                                                    class="absolute z-10 hidden mt-1 max-h-60 lg:w-60 w-full overflow-auto rounded-md bg-gray-600 bg-opacity-90 shadow-lg right-0">
                                                    @foreach ($coins as $coin)
                                                        @if (!array_key_exists($coin->code, $auto_wallets_array))
                                                            <li class="flex items-center px-4 py-2 text-gray-900 cursor-pointer hover:bg-blue-600"
                                                                data-value="{{ $coin->code }}"
                                                                data-label="{{ $coin->name }}"
                                                                data-target="{{ $coin->code . 2 }}"
                                                                data-currency_code="{{ $coin->code }}"
                                                                data-img="{{ 'https://nowpayments.io' . $coin->logo_url }}">
                                                                <img src="{{ 'https://nowpayments.io' . $coin->logo_url }}"
                                                                    alt="coin" class="h-8 w-8 rounded-full mr-2" />
                                                                <p class="" id="{{ $coin->code . 2 }}">
                                                                    <span class="text-white"
                                                                        style="text-transform: uppercase;">
                                                                        @if ($coin->network)
                                                                            {{ $coin->network }}
                                                                        @endif
                                                                    </span>
                                                                    <span class="text-white">
                                                                        {{ $coin->name }}</span>
                                                                </p>
                                                            </li>
                                                        @endif
                                                    @endforeach

                                                </ul>
                                            </div>

                                            <!-- Hidden Input for selected coin -->
                                            <input type="hidden" value="" name="currency_code"
                                                id="currency_code_2" />
                                        </fieldset>
                                    </div>

                                    <div class="w-full mb-10">
                                        <fieldset class="border py-1 px-3 rounded-2xl">
                                            <legend class="px-3 mx-8 text-white"><label for="amount"
                                                    class="text-white text-sm">Wallet Address</label></legend>
                                            <div class="w-full text-white flex gap-4">
                                                <img src="{{ asset('/assets/templates/valent/images/icon/solar_dollar-broken.svg') }}"
                                                    alt="icon">
                                                <div class="w-full">
                                                    <input type="text" id="wallet_address2" name="wallet_address"
                                                        class="w-full p-4 bg-transparent text-xl text-white border-0 focus:outline-none flex-1"
                                                        placeholder="Wallet address" required>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>


                                    <div class="w-full lg:mb-10 mb-4 lg:px-10 px-4">
                                        <div class="flex gap-4 mb-3">
                                            <p class="text-lg text-white">Important Information</p>
                                        </div>

                                        <div class="w-full px-6 py-4 bg-blue-100 rounded-xl bg-opacity-20 text-sm">
                                            <p class="text-sm">
                                                <span class="text-[#F9810A]">Warning: </span>
                                                <span class="text-[#D8D8D8]">For security reasons, newly added wallet
                                                    address will be on security lock until the address is whitelisted.
                                                    During this period, you wouldn't be able to use them for
                                                    withdrawal.</span>
                                            </p>
                                        </div>
                                    </div>


                                    <div class="w-full">
                                        <div class="flex items-center justify-center">
                                            <button type="submit"
                                                class="border rounded-full px-10 py-4 lg:w-96 w-full flex items-center justify-center">Add
                                                Now</button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!--withdrawal wallet-->
            <div id="myWithdrawalHistory" class="hidden mb-10">
                <div id="withdrawals">
                    <div id="history"
                        class="block mb-10  bg-blue-600 bg-opacity-10 border border-opacity-15 border-blue-200 rounded-t-2xl overflow-auto min-h-[60vh] w-full">
                        <table class="w-full" id="withdrawalTable">
                            <thead class="text-center bg-gray-400 bg-opacity-25">
                                <th class="p-6 text-left">AI Bots/ID</th>
                                <th class="p-6 text-right">Holdings</th>
                                <th class="p-6 text-left">Data</th>
                                <th class="p-6text-left">Time</th>
                                <th class="p-6 text-left gap-2">
                                    <button id="status-dropdown-btn" class="flex gap-3 items-center">Status
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
                                            <path
                                                d="M11.178 19.569a.998.998 0 0 0 1.644 0l9-13A.999.999 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13z">
                                            </path>
                                        </svg>
                                    </button>
                                    <aside id="status-dropdown"
                                        class="hidden absolute right-0 lg:w-[300px] bg-[#2d3039] bg-opacity-90 rounded-xl">
                                        <ul class="py-6 px-10">
                                            <li><a href="" class="text-white text-xl flex gap-2 p-2"> All</a></li>
                                            <li><a href="" class="text-white text-xl flex items-center gap-2 p-2">
                                                    <img src="{{ asset('/assets/templates/valent/images/icon/approved_ok.png') }}"
                                                        alt="success" class="w-7 h-7"> Approved</a></li>
                                            <li><a href="" class="text-white text-xl flex items-center gap-2 p-2">
                                                    <img src="{{ asset('/assets/templates/valent/images/icon/recjected_icon.png') }}"
                                                        alt="success" class="w-7 h-7"> Rejected</a></li>
                                            <li><a href="" class="text-white text-xl flex items-center gap-2 p-2">
                                                    <img src="{{ asset('/assets/templates/valent/images/icon/pending_icon.png') }}"
                                                        alt="success" class="w-7 h-7"> Pending</a></li>
                                        </ul>
                                    </aside>
                                </th>
                            </thead>
                            <tbody>
                                @forelse ($withdrawals as $withdrawal)
                                    <tr class="border-t border-opacity-25 border-blue-200">
                                        <td class="p-6" data-withdrawal_tnx="{{ $withdrawal->ref }}">
                                            <div class="flex items-center gap-4 ">
                                                <img src="{{ 'https://nowpayments.io' . $withdrawal->depositCoin->logo_url }}"
                                                    alt="coin" class="w-12 h-12">
                                                <div class="block">
                                                    <p class="text-xl font-bold">{{ $withdrawal->depositCoin->name }}</p>
                                                    <p class="clipboard cursor-pointer text-gray-400 text-sm"
                                                        data-copy="{{ $withdrawal->wallet_address }}">
                                                        {{ $withdrawal->wallet_address }}</p>
                                                    <p class="clipboard cursor-pointer text-gray-400 text-sm"
                                                        data-copy="{{ $withdrawal->ref }}">
                                                        {{ $withdrawal->ref }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-right p-6">
                                            <p class="font-bold">
                                                {{ formatAmount($withdrawal->amount - $withdrawal->fee) }}</p>
                                            <p class=" text-gray-400 text-sm">
                                                <span>{{ $withdrawal->converted_amount . ' ' . $withdrawal->depositCoin->code }}</span>
                                                <span class="text-xs text-[#EA0A0E]">
                                                    /{{ $withdrawal->depositCoin->network ?? $withdrawal->depositCoin->code }}</span>
                                            </p>
                                        </td>
                                        <td class="text-left p-6">
                                            <p class="text-sm local-time">
                                                {{ date('d-m-y', strtotime($withdrawal->created_at)) }}</p>
                                        </td>
                                        <td class="text-left p-6">
                                            <p class="text-sm local-time">
                                                {{ date('H:i:s', strtotime($withdrawal->created_at)) }}</p>
                                        </td>
                                        <td class="text-left p-6">
                                            <p class="px-4 flex items-center gap-3 text-sm">
                                                @if ($withdrawal->status == 'pending')
                                                    <svg width="19" height="19" viewBox="0 0 19 19"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect x="0.0820312" y="0.322632" width="18" height="18"
                                                            rx="9" fill="#D8D8D8" fill-opacity="0.11"></rect>
                                                        <circle cx="5" cy="5" r="5"
                                                            transform="matrix(-1 0 0 1 14.082 4.32263)" fill="#D8D8D8">
                                                        </circle>
                                                    </svg>
                                                    <span
                                                        class="text-gray-500 uppercase text-xs">{{ $withdrawal->status }}</span>
                                                @elseif ($withdrawal->status == 'approved')
                                                    <svg width="19" height="19" viewBox="0 0 19 19"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M8.65505 1.74993C8.92055 1.48478 9.27577 1.32877 9.65064 1.31266C10.0255 1.29656 10.3928 1.42153 10.6801 1.66293L10.7761 1.75068L12.2011 3.17493H14.2156C14.5939 3.175 14.9582 3.31801 15.2355 3.57531C15.5128 3.8326 15.6827 4.18519 15.7111 4.56243L15.7156 4.67493V6.68943L17.1406 8.11443C17.4059 8.37996 17.5621 8.73533 17.5782 9.11038C17.5943 9.48542 17.4692 9.85288 17.2276 10.1402L17.1398 10.2354L15.7148 11.6604V13.6749C15.7149 14.0534 15.572 14.4179 15.3147 14.6953C15.0574 14.9728 14.7047 15.1428 14.3273 15.1712L14.2156 15.1749H12.2018L10.7768 16.5999C10.5113 16.8653 10.1559 17.0214 9.78085 17.0375C9.40581 17.0536 9.03836 16.9285 8.75105 16.6869L8.6558 16.5999L7.2308 15.1749H5.21555C4.83712 15.175 4.47263 15.0321 4.19514 14.7748C3.91766 14.5175 3.74769 14.1648 3.7193 13.7874L3.71555 13.6749V11.6604L2.29055 10.2354C2.0252 9.9699 1.86905 9.61452 1.85295 9.23948C1.83684 8.86443 1.96194 8.49698 2.20355 8.20968L2.29055 8.11443L3.71555 6.68943V4.67493C3.71562 4.29663 3.85863 3.93232 4.11593 3.65499C4.37323 3.37767 4.72582 3.2078 5.10305 3.17943L5.21555 3.17493H7.23005L8.65505 1.74993Z"
                                                            fill="#08C949" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M12.0238 6.91219L8.84078 10.0952L7.51478 8.76919C7.37405 8.62856 7.18321 8.5496 6.98426 8.54967C6.78531 8.54974 6.59453 8.62884 6.4539 8.76957C6.31327 8.9103 6.2343 9.10113 6.23438 9.30008C6.23445 9.49904 6.31355 9.68981 6.45428 9.83044L8.25728 11.6334C8.33389 11.7101 8.42485 11.7709 8.52497 11.8124C8.62509 11.8539 8.7324 11.8752 8.84078 11.8752C8.94915 11.8752 9.05646 11.8539 9.15658 11.8124C9.2567 11.7709 9.34766 11.7101 9.42428 11.6334L13.0843 7.97269C13.2209 7.83124 13.2965 7.64179 13.2948 7.44514C13.2931 7.2485 13.2142 7.06039 13.0751 6.92133C12.9361 6.78227 12.748 6.7034 12.5513 6.70169C12.3547 6.69998 12.1652 6.77558 12.0238 6.91219Z"
                                                            fill="#F0FCFF" />
                                                    </svg>

                                                    <span
                                                        class="text-green-500 uppercase text-xs">{{ $withdrawal->status }}</span>
                                                @elseif ($withdrawal->status == 'rejected' || $withdrawal->status == 'failed' || $withdrawal->status == 'refunded')
                                                    <svg width="19" height="19" viewBox="0 0 19 19"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M8.65505 1.80913C8.92055 1.54399 9.27577 1.38797 9.65064 1.37187C10.0255 1.35576 10.3928 1.48074 10.6801 1.72213L10.7761 1.80988L12.2011 3.23413H14.2156C14.5939 3.2342 14.9582 3.37721 15.2355 3.63451C15.5128 3.89181 15.6827 4.24439 15.7111 4.62163L15.7156 4.73413V6.74863L17.1406 8.17363C17.4059 8.43916 17.5621 8.79454 17.5782 9.16958C17.5943 9.54463 17.4692 9.91208 17.2276 10.1994L17.1398 10.2946L15.7148 11.7196V13.7341C15.7149 14.1126 15.572 14.4771 15.3147 14.7545C15.0574 15.032 14.7047 15.202 14.3273 15.2304L14.2156 15.2341H12.2018L10.7768 16.6591C10.5113 16.9245 10.1559 17.0806 9.78085 17.0967C9.40581 17.1128 9.03836 16.9877 8.75105 16.7461L8.6558 16.6591L7.2308 15.2341H5.21555C4.83712 15.2343 4.47263 15.0913 4.19514 14.834C3.91766 14.5767 3.74769 14.224 3.7193 13.8466L3.71555 13.7341V11.7196L2.29055 10.2946C2.0252 10.0291 1.86905 9.67373 1.85295 9.29868C1.83684 8.92364 1.96194 8.55618 2.20355 8.26888L2.29055 8.17363L3.71555 6.74863V4.73413C3.71562 4.35583 3.85863 3.99152 4.11593 3.7142C4.37323 3.43687 4.72582 3.267 5.10305 3.23863L5.21555 3.23413H7.23005L8.65505 1.80913Z"
                                                            fill="#EA0A0E" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M12.0238 6.9714L8.84078 10.1544L7.51478 8.8284C7.37405 8.68777 7.18321 8.6088 6.98426 8.60887C6.78531 8.60894 6.59453 8.68804 6.4539 8.82877C6.31327 8.9695 6.2343 9.16034 6.23438 9.35929C6.23445 9.55824 6.31355 9.74902 6.45428 9.88965L8.25728 11.6926C8.33389 11.7693 8.42485 11.8301 8.52497 11.8716C8.62509 11.9131 8.7324 11.9344 8.84078 11.9344C8.94915 11.9344 9.05646 11.9131 9.15658 11.8716C9.2567 11.8301 9.34766 11.7693 9.42428 11.6926L13.0843 8.0319C13.2209 7.89045 13.2965 7.70099 13.2948 7.50435C13.2931 7.3077 13.2142 7.11959 13.0751 6.98053C12.9361 6.84148 12.748 6.7626 12.5513 6.76089C12.3547 6.75918 12.1652 6.83478 12.0238 6.9714Z"
                                                            fill="#F0FCFF" />
                                                    </svg>

                                                    <span
                                                        class="text-red-500 uppercase text-xs">{{ $withdrawal->status }}</span>
                                                @else
                                                    <svg width="19" height="19" viewBox="0 0 19 19"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect x="0.0820312" y="0.322632" width="18" height="18"
                                                            rx="9" fill="#D8D8D8" fill-opacity="0.11"></rect>
                                                        <circle cx="5" cy="5" r="5"
                                                            transform="matrix(-1 0 0 1 14.082 4.32263)" fill="#D8D8D8">
                                                        </circle>
                                                    </svg>
                                                    <span
                                                        class="text-orange-500 uppercase text-xs">{{ $withdrawal->status }}</span>
                                                @endif
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
                                            <span>Empty Record. No withdrawal found!</span>
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                    <div class="cursor-pointer simple-pagination" data-paginator="withdrawals">
                        {{ $withdrawals->links('templates.' . site('template') . '.paginations.simple') }}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // search withdrawal
        $(document).on('input keyup', '#search-withdrawal-input', function(e) {
            var ref = $(this).val();
            var base_link = $('#search-withdrawal-button').data('link');
            var encodedRef = encodeURIComponent(ref);

            // Append the query parameter to the URL
            var link = base_link + '?s=' + encodedRef;
            $('#search-withdrawal-button').attr('href', link);
        });
    </script>


    <script>
        let interval;

        // handle withdrawal form
        $(document).on('submit', '#withdrawalForm', function(e) {
            e.preventDefault();
            var amount = $('#amount').val() * 1;
            var currency_code = $('#currency_code').val();
            var min_withdrawal = "{{ site('min_withdrawal') }}" * 1;
            var max_withdrawal = "{{ site('max_withdrawal') }}" * 1;
            var currency = "{{ site('currency') }}";

            //check the currency code
            var error = null;
            if (!currency_code) {
                error = 'You have not selected a withdrawal method';
            }

            //check min and max withdrawal
            if (amount < min_withdrawal) {
                error = 'Minimum withdrawal amount is ' + currency + min_withdrawal;
            }

            if (amount > max_withdrawal) {
                error = 'Maximum withdrawal amount is ' + currency + max_withdrawal;
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


                        loadPage(window.location.href, submitButton, '#pageContent');

                        $('html, body').animate({
                            scrollTop: 0 + 100
                        }, 800);
                        toastNotify('success', 'withdrawal request initated successfully');

                        submitButton.addClass(
                            'bg-gradient-to-r hover:bg-gradient-to-r hover:bg-blue-600');
                        submitButton.removeClass('not-allowed-cursor');




                    },
                    error: function(xhr, status, error) {

                        if (xhr.status == 422) {
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

                                submitButton.addClass(
                                    'bg-gradient-to-r hover:bg-gradient-to-r hover:bg-blue-600');
                                submitButton.removeClass('not-allowed-cursor');
                            }
                        } else {
                            toastNotify('error', 'Server Error occured, try again later');

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
        /////////////////////--ADD WALLET ADDRESS--///////////////////////////////
        $(document).on('submit', '#addWalletForm', function(e) {
            e.preventDefault();

            var form = $(this);
            var successAction = form.data('action');
            var redirectUrl = form.data('url');
            var formData = new FormData(this);

            var submitButton = form.find('button[type="submit"]');
            submitButton.addClass('relative disabled').prop('disabled', true);
            submitButton.append('<span class="button-spinner"></span>');
            var passwordInputs = form.find('input[type="password"]');

            submitButton.addClass('not-allowed-cursor');

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    var message = response.message;

                    // Clear password fields after success
                    if (successAction !== 'none' && passwordInputs.length > 0) {
                        passwordInputs.val('');
                    }

                    /////////////////// notification
                    toastNotify('success', message);

                    if (successAction === 'reload') {
                        $.ajax({
                            url: window.location.href,
                            method: 'GET',
                            success: function(response) {
                                $('#refresh').html($(response).find('#refresh').html());

                                // Reinitialize func after reload
                                initializeDropdown();
                                initializeTabsSlide();
                            },
                            error: function() {
                                //console.error('Error fetching new content');
                            }
                        });
                    } else if (successAction === 'redirect' && redirectUrl) {
                        window.location.href = redirectUrl;
                    } else if (successAction === 'reset') {
                        form.find('input[type!="hidden"]').val('');
                    }
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON ? xhr.responseJSON.errors : null;
                    var errorMessage = 'An error occurred. Please try again later.';

                    if (errors) {
                        errorMessage = '';
                        $.each(errors, function(field, messages) {
                            $.each(messages, function(index, message) {
                                errorMessage += message + '<br>';
                            });
                        });
                    }

                    /////////////////// notification
                    toastNotify('error', errorMessage);
                },
                complete: function() {
                    submitButton.removeClass('disabled').prop('disabled', false);
                    submitButton.find('.button-spinner').remove();
                    submitButton.removeClass('not-allowed-cursor');
                }
            });
        });

        function initializeDropdown() {

            // Toggle dropdown visibility
            $(document).off('click', '#coinForDepositDropdownButton_2').on('click', '#coinForDepositDropdownButton_2',
                function() {
                    const menu = $('#coinForDepositDropdownMenu_2');
                    if (menu.hasClass('hidden')) {
                        menu.removeClass('hidden').hide().slideDown(200);
                    } else {
                        menu.slideUp(200, function() {
                            $(this).addClass('hidden');
                        });
                    }
                });

            // Close dropdown when clicking outside
            $(document).off('click', 'body').on('click', 'body', function(e) {
                if (!$(e.target).closest('#coinForDepositDropdownButton_2, #coinForDepositDropdownMenu_2').length) {
                    $('#coinForDepositDropdownMenu_2').slideUp(200, function() {
                        $(this).addClass('hidden');
                    });
                }
            });

            // Handle dropdown item selection
            $(document).off('click', '#coinForDepositDropdownMenu_2 li').on('click', '#coinForDepositDropdownMenu_2 li',
                function() {
                    const label = $(this).data('label');
                    const imgSrc = $(this).data('img');
                    const value = $(this).data('value');

                    // Update the button with the selected coin
                    $('#selectedCoinText_2').text(label);
                    $('#selectedCoinImg_2').attr('src', imgSrc).addClass('w-8 h-8');

                    // Update the hidden input value
                    $('#currency_code_2').val(value);

                    // Hide the dropdown menu
                    $('#coinForDepositDropdownMenu_2').slideUp(200, function() {
                        $(this).addClass('hidden');
                    });
                });
        }

        // Run dropdown initialization on page load
        $(document).ready(function() {
            initializeDropdown();
        });

        // Run tab slide initialization on page load
        function initializeTabsSlide() {

            // Toggle modal
            $(document).off("click", "#myWithdrawalWalletsBtn").on("click", "#myWithdrawalWalletsBtn", function() {
                $("#myWithdrawalWallets").slideDown().removeClass('hidden');
                $("#myWithdrawalHistory").slideUp().addClass('hidden');

                $("#filterForm").addClass('hidden').removeClass('block');

                $("#myWithdrawalHistoryBtn").removeClass('border-b-4');
                $("#myWithdrawalWalletsBtn").addClass('border-b-4');
            });

            // Swap between tabs
            $(document).off("click", "#myWithdrawalHistoryBtn").on("click", "#myWithdrawalHistoryBtn", function() {
                $("#myWithdrawalHistory").slideDown().removeClass('hidden');
                $("#myWithdrawalWallets").slideUp().addClass('hidden');

                $("#filterForm").addClass('block').removeClass('hidden');

                $("#myWithdrawalWalletsBtn").removeClass('border-b-4');
                $("#myWithdrawalHistoryBtn").addClass('border-b-4');
            });
        }

        // Run tabs initialization on page load
        $(document).ready(function() {
            initializeTabsSlide();
        });
    </script>


    <script>
        function initializeWithdrawalModals() {
            // console.log("Modals Initialized");

            // Deposit modal toggle
            $(document).off("click", "#openWithdrawalModal").on("click", "#openWithdrawalModal", function() {
                $('#NewWithdrawalModal').removeClass('hidden hide').addClass('show');
            });

            $(document).off("click", "#closeWithdrawalModal").on("click", "#closeWithdrawalModal", function() {
                $('#NewWithdrawalModal').removeClass('show').addClass('hide');
                setTimeout(function() {
                    $('#NewWithdrawalModal').addClass('hidden');
                }, 300);
            });
        }

        // Run modal initialization on page load
        $(document).ready(function() {
            initializeWithdrawalModals();
        });


        //select coin for deposit
        function initializeDepositDropdown() {
            console.log("Dropdown Initialized");

            // Toggle dropdown visibility with animation
            $(document).off("click", "#coinForDepositDropdownButton").on("click", "#coinForDepositDropdownButton",
                function() {
                    const coinForDepositDropdownMenu = $("#coinForDepositDropdownMenu");
                    if (coinForDepositDropdownMenu.hasClass("hidden")) {
                        coinForDepositDropdownMenu
                            .removeClass("hidden")
                            .addClass("scale-100 opacity-100")
                            .hide()
                            .slideDown(200);
                    } else {
                        coinForDepositDropdownMenu
                            .slideUp(200, function() {
                                $(this).addClass("hidden").removeClass("scale-100 opacity-100");
                            });
                    }
                });

            // Close dropdown when clicking outside
            $(document).off("click", "body").on("click", "body", function(e) {
                if (!$(e.target).closest("#coinForDepositDropdownButton, #coinForDepositDropdownMenu").length) {
                    $("#coinForDepositDropdownMenu")
                        .slideUp(200, function() {
                            $(this).addClass("hidden").removeClass("scale-100 opacity-100");
                        });
                }
            });

            // Handle selection
            $(document).off("click", "#coinForDepositDropdownMenu li").on("click", "#coinForDepositDropdownMenu li",
                function() {
                    const label = $(this).data("label");
                    const imgSrc = $(this).data("img");
                    const value = $(this).data("value");

                    // Update the button with the selected coin
                    $("#selectedCoinText").text(label);
                    $("#selectedCoinImg").attr("src", imgSrc).addClass("w-8 h-8");

                    // Update the hidden input value
                    $("#currency_code").val(value);

                    // Hide the dropdown menu
                    $("#coinForDepositDropdownMenu").slideUp(200, function() {
                        $(this).addClass("hidden").removeClass("scale-100 opacity-100");
                    });
                });
        }

        // Run dropdown initialization on page load
        $(document).ready(function() {
            initializeDepositDropdown();
        });
    </script>
@endsection

@extends('templates.' . site('template') . '.layouts.user')
{{-- @extends('templates.'. site('template') .'.layouts.user') --}}

@section('contents')
    <!--my ai bot-->
    <div class="w-full py-6" data-aos="fade-up">
        <div class="lg:max-w-screen-xl mx-auto p-4 mb-3 text-white">

            <div class="block mb-3">
                <h1 class="text-xl lg:text-3xl font-bold">AI Bots</h1>
            </div>

            <div class="lg:flex justify-between items-center mb-5 py-5">
                <div class="mb-3 block p-2">
                    <div class="eflex gap-4 grid lg:grid-cols-3 grid-cols-2">
                        <button id="myAiBotsBtn"
                            class="bg-black text-white px-6 py-2 rounded-xl border-b-4 border-[#0040BC] lg:text-md text-sm">My
                            AI Bots</button>
                        <button id="aiTradingHistoryBtn"
                            class="bg-black text-white px-6 py-2 rounded-xl hover:border-b-4 border-[#0040BC] lg:text-md text-sm">AI
                            Trading History</button>
                        <button id="dailySummaryBtn"
                            class="bg-black text-white px-6 py-2 rounded-xl hover:border-b-4 border-[#0040BC] lg:text-md text-sm">Daily
                            History</button>
                    </div>
                </div>

                <div class="mb-3 block p-2">
                    <button id="openAiBotActivationModal"
                        class="border rounded-full lg:px-10 pdx-5 lg:py-4 py-2 px-6 text-lg  bg-gradient-to-r from-[#306FE6] via-[#3b82f6] to-[#0040BC] hover:text-[#0040BC] hover:bg-gradient-to-r hover:from-[#3F7DF2] hover:via-[#FFFFFF] hover:to-[#09C241] transition delay-100 duration-200 ease-in-out">Activate
                        Ai Bot</button>
                </div>

            </div>

            <!--my ai bots table-->
            <div id="myAiBots">
                {{-- <p class="text-white" id="testingDiv">Here</p> --}}

                <div id="bots">
                    <div id=""
                        class="block mb-10  bg-blue-600 bg-opacity-10 border border-opacity-15 border-blue-200 rounded-t-2xl overflow-auto w-full min-h-[60vh]">
                        <table class="lg:w-[100%]" data-bot_count="{{ $activations->total() }}" id="botTable">
                            <thead class="text-left h-14 bg-gray-400 bg-opacity-25">
                                <th class="lg:min-w-96 min-w-[50vw] px-6">My Bots</th>
                                <th class="lg:min-w-52 min-w-[50vw] px-6">Portfolio/DT</th>
                                <th class="lg:min-w-52 min-w-[50vw] px-6">Portfolio Balance</th>
                                <th class="lg:min-w-52 min-w-[50vw] text-right px-6">Count Down</th>
                            </thead>
                            <tbody>
                                @forelse ($activations as $bot)
                                    <tr class="border-b border-opacity-25 border-blue-200">
                                        <td class="py-2 lg:w-96 w-64 px-6">
                                            <div class="flex items-center gap-4 ">
                                                <img src="{{ asset('storage/bots/' . $bot->bot->logo) }}"
                                                    class="w-14 h-14 rounded-full" alt="bot">
                                                <div class="block">
                                                    <p class="flex gap-2">
                                                        {{ $bot->bot->name }}
                                                        @if ($bot->status == 'active')
                                                            <svg width="24" height="25" viewBox="0 0 24 25"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M10.6319 1.64199C10.9859 1.28847 11.4595 1.08045 11.9593 1.05897C12.4591 1.0375 12.9489 1.20413 13.3319 1.52599L13.4599 1.64299L15.3599 3.54199H18.0459C18.5503 3.54209 19.036 3.73277 19.4058 4.07583C19.7756 4.4189 20.002 4.88901 20.0399 5.39199L20.0459 5.54199V8.22799L21.9459 10.128C22.2997 10.482 22.5079 10.9559 22.5293 11.4559C22.5508 11.956 22.384 12.4459 22.0619 12.829L21.9449 12.956L20.0449 14.856V17.542C20.045 18.0466 19.8545 18.5326 19.5114 18.9025C19.1683 19.2725 18.698 19.4992 18.1949 19.537L18.0459 19.542H15.3609L13.4609 21.442C13.1068 21.7958 12.633 22.004 12.1329 22.0255C11.6329 22.0469 11.1429 21.8801 10.7599 21.558L10.6329 21.442L8.73287 19.542H6.04587C5.54129 19.5422 5.0553 19.3516 4.68532 19.0085C4.31534 18.6654 4.08871 18.1951 4.05087 17.692L4.04587 17.542V14.856L2.14587 12.956C1.79206 12.602 1.58387 12.1281 1.56239 11.6281C1.54091 11.128 1.70772 10.6381 2.02987 10.255L2.14587 10.128L4.04587 8.22799V5.54199C4.04596 5.03759 4.23664 4.55185 4.57971 4.18208C4.92277 3.81231 5.39289 3.58582 5.89587 3.54799L6.04587 3.54199H8.73187L10.6319 1.64199Z"
                                                                    fill="#00AA39" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M15.1255 8.52497L10.8815 12.769L9.11345 11.001C8.92581 10.8135 8.67137 10.7082 8.4061 10.7083C8.14083 10.7084 7.88646 10.8138 7.69895 11.0015C7.51144 11.1891 7.40616 11.4436 7.40625 11.7088C7.40634 11.9741 7.51181 12.2285 7.69945 12.416L10.1035 14.82C10.2056 14.9222 10.3269 15.0032 10.4604 15.0586C10.5939 15.1139 10.737 15.1423 10.8815 15.1423C11.0259 15.1423 11.169 15.1139 11.3025 15.0586C11.436 15.0032 11.5573 14.9222 11.6595 14.82L16.5395 9.93897C16.7216 9.75037 16.8224 9.49777 16.8201 9.23557C16.8178 8.97338 16.7127 8.72256 16.5273 8.53716C16.3419 8.35175 16.0911 8.24658 15.8289 8.2443C15.5667 8.24202 15.3141 8.34282 15.1255 8.52497Z"
                                                                    fill="#F0FCFF" />
                                                            </svg>
                                                        @else
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                                fill="#6b7280" class="bi bi-patch-exclamation-fill"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                            </svg>
                                                        @endif
                                                    </p>
                                                    <p class="flex gap-2">
                                                        <span class="text-[#EA0A0E]">PNL</span>
                                                        @if ($bot->profit < 0)
                                                            <span
                                                                class="text-[#EA0A0E] flex space-x-1"><span>{{ ($bot->profit / $bot->capital) * 100 }}%</span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                    fill="currentColor" class="w-6 h-6">
                                                                    <path fill-rule="evenodd"
                                                                        d="M1.72 5.47a.75.75 0 011.06 0L9 11.69l3.756-3.756a.75.75 0 01.985-.066 12.698 12.698 0 014.575 6.832l.308 1.149 2.277-3.943a.75.75 0 111.299.75l-3.182 5.51a.75.75 0 01-1.025.275l-5.511-3.181a.75.75 0 01.75-1.3l3.943 2.277-.308-1.149a11.194 11.194 0 00-3.528-5.617l-3.809 3.81a.75.75 0 01-1.06 0L1.72 6.53a.75.75 0 010-1.061z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            </span>
                                                        @else
                                                            <span
                                                                class="text-[#00AA39] flex space-x-1"><span>+{{ ($bot->profit / $bot->capital) * 100 }}%</span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                    fill="currentColor" class="w-6 h-6">
                                                                    <path fill-rule="evenodd"
                                                                        d="M15.22 6.268a.75.75 0 01.968-.432l5.942 2.28a.75.75 0 01.431.97l-2.28 5.941a.75.75 0 11-1.4-.537l1.63-4.251-1.086.483a11.2 11.2 0 00-5.45 5.174.75.75 0 01-1.199.19L9 12.31l-6.22 6.22a.75.75 0 11-1.06-1.06l6.75-6.75a.75.75 0 011.06 0l3.606 3.605a12.694 12.694 0 015.68-4.973l1.086-.484-4.251-1.631a.75.75 0 01-.432-.97z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            </span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-2 lg:w-96 w-64 px-6">
                                            <p>
                                                <span>{{ formatAmount($bot->capital) }}</span>
                                            </p>
                                            <p class="text-sm text-[#FC8B09]">Activation Date/Time</p>
                                            <p class="text-sm">
                                                <span
                                                    class="local-time">{{ date('d-m-y H:i:s', strtotime($bot->created_at)) }}</span>
                                            </p>
                                        </td>

                                        <td class="py-2 lg:w-96 w-64 px-6">
                                            <p>
                                                <span>{{ formatAmount($bot->balance) }}</span>
                                            </p>
                                        </td>

                                        <td class="py-2 text-right lg:w-96 w-64  px-6">
                                            <span
                                                class="rounded-lg bg-gray-400 bg-opacity-15 w-auto p-2  @if ($bot->expires_in < time()) text-[#EA0A0E] @else text-[#309AFF] @endif ">
                                                <a role="button" class="cursor-pointer"
                                                    id="{{ 'bot_timer_' . $loop->iteration }}">time
                                                </a>
                                            </span>
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
                                            <span>You have not activated any bot</span>
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                    <div class="cursor-pointer simple-pagination" data-paginator="bots">
                        {{ $activations->links('templates.' . site('template') . '.paginations.simple') }}
                    </div>
                </div>
            </div>

            <!--ai trading history-->
            <div id="aiTradingHistory" class="hidden mb-10 w-full lg:px-6">

                <div id="bot-history">
                    <!--Al Trading View chart-->
                    <div class="w-full py-6" data-aos="fade-up">
                        <div class="max-w-screen-xl mx-auto mb-3 text-white">
                            <h1 class="text-xl lg:text-3xl font-bold mb-6">AI Trading Overview (30 Day PNL)</h1>
                            <div class="bg-cover bg-no-repeat bg-center"
                                style="background-image: url({{ asset('/assets/templates/valent/images/chart-bg.png') }});">
                                <canvas id="canvas" class="w-full"></canvas>
                            </div>
                        </div>
                    </div>
                    <!--end ai tradeing view chart-->

                    <div id="bot-history-grid">
                        <div data-aos="zoom-in" id=""
                            class="block mb-10  bg-blue-600 bg-opacity-10 border border-opacity-15 border-blue-200 rounded-2xl overflow-auto w-full min-h-[60vh]">
                            <table class="w-full">
                                <thead class="text-center bg-gray-400 bg-opacity-25">
                                    <th class="p-6 text-left lg:min-w-52 min-w-[50vw]">AI Bots</th>
                                    <th class="p-6 text-right lg:min-w-52 min-w-[50vw]">PNL</th>
                                    <th class="p-6 text-left lg:min-w-40 min-w-[50vw]">Entry Price</th>
                                    <th class="p-6 text-left lg:min-w-40 min-w-[50vw]">Exiting Price</th>
                                    <th class="p-6 text-left lg:min-w-40 min-w-[50vw]">Trading Pair</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @forelse ($histories as $history)
                                        <tr class="border-t border-opacity-25 border-blue-200">
                                            <td class="p-6">
                                                <div class="flex items-center gap-4 ">
                                                    <img src="{{ asset('storage/bots/' . $history->botActivation->bot->logo) }}"
                                                        alt="bot" class="w-12 h-14 rounded-full">
                                                    <div class="block">
                                                        <p class="font-bold">{{ $history->botActivation->bot->name }}</p>
                                                        <p class=" text-gray-200 text-sm">
                                                            <span>{{ date('d-m-y', $history->timestamp) }}</span> /
                                                            <span>{{ date('H:i:s', $history->timestamp) }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-right p-6">

                                                @if ($history->profit < 0)
                                                    <p class="text-[#D91414]">
                                                        -{{ formatAmount(str_replace('-', '', $history->profit)) }}</ </p>
                                                    @else
                                                    <p class="text-[#00AA39]">
                                                        +{{ formatAmount($history->profit) }}
                                                    </p>
                                                @endif
                                                <div class="flex gap-4 justify-end">
                                                    @if ($history->profit < 0)
                                                        <p class="flex justify-end items-center text-[#D91414]">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                fill="currentColor" class="w-6 h-6">
                                                                <path fill-rule="evenodd"
                                                                    d="M1.72 5.47a.75.75 0 011.06 0L9 11.69l3.756-3.756a.75.75 0 01.985-.066 12.698 12.698 0 014.575 6.832l.308 1.149 2.277-3.943a.75.75 0 111.299.75l-3.182 5.51a.75.75 0 01-1.025.275l-5.511-3.181a.75.75 0 01.75-1.3l3.943 2.277-.308-1.149a11.194 11.194 0 00-3.528-5.617l-3.809 3.81a.75.75 0 01-1.06 0L1.72 6.53a.75.75 0 010-1.061z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        </p>
                                                        <p class="flex justify-end items-center text-[#D91414]">
                                                            {{ number_format((($history->exit_price - $history->entry_price) / $history->entry_price) * 100, 2) }}%
                                                        </p>
                                                    @else
                                                        <p class="flex justify-end items-center text-[#00AA39]">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                fill="currentColor" class="w-6 h-6">
                                                                <path fill-rule="evenodd"
                                                                    d="M15.22 6.268a.75.75 0 01.968-.432l5.942 2.28a.75.75 0 01.431.97l-2.28 5.941a.75.75 0 11-1.4-.537l1.63-4.251-1.086.483a11.2 11.2 0 00-5.45 5.174.75.75 0 01-1.199.19L9 12.31l-6.22 6.22a.75.75 0 11-1.06-1.06l6.75-6.75a.75.75 0 011.06 0l3.606 3.605a12.694 12.694 0 015.68-4.973l1.086-.484-4.251-1.631a.75.75 0 01-.432-.97z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        </p>
                                                        <p class="flex justify-end items-center text-[#00AA39]">
                                                            +{{ number_format((($history->exit_price - $history->entry_price) / $history->entry_price) * 100, 2) }}%
                                                        </p>
                                                    @endif

                                                </div>
                                            </td>
                                            <td class="text-left p-6">
                                                <p>{{ $history->entry_price }}</p>
                                            </td>
                                            <td class="text-left p-6">
                                                <p>{{ $history->exit_price }}</p>
                                            </td>
                                            <td class="text-left p-6">
                                                <p class="px-3">{{ $history->pair }}</p>
                                            </td>
                                            <td class="text-left p-6">
                                                <div x-on:click="openDepositDetail = true" id="openDepositViewModal"
                                                    class="flex gap-2 rounded-full lg:w-32 w-36 bg-gray-500 bg-opacity-40 py-2 px-4"
                                                    style="cursor: pointer;">
                                                    <img src="{{ asset('/assets/templates/valent/images/icon/eye_blue.svg') }}"
                                                        alt="icon" class="w-4 h-5">
                                                    <span
                                                        class="view-chart cursor-pointer flex items-center text-sm text-[#309AFF]"
                                                        data-pair="{{ $history->pair }}">View Chart</span>
                                                </div>
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
                                                <span>You have not activated any bot</span>
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>


                        <div class="cursor-pointer simple-pagination" data-paginator="bot-history-grid">
                            {{ $histories->links('templates.' . site('template') . '.paginations.simple') }}
                        </div>
                    </div>

                </div>
            </div>

            <!--daily summary-->
            <div id="dailySummary"
                class="hidden mb-10  bg-blue-600 bg-opacity-10 border border-opacity-15 border-blue-200 rounded-t-2xl overflow-auto w-full min-h-[60vh]">
                <div id="daily_summary">
                    <table class="lg:w-[100%]">
                        <thead class="text-left  h-14 bg-gray-400 bg-opacity-25">
                            <th class="lg:min-w-96 min-w-[50vw] px-6">Date/Time</th>
                            <th class="lg:min-w-96 min-w-[30vw] px-6">Amount</th>
                            <th class="lg:min-w-96 min-w-[30vw] px-6 text-right">PNL</th>
                        </thead>
                        <tbody>
                            @foreach ($daily_data as $date => $summary)
                                @if ($summary['profit'] != 0)
                                    <tr class="border-b border-opacity-25 border-blue-200 mb-4">
                                        <td class="py-4 lg:w-96 w-64 px-6">
                                            <p>{{ $date }}</p>
                                        </td>
                                        <td class="py-2 lg:w-96 w-64 px-6">
                                            <p>
                                                @if ($summary['profit'] < 0)
                                                    <span class="text-[#EA0A0E]">
                                                        -{{ formatAmount(str_replace('-', '', $summary['profit'])) }}
                                                    </span>
                                                @else
                                                    <span class="text-[#00AA39]">
                                                        <span>+{{ formatAmount($summary['profit']) }}</span>
                                                    </span>
                                                @endif
                                            </p>
                                        </td>
                                        <td class="pb-6 pt-10 text-right lg:w-96 w-64 px-6">
                                            @if ($summary['profit'] < 0)
                                                <div class="flex justify-end items-center gap-2 text-[#EA0A0E]">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="w-6 h-6">
                                                        <path fill-rule="evenodd"
                                                            d="M1.72 5.47a.75.75 0 011.06 0L9 11.69l3.756-3.756a.75.75 0 01.985-.066 12.698 12.698 0 014.575 6.832l.308 1.149 2.277-3.943a.75.75 0 111.299.75l-3.182 5.51a.75.75 0 01-1.025.275l-5.511-3.181a.75.75 0 01.75-1.3l3.943 2.277-.308-1.149a11.194 11.194 0 00-3.528-5.617l-3.809 3.81a.75.75 0 01-1.06 0L1.72 6.53a.75.75 0 010-1.061z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span>{{ number_format($summary['profit_percent'], 2) }}%</span>
                                                </div>
                                            @else
                                                <div class="flex justify-end items-center gap-2 text-[#00AA39]">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="w-6 h-6">
                                                        <path fill-rule="evenodd"
                                                            d="M15.22 6.268a.75.75 0 01.968-.432l5.942 2.28a.75.75 0 01.431.97l-2.28 5.941a.75.75 0 11-1.4-.537l1.63-4.251-1.086.483a11.2 11.2 0 00-5.45 5.174.75.75 0 01-1.199.19L9 12.31l-6.22 6.22a.75.75 0 11-1.06-1.06l6.75-6.75a.75.75 0 011.06 0l3.606 3.605a12.694 12.694 0 015.68-4.973l1.086-.484-4.251-1.631a.75.75 0 01-.432-.97z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span>+{{ number_format($summary['profit_percent'], 2) }}%</span>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--end my ai bot-->


    {{-- Ai Bot Activation Modal --}}
    <div id="aiBotActivationModal" class="fixed inset-0 bg-opacity-50 flex items-center justify-end lg:px-6 px-2 hidden">

        <!--ai bot activate-->
        <div
            class="bg-gradient-to-r from-[#0038A5] to-[#022058] rounded-lg lg:w-3/5 w-full lg:h-auto h-[80vh] lg:p-10 p-4 relative mt-20 lg:mr-20">

            <div class="flex justify-between items-center lg:mb-10 mb-4">
                <h2 class="text-xl font-semibold mb-4 text-white">Ai Bot Activation</h2>
                <button id="closeAiBotActivationModal" class="text-gray-400 hover:text-gray-600">
                    <img src="{{ asset('/assets/templates/valent/images/icon/close_icon.svg') }}" alt="icon">
                </button>
            </div>

            <!-- Modal Content -->
            <div class="w-full  overflow-y-auto overflow-auto h-[65vh]">
                <table class="w-full">
                    @forelse ($bots as $bot)
                        <tr data-target="{{ $bot->code }}"
                            class="border-b border-opacity-15 border-blue-200 text-white">
                            <td class="flex gap-4 p-3 lg:w-56 w-64">
                                <img src="{{ asset('storage/bots/' . $bot->logo) }}" alt="icon"
                                    class="h-12 w-12 rounded-full">
                                <div>
                                    <p class="text-lg font-bold">{{ $bot->name }}</p>
                                    <p class="text-sm">{{ $bot->duration . $bot->duration_type }} trading period
                                    </p>
                                </div>
                            </td>
                            <td class="w-56">
                                <p class="text-sm">
                                    {{ formatAmount($bot->min) . ' - ' . formatAmount($bot->max) }}</p>
                            </td>
                            <td class="w-36">
                                <p class="text-sm">{{ $bot->daily_min . '% - ' . $bot->daily_max . '%' }}</p>
                            </td>
                            <td class="w-32">
                                <a role="button" data-bot_id="{{ $bot->id }}" data-bot_name="{{ $bot->name }}"
                                    data-bot_min="{{ formatAmount($bot->min) }}"
                                    data-bot_max="{{ formatAmount($bot->max) }}"
                                    class="bot bg-blue-50 rounded-full p-2 bg-opacity-15 text-sm">Activate</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td
                                class="w-full flex justify-center items-center ts-gray-3 p-2 rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500"
                                    fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>
                                <span>Bots coming soon ...</span>
                            </td>
                        </tr>
                    @endforelse

                </table>
            </div>

        </div>

        <!--new deposit modal-->


    </div>

    <div class="w-full">
        <div class="fixed inset-0  bg-opacity-50 flex items-center justify-end lg:px-6 px-2 hidden text-white"
            id="aiBotActivateModal">
            <div id="modalDisplay">

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        //toggle for ai activation modal
        $(document).ready(function() {
            $('#openAiBotActivationModal').click(function() {
                $('#aiBotActivationModal').removeClass('hidden')
            });

            $('#aiBotActivationModal').on('click', '#closeAiBotActivationModal', function() {
                // You can add code to hide the modal here.
                $('#aiBotActivationModal').addClass('hidden');
            });

            $('#aiBotActiveModal').on('click', '#closeAiBotActiveModal', function() {
                // You can add code to hide the modal here.
                $('#aiBotActiveModal').addClass('hidden');
            });

            /////////////
            $('#aiBotActivateModal').on('click', '#closeAiBotActivateModal', function() {
                // You can add code to hide the modal here.
                $('#aiBotActivateModal').addClass('hidden');
            });
        });
    </script>

    <script>
        ////////////////////// trading view chart
        var lineChartData = {
            labels: [], // This will be populated dynamically with date ranges
            datasets: [{
                label: "Profit",
                data: @json($profits).reverse(), // Random data for past 30 days (24 hours per day)
                pointBackgroundColor: "rgba(16,133,135,1)",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(16,133,135,1)",
                tension: 0.4,
                fill: true,
            }],
        };

        // Generate day ranges for the past 30 days
        function generateDayLabels(days) {
            let labels = [];
            let now = new Date();

            for (let i = days - 1; i >= 0; i--) {
                let currentDate = new Date(now.getTime() - i * 24 * 60 * 60 * 1000); // Subtract i days from now

                // Format start and end days (the same for each day in this case)
                let startDay = String(currentDate.getDate()).padStart(2, "0");
                let endDay = String(currentDate.getDate()).padStart(2, "0");

                // Combine into (DD-DD)
                //labels.push(`(${startDay}-${endDay})`);
                labels.push(`${startDay}-${endDay}`);
            }
            return labels;
        }

        // Populate the labels with corresponding date ranges for the past 30 days
        lineChartData.labels = generateDayLabels(30); // 30 days

        // Ensure the DOM is fully loaded before executing the script
        window.addEventListener("load", function() {
            var canvas = document.getElementById("canvas");
            if (!canvas) {
                console.error("Canvas element not found!");
                return;
            }

            var ctx = canvas.getContext("2d");

            // Create a gradient for the first line (Profit)
            var gradientProfit = ctx.createLinearGradient(0, 0, canvas.width, 0); // Horizontal gradient
            gradientProfit.addColorStop(0, "rgba(16,133,135,1)");
            gradientProfit.addColorStop(1, "rgba(255,100,50,1)");

            // Assign the gradients to the datasets' borderColors
            lineChartData.datasets[0].borderColor = gradientProfit;

            // Create the chart
            new Chart(ctx, {
                type: "line",
                data: lineChartData,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1000, // Interval between steps
                                color: "#1ED6FF",
                            },
                        },
                        x: {
                            ticks: {
                                color: "#1ED6FF",
                                maxRotation: 90,
                                minRotation: 45,
                            },
                        },
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: "top",
                        },
                    },
                },
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#myAiBotsBtn").on("click", function() {
                $("#myAiBots").slideDown().removeClass('hidden');
                $("#aiTradingHistory, #dailySummary").slideUp().addClass('hidden');

                $("#aiTradingHistoryBtn, #dailySummaryBtn").removeClass('border-b-4');
                $("#myAiBotsBtn").addClass('border-b-4');
            });

            $("#aiTradingHistoryBtn").on("click", function() {
                $("#aiTradingHistory").slideDown().removeClass('hidden');
                $("#myAiBots, #dailySummary").slideUp().addClass('hidden');

                $("#myAiBotsBtn, #dailySummaryBtn").removeClass('border-b-4');
                $("#aiTradingHistoryBtn").addClass('border-b-4');
            });

            $("#dailySummaryBtn").on("click", function() {
                $("#dailySummary").slideDown().removeClass('hidden');
                $("#myAiBots, #aiTradingHistory").slideUp().addClass('hidden');

                $("#aiTradingHistoryBtn, #myAiBotsBtn").removeClass('border-b-4');
                $("#dailySummaryBtn").addClass('border-b-4');
            });
        });
    </script>

    @foreach ($activations as $item)
        <script>
            $(document).ready(function() {
                var target = "{{ 'bot_timer_' . $loop->iteration }}";
                var expires_in = {{ $item->expires_in }};

                // Get the current time in milliseconds
                var currentTime = new Date().getTime();

                // Calculate the remaining time in milliseconds
                var remainingTime = expires_in * 1000 - currentTime;

                // Calculate days, hours, minutes, and seconds
                var days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
                var hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

                // Display the countdown
                var countdownElement = document.getElementById(target);
                countdownElement.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s";

                // Update the countdown every second
                var countdownInterval = setInterval(function() {
                    if (remainingTime > 0) {
                        remainingTime -= 1000;

                        days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
                        hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
                        seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

                        countdownElement.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds +
                            "s";
                    } else {
                        clearInterval(countdownInterval);
                        countdownElement.innerHTML = "Expired";
                    }
                }, 1000);
            });
        </script>
    @endforeach

    <script>
        let interval;


        // select the bot bot
        $(document).on('click', ".bot", function(e) {


            var bot_id = $(this).data('bot_id');
            var bot_name = $(this).data('bot_name');

            var bot_min = $(this).data('bot_min');
            var bot_max = $(this).data('bot_max');

            $('#aiBotActivationModal').addClass('hidden');

            var modalContent = `
            <div class="bg-gradient-to-r from-[#0038A5] to-[#022058] rounded-lg w-full p-10  relative mt-20 lg:mr-20">

                    <div class="flex justify-between items-center lg:mb-10 mb-4">
                        <h2 class="text-xl font-semibold mb-4 text-white">Activate Bot</h2>
                        <button id="closeAiBotActivateModal" class="text-gray-400 hover:text-gray-600">
                            <img src="{{ asset('/assets/templates/valent/images/icon/close_icon.svg') }}" alt="icon">
                        </button>
                    </div>

                    <!-- Modal Content -->
                    <form action="{{ route('user.bots.new') }}" method="post" id="botForm">
                        @csrf
                        <input type="hidden" name="bot_id" id="bot_id">

                        <p class="mb-3">You have chosen to activate <span class="text-white"
                                id="dispay_bot_name"></span> Ai bot</p>
                        
                        <p class="mb-3 text-[#EA0A0E] text-xs" id="errorMessage"></p>

                        <div class="w-full mb-10">
                            <fieldset class="border py-1 px-3 rounded-2xl">
                                <legend class="px-3 mx-8 text-white"><label for="amount"
                                        class="text-white text-sm">Capital {{ site('currency') }}</label></legend>
                                <div class="w-full text-white flex gap-4">
                                    <img src="{{ asset('/assets/templates/valent/images/icon/solar_dollar-broken.svg') }}"
                                        alt="icon">
                                    <div class="w-full">
                                        <input type="number" placeholder="Capital ({{ site('currency') }})"
                                            id="capital"
                                            class="w-full p-4 bg-transparent text-xl text-white border-0 focus:outline-none flex-1"
                                            name="capital" value="0" required>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="w-full mb-10 lg:px-10 px-4">
                            <div class="flex gap-4 mb-3">
                                <p class="text-lg text-white">Note</p>
                                <img src="{{ asset('/assets/templates/valent/images/icon/caution_yellow.svg') }}"
                                    alt="icon">
                            </div>

                            <div class="w-full px-6 py-4 bg-blue-100 rounded-xl bg-opacity-20 text-sm">
                                <table class="mb-3">
                                    <tr>
                                        <td><span class="text-[#40DDFF]">Minimum Capital:</span></td>
                                        <td><span class="text-white px-10" id="dispay_bot_min"></span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-[#40DDFF]">Maximum Capital:</span></td>
                                        <td><span class="text-white px-10" id="dispay_bot_max"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>


                        <div class="w-full">
                            <div class="flex items-center justify-center">
                                <button type="submit" id="activateButton"
                                    class="bg-gradient-to-r from-[#3271E8] to-[#0A4AC5] text-white hover:bg-blue-600 rounded-full px-10 py-4 lg:w-96 w-full hover:text-[#0040BC] hover:bg-gradient-to-r hover:from-[#3F7DF2] hover:via-[#FFFFFF] hover:to-[#09C241] transition delay-100 duration-200 ease-in-out flex items-center justify-center">Activate</button>
                            </div>
                        </div>

                    </form>

                </div>
                `;



            $('#aiBotActivateModal').removeClass("hidden");
            $('#modalDisplay').html(modalContent);

            $('#dispay_bot_name').html(bot_name);
            $("#bot_id").val(bot_id);

            /////////my update
            $('#dispay_bot_min').html(bot_min);
            $('#dispay_bot_max').html(bot_max);

        });

        // handle bot form
        $(document).on('submit', '#botForm', function(e) {
            e.preventDefault();

            var form = $(this);
            var formData = new FormData(this);

            var submitButton = $(this).find('button[type="submit"]');
            submitButton.addClass('relative disabled bg-gray-500');
            submitButton.append('<span class="button-spinner"></span>');
            submitButton.prop('disabled', true);

            // new modification
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
                    var link = window.location.href;
                    var targetDiv = '#bots';
                    $.ajax({
                        url: link,
                        method: 'GET',
                        success: function(response) {
                            $(targetDiv).html($(response).find(targetDiv).html());

                            var scrollTo = $(targetDiv).offset().top - 100;
                            $('.rescron-card').addClass('hidden');
                            $(targetDiv).removeClass('hidden');
                            $('html, body').animate({
                                scrollTop: scrollTo
                            }, 800);
                        }
                    });
                    toastNotify('success', 'Bot activated successfully');

                    // new modification
                    submitButton.addClass('bg-gradient-to-r hover:bg-gradient-to-r hover:bg-blue-600');
                    submitButton.removeClass('not-allowed-cursor');

                    // var totalBotCount = {{ site('pagination') }};
                    // var targetTimersToUpdate = [];
                    // var i = 1;

                    // // Populate the targetTimersToUpdate array with bot timer IDs
                    // while (i <= totalBotCount) {
                    //     var bot_timer_id = "bot_timer_" + i;
                    //     targetTimersToUpdate.push(bot_timer_id);
                    //     i++;
                    // }

                    // // Loop through each target timer and apply the countdown logic
                    // targetTimersToUpdate.forEach(function(bot_timer_id) {
                    //     var target = bot_timer_id;

                    //     // Assuming you get the expiration time dynamically
                    //     var expires_in = parseInt(1740488192);

                    //     // Get the current time in milliseconds
                    //     var currentTime = new Date().getTime();

                    //     // Calculate the remaining time in milliseconds
                    //     var remainingTime = expires_in * 1000 - currentTime;

                    //     // Calculate days, hours, minutes, and seconds
                    //     var days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
                    //     var hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 *
                    //         60 * 60));
                    //     var minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 *
                    //         60));
                    //     var seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

                    //     // Get the countdown element
                    //     var countdownElement = document.querySelector(`#${target}`);
                    //     var replace  = days + "d " + hours + "h " + minutes +
                    //     "m " + seconds + "s";

                    //     $("#testingDiv").text(replace);
                    //     $('#' + target).text(replace);
                    //     // console.log(replace);
                    //     console.log($('#' + target).text());
                    //     $('#' + target).hide();

                    //     // Initial countdown display
                    //     // countdownElement.innerHTML = replace;

                    //     // // Update the countdown every second
                    //     // var countdownInterval = setInterval(function() {
                    //     //     if (remainingTime > 0) {
                    //     //         remainingTime -= 1000;

                    //     //         days = Math.floor(remainingTime / (1000 * 60 * 60 *
                    //     //         24));
                    //     //         hours = Math.floor((remainingTime % (1000 * 60 * 60 *
                    //     //             24)) / (1000 * 60 * 60));
                    //     //         minutes = Math.floor((remainingTime % (1000 * 60 *
                    //     //             60)) / (1000 * 60));
                    //     //         seconds = Math.floor((remainingTime % (1000 * 60)) /
                    //     //             1000);

                    //     //         countdownElement.innerHTML = days + "d " + hours +
                    //     //             "h " + minutes + "m " + seconds + "s";
                    //     //     } else {
                    //     //         clearInterval(countdownInterval);
                    //     //         countdownElement.innerHTML = "Expired";
                    //     //     }
                    //     // }, 1000);

                    //     //console.log('executed');
                    // });

                    $('#aiBotActivateModal').addClass('hidden');
                },

                error: function(xhr, status, error) {
                    var errors = xhr.responseJSON.errors;

                    if (errors) {
                        $.each(errors, function(field, messages) {
                            var fieldErrors = '';
                            $.each(messages, function(index, message) {
                                fieldErrors += message + '<br>';
                            });
                            $('#errorMessage').html(fieldErrors);
                        });
                    } else {
                        $('#errorMessage').html('error', 'An Error occured, try again later');
                    }


                },
                complete: function() {
                    submitButton.removeClass('disabled');
                    submitButton.find('.button-spinner').remove();
                    submitButton.prop('disabled', false);

                }
            });

        });
    </script>

    {{-- view trading history chart --}}
    <script src="https://s3.tradingview.com/tv.js"></script>
    <script>
        $(document).on('click', '.view-chart', function(e) {
            var pair = $(this).data('pair'); // BTCUSDT

            //fetch trading view chart for the pair
            Swal.fire({
                html: `
                        <div class="mt-5 sm:overflow-x-scroll">
                            <div id="chart-container"></div>
                        </div>
                        `,
                toast: false,
                background: 'rgb(7, 3, 12, 0)',
                showConfirmButton: false,
                showCloseButton: true,
                position: 'top-left',
                allowEscapeKey: false, // Prevent closing by escape key
                allowOutsideClick: false, // Prevent closing by clicking backdrop
                willClose: () => {
                    //delete the previously generated qrcode
                    // $('#single_wallet_qrcode').html('');
                }
            });

            new TradingView.widget({
                // Define the container element for the widget
                container_id: 'chart-container', // Replace 'chart-container' with your actual container ID

                // Specify the symbol (pair) you want to display
                symbol: pair,

                // Specify the interval for the chart (e.g., '1D' for 1 day)
                interval: '1D',

                // Choose the style of the chart (e.g., 'Line' or 'Candles')
                style: 'Candles',

                // Specify the timezone for the chart
                timezone: 'Etc/UTC',
                theme: 'Dark'

            });

        });
    </script>
@endsection

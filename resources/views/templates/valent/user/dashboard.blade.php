@php
    use Illuminate\Support\Facades\DB;
    use App\Models\DepositCoin;
    use Illuminate\Support\Facades\Cache;

    function getCurrencyByCoin($id)
    {
        // Try to retrieve the coins from the cache
        $coins = Cache::get('coins');

        // If coins are not in the cache, retrieve them from the database and cache them
        if (!$coins) {
            $coins = DepositCoin::all();
            Cache::forever('coins', $coins);
        }

        // Find and return the coin by ID
        $coin = $coins->find($id);
        return $coin;
    }

    $startDate = now()->subDays(6);
    $endDate = now();

    $deposit_data = user()
        ->deposits()
        ->selectRaw('DATE(created_at) as date, SUM(amount) as total_deposit')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    $withdrawal_data = user()
        ->withdrawals()
        ->selectRaw('DATE(created_at) as date, SUM(amount) as total_withdrawal')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    $graph_info = [];
    $days = [];
    $deposit_amount = [];
    $deposits_graph = [];
    $withdrawals_graph = [];

    // Create an associative array with all days within the date range and initial values of 0
    $currentDate = $startDate;
    while ($currentDate <= $endDate) {
        $formatted_date = $currentDate->format('d-m');
        $graph_info[$formatted_date] = ['deposit' => 0, 'withdrawal' => 0];
        $currentDate->addDay();
        array_push($days, $formatted_date);
    }

    // Populate the graph_info array with actual data from $chart_data
    foreach ($deposit_data as $data) {
        $formatted_date = date('d-m', strtotime($data->date));
        // $graph_info[$formatted_date] = [
        //     'deposit' => $data->total_deposit,
        // ];
        $graph_info[$formatted_date]['deposit'] = $data->total_deposit;
    }

    foreach ($withdrawal_data as $data) {
        $formatted_date = date('d-m', strtotime($data->date));
        // $graph_info[$formatted_date] = [
        //     'withdrawal' => $data->total_withdrawal,
        // ];
        $graph_info[$formatted_date]['withdrawal'] = $data->total_withdrawal;
    }

    foreach ($graph_info as $day => $data) {
        array_push($days, $day);
        array_push($deposits_graph, $data['deposit']);
        array_push($withdrawals_graph, $data['withdrawal']);
    }
    $days = array_slice($days, -7);

    //////////////////////////////// merge deposit and wihdrawal
    // Merge both collections and sort by created_at

    $user_id = user()->id;
    $deposits_blade = DB::select("SELECT * FROM deposits WHERE user_id = $user_id ORDER BY id DESC LIMIT 5");
    $withdrawals_blade = DB::select("SELECT * FROM withdrawals WHERE user_id = $user_id ORDER BY id DESC LIMIT 5");

    $deposits_and_withdrawals = collect(array_merge((array) $deposits_blade, (array) $withdrawals_blade));

    // Sort the combined collection by 'created_at' in descending order
    $deposits_and_withdrawals = $deposits_and_withdrawals->sortByDesc('created_at');

    // Now $deposits_and_withdrawals contains a combined collection of deposits and withdrawals ordered by 'created_at'

    // Corrected dd() to dump the correct variables
    //dd($deposits_and_withdrawals, $deposits_blade, $withdrawals_blade);

@endphp



@extends('templates.' . site('template') . '.layouts.user')

@section('contents')
    {{-- WALLET START --}}
    <div class="w-full" data-aos="fade-up">
        <div
            class="grid xl:grid-cols-3 lg:grid-cols-2 grid-cols-1 justify-between gap-x-11 gap-y-4 py-6 text-white flex-wrap ">

            <div class="w-full min-h-[122.6px] mb-3 xl:col-span-1 lg:col-span-1">
                <div class="flex justify-between items-center bg-[#1252CC] border border-[#1252CC] rounded-lg px-10 py-6">
                    <div>
                        <img src="{{ asset('/assets/templates/valent/images/icon/wallet_account.png') }}" alt="pnl"
                            class="w-10">
                    </div>
                    <div class="text-right">
                        <p class="text-xl text-[#ffffff]">Account</p>
                        <p class="text-2xl font-bold">{{ formatAmount(user()->balance) }}</p>


                        <div class="flex justify-between py-4">
                            @if ($percentage_deposit_increase < 0)
                                <img src="{{ asset('/assets/templates/valent/images/icon/wallet_graph_line_white.png') }}"
                                    alt="" class="w-full">
                                <div class="w-full flex justify-between gap-3">
                                    <img src="{{ asset('/assets/templates/valent/images/icon/wallet_combine_shape_white.png') }}"
                                        alt="arrow" class="w-[19px] h-[19px]">
                                    <span class="text-xl text-[#ffffff]">0%</span>
                                </div>
                            @else
                                <img src="{{ asset('/assets/templates/valent/images/icon/wallet_graph_line_white_up.png') }}"
                                    alt="" class="w-full">
                                <div class="w-full flex justify-between gap-3">
                                    <img src="{{ asset('/assets/templates/valent/images/icon/wallet_combine_shape_white_up.png') }}"
                                        alt="arrow" class="w-[19px] h-[19px]">
                                    <span
                                        class="text-xl text-[#ffffff]">+{{ number_format($percentage_deposit_increase, 2) }}%</span>
                                </div>
                            @endif
                        </div>


                    </div>
                </div>
            </div>

            <div class="w-full min-h-[122.6px] mb-3 xl:col-span-1 lg:col-span-1">
                <div class="flex justify-between items-center border border-[#1252CC] rounded-lg px-10 py-6">
                    <div>
                        <img src="{{ asset('/assets/templates/valent/images/icon/wallet_all-time_pnl.png') }}"
                            alt="pnl" class="w-10">
                    </div>
                    <div class="text-right">
                        <p class="text-xl text-[#1252CC]">All Time PNL</p>
                        <p class="text-2xl font-bold">{{ formatAmount($profit_fig + $capital) }}</p>
                        <div class="flex justify-between py-4">

                            @if ($profit_percent <= 0)
                                <img src="{{ asset('/assets/templates/valent/images/icon/wallet_graph_line_red.png') }}"
                                    alt="" class="w-full">
                                <div class="w-full flex justify-between gap-3">
                                    <img src="{{ asset('/assets/templates/valent/images/icon/wallet_combine_shape_red.png') }}"
                                        alt="arrow" class="w-[19px] h-[19px]">
                                    <span class="text-xl text-[#D91414]">0%</span>
                                </div>
                            @else
                                <img src="{{ asset('/assets/templates/valent/images/icon/wallet_graph_line_white_up.png') }}"
                                    alt="" class="w-full">
                                <div class="w-full flex justify-between gap-3">
                                    <img src="{{ asset('/assets/templates/valent/images/icon/wallet_combine_shape_white_up.png') }}"
                                        alt="arrow" class="w-[19px] h-[19px]">
                                    <span class="text-xl text--white">+{{ number_format($profit_percent, 2) }}%</span>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full min-h-[122.6px] mb-3 xl:col-span-1 lg:col-span-2">
                <div class="flex justify-between items-center border border-[#1252CC] rounded-lg px-10 py-6">
                    <div>
                        <img src="{{ asset('/assets/templates/valent/images/icon/wallet_al_bots.png') }}" alt="ai bots"
                            class="w-10">
                    </div>
                    <div class="text-right">
                        <p class="text-xl text-[#1252CC]">AI Bots</p>
                        <p class="text-2xl font-bold">{{ user()->botActivations()->count() }}</p>
                        <div class="flex justify-end py-4">
                            <span class="text-xl">+{{ user()->botHistory()->count() }} trades</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- end wallet- --}}



    {{-- Al Trading View chart --}}
    <div class="w-full py-6" data-aos="fade-up">
        <div class="min-w-max mx-auto mb-3 text-white">
            <h1 class="text-xl lg:text-3xl font-bold mb-6">AI Trading Overview (7 Day PNL)</h1>
            <div class="bg-cover bg-no-repeat bg-center"
                style="background-image: url({{ asset('/assets/templates/valent/images/chart-bg.png') }});">
                <canvas id="canvas" class="w-full"></canvas>
            </div>
        </div>
    </div>
    {{-- end ai tradeing view chart --}}



    {{-- my history --}}
    <div class="w-full py-6" data-aos="fade-up">
        <div class="lg:max-w-screen-xl mx-auto lg:p-4 mb-3 text-white">

            <div class="lg:flex items-center gap-4 mb-6">
                <h1 class="text-xl lg:text-3xl font-bold mr-10 mb-3">My History</h1>
                <div class="flex gap-4">
                    <button id="all_history_btn"
                        class="bg-black text-white px-6 py-2 rounded-xl border-b-4 hover:border-b-4 border-[#0040BC]">All</button>
                    <button id="withdrawal_history_btn"
                        class="bg-black text-white px-6 py-2 rounded-xl hover:border-b-4 border-[#0040BC]">Withdrawal</button>
                    <button id="deposit_history_btn"
                        class="bg-black text-white px-6 py-2 rounded-xl hover:border-b-4 border-[#0040BC]">Deposits</button>
                </div>
            </div>

            <div id="all_history"
                class="block mb-10  bg-blue-600 bg-opacity-10 border border-opacity-15 border-blue-200 rounded-2xl overflow-auto w-full">
                <table class="w-full">
                    <thead class="text-center bg-gray-400 bg-opacity-25">
                        <th class="p-6 text-left">AI Bots/ID</th>
                        <th class="p-6 text-right">Amount</th>
                        <th class="p-6 text-left">Date</th>
                        <th class="p-6 text-left">Time</th>
                        <th class="p-6 text-left gap-2">
                            <button id="status-dropdown-btn" class="status-dropdown-btn flex gap-3 items-center">Status
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
                                    <path
                                        d="M11.178 19.569a.998.998 0 0 0 1.644 0l9-13A.999.999 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13z">
                                    </path>
                                </svg>
                            </button>
                            <aside id="status-dropdown"
                                class="status-dropdown hidden absolute right-0 lg:w-[300px] bg-[#2d3039] bg-opacity-90 rounded-xl">
                                <ul class="py-6 px-10">
                                    <li><a href="" class="text-white text-xl flex gap-2 p-2">
                                            All</a></li>
                                    <li><a href="" class="text-white text-xl flex items-center gap-2 p-2"> <span
                                                class="w-4 h-4 bg-[#E9790A] rounded-full"></span>
                                            Confirming</a></li>
                                    <li><a href="" class="text-white text-xl flex items-center gap-2 p-2"> <span
                                                class="w-4 h-4 bg-[#D8D8D8] rounded-full"></span>
                                            Waiting</a></li>
                                    <li><a href="" class="text-white text-xl flex items-center gap-2 p-2"> <span
                                                class="w-4 h-4 bg-[#40DDFF] rounded-full"></span> Partly
                                            Paid</a></li>
                                    <li><a href="" class="text-white text-xl flex items-center gap-2 p-2"> <span
                                                class="w-4 h-4 bg-[#08C949] rounded-full"></span>
                                            Finished</a></li>
                                    <li><a href="" class="text-white text-xl flex items-center gap-2 p-2"> <span
                                                class="w-4 h-4 bg-[#EA0A0E] rounded-full"></span>
                                            Expired</a></li>
                                </ul>
                            </aside>
                        </th>
                    </thead>
                    <tbody>
                        @forelse ($deposits_and_withdrawals as $allData)
                            <tr class="border-t border-opacity-25 border-blue-200">
                                <td class="p-6">
                                    <div class="flex items-center gap-4 ">
                                        <img class="w-8 h-8"
                                            src="{{ 'https://nowpayments.io' . getCurrencyByCoin($allData->deposit_coin_id)->logo_url }}"
                                            alt="bitcoin" width="50px">
                                        <div class="block">
                                            <p class="text-lg font-bold">
                                                {{ getCurrencyByCoin($allData->deposit_coin_id)->name }}</p>
                                            <p class=" text-gray-400">
                                                {{ $allData->wallet_address ?? $allData->payment_wallet }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right p-6">
                                    <p class=" font-bold">{{ formatAmount($allData->amount) }}</p>
                                    <p class=" text-gray-400">
                                        {{ $allData->converted_amount }}
                                        {{ getCurrencyByCoin($allData->deposit_coin_id)->code }}/
                                        <span
                                            class="text-[#EA0A0E]">{{ getCurrencyByCoin($allData->deposit_coin_id)->network ?? getCurrencyByCoin($allData->deposit_coin_id)->code }}</span>
                                    </p>
                                </td>
                                <td class="text-left p-6">
                                    <p class="">{{ date('d-m-y', strtotime($allData->created_at)) }}</p>
                                </td>
                                <td class="text-left p-6">
                                    <p class="">{{ date('H:i:s A', strtotime($allData->created_at)) }}</p>
                                </td>
                                <td class="text-left p-6">
                                    <p class="flex justify-end items-center space-x-1 gap-4">

                                        @if ($allData->status == 'pending')
                                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect x="0.0820312" y="0.322632" width="18" height="18"
                                                    rx="9" fill="#D8D8D8" fill-opacity="0.11" />
                                                <circle cx="5" cy="5" r="5"
                                                    transform="matrix(-1 0 0 1 14.082 4.32263)" fill="#D8D8D8" />
                                            </svg>
                                            <span class="text-gray-500 uppercase text-xs">{{ $allData->status }}</span>
                                        @elseif ($allData->status == 'approved' || $allData->status == 'finished')
                                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M8.65505 1.74993C8.92055 1.48478 9.27577 1.32877 9.65064 1.31266C10.0255 1.29656 10.3928 1.42153 10.6801 1.66293L10.7761 1.75068L12.2011 3.17493H14.2156C14.5939 3.175 14.9582 3.31801 15.2355 3.57531C15.5128 3.8326 15.6827 4.18519 15.7111 4.56243L15.7156 4.67493V6.68943L17.1406 8.11443C17.4059 8.37996 17.5621 8.73533 17.5782 9.11038C17.5943 9.48542 17.4692 9.85288 17.2276 10.1402L17.1398 10.2354L15.7148 11.6604V13.6749C15.7149 14.0534 15.572 14.4179 15.3147 14.6953C15.0574 14.9728 14.7047 15.1428 14.3273 15.1712L14.2156 15.1749H12.2018L10.7768 16.5999C10.5113 16.8653 10.1559 17.0214 9.78085 17.0375C9.40581 17.0536 9.03836 16.9285 8.75105 16.6869L8.6558 16.5999L7.2308 15.1749H5.21555C4.83712 15.175 4.47263 15.0321 4.19514 14.7748C3.91766 14.5175 3.74769 14.1648 3.7193 13.7874L3.71555 13.6749V11.6604L2.29055 10.2354C2.0252 9.9699 1.86905 9.61452 1.85295 9.23948C1.83684 8.86443 1.96194 8.49698 2.20355 8.20968L2.29055 8.11443L3.71555 6.68943V4.67493C3.71562 4.29663 3.85863 3.93232 4.11593 3.65499C4.37323 3.37767 4.72582 3.2078 5.10305 3.17943L5.21555 3.17493H7.23005L8.65505 1.74993Z"
                                                    fill="#08C949" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M12.0238 6.91219L8.84078 10.0952L7.51478 8.76919C7.37405 8.62856 7.18321 8.5496 6.98426 8.54967C6.78531 8.54974 6.59453 8.62884 6.4539 8.76957C6.31327 8.9103 6.2343 9.10113 6.23438 9.30008C6.23445 9.49904 6.31355 9.68981 6.45428 9.83044L8.25728 11.6334C8.33389 11.7101 8.42485 11.7709 8.52497 11.8124C8.62509 11.8539 8.7324 11.8752 8.84078 11.8752C8.94915 11.8752 9.05646 11.8539 9.15658 11.8124C9.2567 11.7709 9.34766 11.7101 9.42428 11.6334L13.0843 7.97269C13.2209 7.83124 13.2965 7.64179 13.2948 7.44514C13.2931 7.2485 13.2142 7.06039 13.0751 6.92133C12.9361 6.78227 12.748 6.7034 12.5513 6.70169C12.3547 6.69998 12.1652 6.77558 12.0238 6.91219Z"
                                                    fill="#F0FCFF" />
                                            </svg>
                                            <span class="text-green-500 uppercase text-xs">{{ $allData->status }}</span>
                                        @elseif ($allData->status == 'rejected' || $allData->status == 'failed' || $allData->status == 'refunded')
                                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M8.65505 1.80913C8.92055 1.54399 9.27577 1.38797 9.65064 1.37187C10.0255 1.35576 10.3928 1.48074 10.6801 1.72213L10.7761 1.80988L12.2011 3.23413H14.2156C14.5939 3.2342 14.9582 3.37721 15.2355 3.63451C15.5128 3.89181 15.6827 4.24439 15.7111 4.62163L15.7156 4.73413V6.74863L17.1406 8.17363C17.4059 8.43916 17.5621 8.79454 17.5782 9.16958C17.5943 9.54463 17.4692 9.91208 17.2276 10.1994L17.1398 10.2946L15.7148 11.7196V13.7341C15.7149 14.1126 15.572 14.4771 15.3147 14.7545C15.0574 15.032 14.7047 15.202 14.3273 15.2304L14.2156 15.2341H12.2018L10.7768 16.6591C10.5113 16.9245 10.1559 17.0806 9.78085 17.0967C9.40581 17.1128 9.03836 16.9877 8.75105 16.7461L8.6558 16.6591L7.2308 15.2341H5.21555C4.83712 15.2343 4.47263 15.0913 4.19514 14.834C3.91766 14.5767 3.74769 14.224 3.7193 13.8466L3.71555 13.7341V11.7196L2.29055 10.2946C2.0252 10.0291 1.86905 9.67373 1.85295 9.29868C1.83684 8.92364 1.96194 8.55618 2.20355 8.26888L2.29055 8.17363L3.71555 6.74863V4.73413C3.71562 4.35583 3.85863 3.99152 4.11593 3.7142C4.37323 3.43687 4.72582 3.267 5.10305 3.23863L5.21555 3.23413H7.23005L8.65505 1.80913Z"
                                                    fill="#EA0A0E" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M12.0238 6.9714L8.84078 10.1544L7.51478 8.8284C7.37405 8.68777 7.18321 8.6088 6.98426 8.60887C6.78531 8.60894 6.59453 8.68804 6.4539 8.82877C6.31327 8.9695 6.2343 9.16034 6.23438 9.35929C6.23445 9.55824 6.31355 9.74902 6.45428 9.88965L8.25728 11.6926C8.33389 11.7693 8.42485 11.8301 8.52497 11.8716C8.62509 11.9131 8.7324 11.9344 8.84078 11.9344C8.94915 11.9344 9.05646 11.9131 9.15658 11.8716C9.2567 11.8301 9.34766 11.7693 9.42428 11.6926L13.0843 8.0319C13.2209 7.89045 13.2965 7.70099 13.2948 7.50435C13.2931 7.3077 13.2142 7.11959 13.0751 6.98053C12.9361 6.84148 12.748 6.7626 12.5513 6.76089C12.3547 6.75918 12.1652 6.83478 12.0238 6.9714Z"
                                                    fill="#F0FCFF" />
                                            </svg>
                                            <span class="text-red-500 uppercase text-xs">{{ $allData->status }}</span>
                                        @else
                                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect x="0.0820312" y="0.322632" width="18" height="18"
                                                    rx="9" fill="#D8D8D8" fill-opacity="0.11" />
                                                <circle cx="5" cy="5" r="5"
                                                    transform="matrix(-1 0 0 1 14.082 4.32263)" fill="#D8D8D8" />
                                            </svg>

                                            <span class="text-orange-500 uppercase text-xs">{{ $allData->status }}</span>
                                        @endif
                                    </p>
                                </td>
                            </tr>
                        @empty
                            <tr class="border border-opacity-25 border-blue-200 cursor-pointer">
                                <td
                                    class="w-full flex justify-center items-center ts-gray-3 p-2 rounded-lg  border-slate-800 hover:border-slate-600 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500"
                                        fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                    </svg>
                                    <span>Empty Record. No Record found!</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div id="withdrawal_history"
                class="hidden mb-10  bg-blue-600 bg-opacity-10 border border-opacity-15 border-blue-200 rounded-2xl overflow-auto w-full">
                <table class="w-full">
                    <thead class="text-center bg-gray-400 bg-opacity-25">
                        <th class="p-6 text-left">AI Bots/ID</th>
                        <th class="p-6 text-right">Amount</th>
                        <th class="p-6 text-left">Date</th>
                        <th class="p-6 text-left">Time</th>
                        <th class="p-6 text-left gap-2">
                            <button id="status-dropdown-btn" class="status-dropdown-btn flex gap-3 items-center">Status
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
                                    <path
                                        d="M11.178 19.569a.998.998 0 0 0 1.644 0l9-13A.999.999 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13z">
                                    </path>
                                </svg>
                            </button>
                            <aside id="status-dropdown"
                                class="status-dropdown hidden absolute right-0 lg:w-[300px] bg-[#2d3039] bg-opacity-90 rounded-xl">
                                <ul class="py-6 px-10">
                                    <li><a href="" class="text-white text-xl flex gap-2 p-2">
                                            All</a></li>
                                    <li><a href="" class="text-white text-xl flex items-center gap-2 p-2"> <span
                                                class="w-4 h-4 bg-[#E9790A] rounded-full"></span>
                                            Confirming</a></li>
                                    <li><a href="" class="text-white text-xl flex items-center gap-2 p-2"> <span
                                                class="w-4 h-4 bg-[#D8D8D8] rounded-full"></span>
                                            Waiting</a></li>
                                    <li><a href="" class="text-white text-xl flex items-center gap-2 p-2"> <span
                                                class="w-4 h-4 bg-[#40DDFF] rounded-full"></span> Partly
                                            Paid</a></li>
                                    <li><a href="" class="text-white text-xl flex items-center gap-2 p-2"> <span
                                                class="w-4 h-4 bg-[#08C949] rounded-full"></span>
                                            Finished</a></li>
                                    <li><a href="" class="text-white text-xl flex items-center gap-2 p-2"> <span
                                                class="w-4 h-4 bg-[#EA0A0E] rounded-full"></span>
                                            Expired</a></li>
                                </ul>
                            </aside>
                        </th>
                    </thead>
                    <tbody>
                        @forelse ($withdrawals as $withdrawal)
                            <tr class="border-t border-opacity-25 border-blue-200">
                                <td class="p-6">
                                    <div class="flex items-center gap-4 ">
                                        <img class="w-8 h-8"
                                            src="{{ 'https://nowpayments.io' . $withdrawal->depositCoin->logo_url }}"alt=""
                                            sswidth="50px">
                                        <div class="block">
                                            <p class="text-xl font-bold">{{ $withdrawal->depositCoin->name }}</p>
                                            <p class=" text-gray-400">{{ $withdrawal->wallet_address }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right p-6">
                                    <p class="text-xl font-bold">
                                        {{ formatAmount($withdrawal->amount - $withdrawal->fee) }}</p>
                                    <p class=" text-gray-400">
                                        <span>{{ $withdrawal->converted_amount . ' ' . $withdrawal->depositCoin->code }}</span>
                                        <span
                                            class="text-[#EA0A0E]">{{ $withdrawal->depositCoin->network ?? $withdrawal->depositCoin->code }}</span>
                                    </p>
                                </td>
                                <td class="text-left p-6">
                                    <p class="text-xl">{{ date('d-m-y', strtotime($withdrawal->created_at)) }}</p>
                                </td>
                                <td class="text-left p-6">
                                    <p class="text-xl">{{ date('H:i:s A', strtotime($withdrawal->created_at)) }}</p>
                                </td>
                                <td class="text-left p-6">
                                    <p class="flex justify-end items-center space-x-1 gap-4">

                                        @if ($withdrawal->status == 'pending')
                                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect x="0.0820312" y="0.322632" width="18" height="18"
                                                    rx="9" fill="#D8D8D8" fill-opacity="0.11" />
                                                <circle cx="5" cy="5" r="5"
                                                    transform="matrix(-1 0 0 1 14.082 4.32263)" fill="#D8D8D8" />
                                            </svg>
                                            <span class="text-gray-500 uppercase text-xs">{{ $withdrawal->status }}</span>
                                        @elseif ($withdrawal->status == 'approved')
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
                                                class="text-green-500 uppercase text-xs">{{ $withdrawal->status }}</span>
                                        @elseif ($withdrawal->status == 'rejected' || $withdrawal->status == 'failed' || $withdrawal->status == 'refunded')
                                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M8.65505 1.80913C8.92055 1.54399 9.27577 1.38797 9.65064 1.37187C10.0255 1.35576 10.3928 1.48074 10.6801 1.72213L10.7761 1.80988L12.2011 3.23413H14.2156C14.5939 3.2342 14.9582 3.37721 15.2355 3.63451C15.5128 3.89181 15.6827 4.24439 15.7111 4.62163L15.7156 4.73413V6.74863L17.1406 8.17363C17.4059 8.43916 17.5621 8.79454 17.5782 9.16958C17.5943 9.54463 17.4692 9.91208 17.2276 10.1994L17.1398 10.2946L15.7148 11.7196V13.7341C15.7149 14.1126 15.572 14.4771 15.3147 14.7545C15.0574 15.032 14.7047 15.202 14.3273 15.2304L14.2156 15.2341H12.2018L10.7768 16.6591C10.5113 16.9245 10.1559 17.0806 9.78085 17.0967C9.40581 17.1128 9.03836 16.9877 8.75105 16.7461L8.6558 16.6591L7.2308 15.2341H5.21555C4.83712 15.2343 4.47263 15.0913 4.19514 14.834C3.91766 14.5767 3.74769 14.224 3.7193 13.8466L3.71555 13.7341V11.7196L2.29055 10.2946C2.0252 10.0291 1.86905 9.67373 1.85295 9.29868C1.83684 8.92364 1.96194 8.55618 2.20355 8.26888L2.29055 8.17363L3.71555 6.74863V4.73413C3.71562 4.35583 3.85863 3.99152 4.11593 3.7142C4.37323 3.43687 4.72582 3.267 5.10305 3.23863L5.21555 3.23413H7.23005L8.65505 1.80913Z"
                                                    fill="#EA0A0E" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M12.0238 6.9714L8.84078 10.1544L7.51478 8.8284C7.37405 8.68777 7.18321 8.6088 6.98426 8.60887C6.78531 8.60894 6.59453 8.68804 6.4539 8.82877C6.31327 8.9695 6.2343 9.16034 6.23438 9.35929C6.23445 9.55824 6.31355 9.74902 6.45428 9.88965L8.25728 11.6926C8.33389 11.7693 8.42485 11.8301 8.52497 11.8716C8.62509 11.9131 8.7324 11.9344 8.84078 11.9344C8.94915 11.9344 9.05646 11.9131 9.15658 11.8716C9.2567 11.8301 9.34766 11.7693 9.42428 11.6926L13.0843 8.0319C13.2209 7.89045 13.2965 7.70099 13.2948 7.50435C13.2931 7.3077 13.2142 7.11959 13.0751 6.98053C12.9361 6.84148 12.748 6.7626 12.5513 6.76089C12.3547 6.75918 12.1652 6.83478 12.0238 6.9714Z"
                                                    fill="#F0FCFF" />
                                            </svg>
                                            <span class="text-red-500 uppercase text-xs">{{ $withdrawal->status }}</span>
                                        @else
                                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect x="0.0820312" y="0.322632" width="18" height="18"
                                                    rx="9" fill="#D8D8D8" fill-opacity="0.11" />
                                                <circle cx="5" cy="5" r="5"
                                                    transform="matrix(-1 0 0 1 14.082 4.32263)" fill="#D8D8D8" />
                                            </svg>

                                            <span
                                                class="text-orange-500 uppercase text-xs">{{ $withdrawal->status }}</span>
                                        @endif
                                    </p>
                                </td>
                            </tr>
                        @empty
                            <tr class="border border-opacity-25 border-blue-200 cursor-pointer">
                                <td
                                    class="w-full flex justify-center items-center ts-gray-3 p-2 rounded-lg  border-slate-800 hover:border-slate-600 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500"
                                        fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
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

            <div id="deposit_history"
                class="hidden mb-10  bg-blue-600 bg-opacity-10 border border-opacity-15 border-blue-200 rounded-2xl overflow-auto w-full">
                <table class="w-full sh-[60vh]">
                    <thead class="text-center bg-gray-400 bg-opacity-25">
                        <th class="p-6 text-left">AI Bots/ID</th>
                        <th class="p-6 text-right">Amount</th>
                        <th class="p-6 text-left">Date</th>
                        <th class="p-6 text-left">Time</th>
                        <th class="p-6 text-left gap-2">
                            <button id="status-dropdown-btn" class="status-dropdown-btn flex gap-3 items-center">Status
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
                                    <path
                                        d="M11.178 19.569a.998.998 0 0 0 1.644 0l9-13A.999.999 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13z">
                                    </path>
                                </svg>
                            </button>
                            <aside id="status-dropdown"
                                class="status-dropdown hidden absolute right-0 lg:w-[300px] bg-[#2d3039] bg-opacity-90 rounded-xl">
                                <ul class="py-6 px-10">
                                    <li><a href="" class="text-white text-xl flex gap-2 p-2">
                                            All</a></li>
                                    <li><a href="" class="text-white text-xl flex items-center gap-2 p-2"> <span
                                                class="w-4 h-4 bg-[#E9790A] rounded-full"></span>
                                            Confirming</a></li>
                                    <li><a href="" class="text-white text-xl flex items-center gap-2 p-2"> <span
                                                class="w-4 h-4 bg-[#D8D8D8] rounded-full"></span>
                                            Waiting</a></li>
                                    <li><a href="" class="text-white text-xl flex items-center gap-2 p-2"> <span
                                                class="w-4 h-4 bg-[#40DDFF] rounded-full"></span> Partly
                                            Paid</a></li>
                                    <li><a href="" class="text-white text-xl flex items-center gap-2 p-2"> <span
                                                class="w-4 h-4 bg-[#08C949] rounded-full"></span>
                                            Finished</a></li>
                                    <li><a href="" class="text-white text-xl flex items-center gap-2 p-2"> <span
                                                class="w-4 h-4 bg-[#EA0A0E] rounded-full"></span>
                                            Expired</a></li>
                                </ul>
                            </aside>
                        </th>
                    </thead>
                    <tbody>
                        @forelse ($deposits as $deposit)
                            <tr class="border-t border-opacity-25 border-blue-200">
                                <td class="p-6">
                                    <div class="flex items-center gap-4 ">
                                        <img class="w-8 h-8"
                                            src="{{ 'https://nowpayments.io' . $deposit->depositCoin->logo_url }}"alt=""
                                            sswidth="50px">
                                        <div class="block">
                                            <p class="text-xl font-bold">{{ $deposit->depositCoin->name }}</p>
                                            <p class=" text-gray-400">{{ $deposit->payment_wallet }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right p-6">
                                    <p class="text-xl font-bold">
                                        {{ formatAmount($deposit->amount) }}</p>
                                    <p class=" text-gray-400">
                                        <span>{{ $deposit->converted_amount . ' ' . $deposit->depositCoin->code }}</span>
                                        <span
                                            class="text-[#EA0A0E]">{{ $deposit->depositCoin->network ?? $deposit->depositCoin->code }}</span>
                                    </p>
                                </td>
                                <td class="text-left p-6">
                                    <p class="text-xl">{{ date('d-m-y', strtotime($deposit->created_at)) }}</p>
                                </td>
                                <td class="text-left p-6">
                                    <p class="text-xl">{{ date('H:i:s A', strtotime($deposit->created_at)) }}</p>
                                </td>
                                <td class="text-left p-6">
                                    <p class="flex justify-end items-center space-x-1 gap-4">

                                        @if ($deposit->status == 'waiting')
                                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect x="0.0820312" y="0.322632" width="18" height="18"
                                                    rx="9" fill="#D8D8D8" fill-opacity="0.11" />
                                                <circle cx="5" cy="5" r="5"
                                                    transform="matrix(-1 0 0 1 14.082 4.32263)" fill="#D8D8D8" />
                                            </svg>
                                            <span class="text-gray-500 uppercase text-xs">{{ $deposit->status }}</span>
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
                                            <span class="text-green-500 uppercase text-xs">{{ $deposit->status }}</span>
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
                                            <span class="text-orange-500 uppercase text-xs">{{ $deposit->status }}</span>
                                        @endif
                                    </p>
                                </td>
                            </tr>
                        @empty
                            <tr class="border border-opacity-25 border-blue-200 cursor-pointer">
                                <td
                                    class="w-full flex justify-center items-center ts-gray-3 p-2 rounded-lg  border-slate-800 hover:border-slate-600 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500"
                                        fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                    </svg>
                                    <span>Empty Record. No Deposit found!</span>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>


        </div>
    </div>
    {{-- end my history --}}

    {{-- my bots and recent trades --}}
    <div class="w-full py-6" data-aos="fade-up">
        <div class="lg:max-w-screen-xl mx-auto lg:p-6 mb-3 text-white ">
            <div class="lg:grid grid-cols-2 gap-10">
                <!--my bots-->
                <div class="mb-10 col-span-1">
                    <h1 class="text-xl text-blue-500 mb-4">My Bots</h1>
                    <div
                        class="bg-blue-600 bg-opacity-10 rounded-xl border  border-opacity-25 border-blue-200 p-4 overflow-y-auto h-[60vh]">
                        <ul class="w-full grid grid-cols-2 gap-2">
                            <li class="text-xl text-left font-bold mb-3">My Bots</li>
                            <li class="text-xl text-right font-bold mb-3">Portfolio Balance</li>
                        </ul>
                        @forelse ($activations as $bot)
                            <ul class="w-full grid grid-cols-2 gap-2 mb-3">
                                <li class="text-lg text-left flex gap-2 items-center mb-3 ">
                                    <img class="w-12 h-12 bg-white rounded-full"
                                        src="{{ asset('storage/bots/' . $bot->bot->logo) }}" alt="bots">
                                    <div>
                                        <p class="flex gap-2">
                                            {{ $bot->bot->name }}
                                            @if ($bot->status == 'active')
                                                <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M10.6319 1.64199C10.9859 1.28847 11.4595 1.08045 11.9593 1.05897C12.4591 1.0375 12.9489 1.20413 13.3319 1.52599L13.4599 1.64299L15.3599 3.54199H18.0459C18.5503 3.54209 19.036 3.73277 19.4058 4.07583C19.7756 4.4189 20.002 4.88901 20.0399 5.39199L20.0459 5.54199V8.22799L21.9459 10.128C22.2997 10.482 22.5079 10.9559 22.5293 11.4559C22.5508 11.956 22.384 12.4459 22.0619 12.829L21.9449 12.956L20.0449 14.856V17.542C20.045 18.0466 19.8545 18.5326 19.5114 18.9025C19.1683 19.2725 18.698 19.4992 18.1949 19.537L18.0459 19.542H15.3609L13.4609 21.442C13.1068 21.7958 12.633 22.004 12.1329 22.0255C11.6329 22.0469 11.1429 21.8801 10.7599 21.558L10.6329 21.442L8.73287 19.542H6.04587C5.54129 19.5422 5.0553 19.3516 4.68532 19.0085C4.31534 18.6654 4.08871 18.1951 4.05087 17.692L4.04587 17.542V14.856L2.14587 12.956C1.79206 12.602 1.58387 12.1281 1.56239 11.6281C1.54091 11.128 1.70772 10.6381 2.02987 10.255L2.14587 10.128L4.04587 8.22799V5.54199C4.04596 5.03759 4.23664 4.55185 4.57971 4.18208C4.92277 3.81231 5.39289 3.58582 5.89587 3.54799L6.04587 3.54199H8.73187L10.6319 1.64199Z"
                                                        fill="#00AA39" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M15.1255 8.52497L10.8815 12.769L9.11345 11.001C8.92581 10.8135 8.67137 10.7082 8.4061 10.7083C8.14083 10.7084 7.88646 10.8138 7.69895 11.0015C7.51144 11.1891 7.40616 11.4436 7.40625 11.7088C7.40634 11.9741 7.51181 12.2285 7.69945 12.416L10.1035 14.82C10.2056 14.9222 10.3269 15.0032 10.4604 15.0586C10.5939 15.1139 10.737 15.1423 10.8815 15.1423C11.0259 15.1423 11.169 15.1139 11.3025 15.0586C11.436 15.0032 11.5573 14.9222 11.6595 14.82L16.5395 9.93897C16.7216 9.75037 16.8224 9.49777 16.8201 9.23557C16.8178 8.97338 16.7127 8.72256 16.5273 8.53716C16.3419 8.35175 16.0911 8.24658 15.8289 8.2443C15.5667 8.24202 15.3141 8.34282 15.1255 8.52497Z"
                                                        fill="#F0FCFF" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="#6b7280"
                                                    class="bi bi-patch-exclamation-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                </svg>
                                            @endif
                                        </p>
                                        <p class="flex gap-2">
                                            <span class="text-[#EA0A0E]">PNL</span>
                                            @if ($bot->profit < 0)
                                                <span class="text-red-500 flex space-x-1 flex justify-end">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="w-6 h-6">
                                                        <path fill-rule="evenodd"
                                                            d="M1.72 5.47a.75.75 0 011.06 0L9 11.69l3.756-3.756a.75.75 0 01.985-.066 12.698 12.698 0 014.575 6.832l.308 1.149 2.277-3.943a.75.75 0 111.299.75l-3.182 5.51a.75.75 0 01-1.025.275l-5.511-3.181a.75.75 0 01.75-1.3l3.943 2.277-.308-1.149a11.194 11.194 0 00-3.528-5.617l-3.809 3.81a.75.75 0 01-1.06 0L1.72 6.53a.75.75 0 010-1.061z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span>{{ round(($bot->profit / ($bot->capital + 0.0001)) * 100, 2) }}%</span>
                                                </span>
                                            @else
                                                <span class="text-green-500 flex space-x-1 flex justify-end">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="w-6 h-6">
                                                        <path fill-rule="evenodd"
                                                            d="M15.22 6.268a.75.75 0 01.968-.432l5.942 2.28a.75.75 0 01.431.97l-2.28 5.941a.75.75 0 11-1.4-.537l1.63-4.251-1.086.483a11.2 11.2 0 00-5.45 5.174.75.75 0 01-1.199.19L9 12.31l-6.22 6.22a.75.75 0 11-1.06-1.06l6.75-6.75a.75.75 0 011.06 0l3.606 3.605a12.694 12.694 0 015.68-4.973l1.086-.484-4.251-1.631a.75.75 0 01-.432-.97z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span>+{{ round(($bot->profit / ($bot->capital + 0.0001)) * 100, 2) }}%</span>
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                </li>
                                <li class="text-right flex items-center justify-end mb-3">
                                    {{ formatAmount($bot->balance) }}</li>
                            </ul>
                        @empty
                            <p
                                class="w-full flex justify-center items-center ts-gray-3 p-2 rounded-lg  border-slate-800 hover:border-slate-600 ">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500"
                                    fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>
                                <span>Empty Record. No Record found!</span>
                            </p>
                        @endforelse
                    </div>
                </div>

                <!--recent trades-->
                <div class="mb-4 col-span-1">
                    <h1 class="text-xl text-blue-500 mb-4">My Recent Trades</h1>
                    <div
                        class="block  bg-blue-600 bg-opacity-10 border border-opacity-15 border-blue-200 rounded-2xl overflow-y-auto  h-[60vh]">
                        <table class="w-full">
                            <thead class="text-center bg-gray-400 bg-opacity-25">
                                <th class="px-6 py-2 text-left">AI Bots</th>
                                <th class="px-6 py-2 text-right">Trading Pairs</th>
                                <th class="px-6 py-2 text-left">Profit/Loss</th>
                            </thead>
                            <tbody>
                                @forelse ($histories as $history)
                                    <tr>
                                        <td class="p-6">
                                            <div class="flex items-center gap-4 ">
                                                <img class="w-12 h-12 bg-white rounded-full"
                                                    src="{{ asset('storage/bots/' . $history->botActivation->bot->logo) }}"
                                                    alt="">
                                                <div class="block">
                                                    <p class="text-md font-bold">{{ $history->botActivation->bot->name }}
                                                    </p>
                                                    <p class="text-sm text-gray-400 block gap-2">
                                                    <div class="flex gap-3">
                                                        <img src="{{ asset('/assets/templates/valent/images/icon/ai_clock_icon.svg') }}"
                                                            alt="clock"><span>{{ date('d-m-y', $history->timestamp) }} </span>
                                                    </div>
                                                    <div class="flex gap-3">
                                                        <img src="{{ asset('/assets/templates/valent/images/icon/ai_calender_icon.svg') }}"
                                                            alt="clock"><span>{{ date('H:i:s', $history->timestamp) }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        @if ($history->profit < 0)
                                            <td class="text-right p-6">
                                                <p class="text-md font-bold">{{ $history->pair }}</p>

                                                <p class="text-[#EA0A0E]">
                                                    {{ number_format((($history->exit_price - $history->entry_price) / $history->entry_price) * 100, 2) }}%
                                                </p>

                                            </td>
                                            <td class="text-right p-6">
                                                <p class="text-md font-bold text-[#EA0A0E]">
                                                    {{ formatAmount(str_replace('-', '', $history->profit)) }}</p>
                                            </td>
                                        @else
                                            <td class="text-right p-6">
                                                <p class="text-md font-bold">{{ $history->pair }}</p>

                                                <p class="text-[#00AA39]">
                                                    +{{ number_format((($history->exit_price - $history->entry_price) / $history->entry_price) * 100, 2) }}%
                                                </p>

                                            </td>
                                            <td class="text-right p-6">
                                                <p class="text-md font-bold text-[#00AA39]">
                                                    +{{ formatAmount(str_replace('-', '', $history->profit)) }}</p>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <p
                                        class="w-full flex justify-center items-center ts-gray-3 p-2 rounded-lg  border-slate-800 hover:border-slate-600 ">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-500"
                                            fill="currentColor" class="bi bi-exclamation-triangle-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                        </svg>
                                        <span>Empty Record. No Record found!</span>
                                    </p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end my bots and recent trades --}}
@endsection

@section('scripts')
    <script>
        var lineChartData = {
            labels: @json($days), // Pass PHP-generated days
            datasets: [{
                    label: "Profit",
                    data: @json($profits).reverse(), // Pass PHP-generated profit data
                    pointBackgroundColor: "rgba(255,100,50,1)",
                    pointBorderColor: "#fff",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(255,100,50,1)",
                    tension: 0.4,
                    fill: false,
                },
                {
                    label: "Deposit",
                    data: @json($deposits_graph), // Pass PHP-generated deposit data
                    pointBackgroundColor: "rgba(255,100,50,1)",
                    pointBorderColor: "#fff",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(255,100,50,1)",
                    tension: 0.4,
                    fill: false,
                },
                {
                    label: "Withdrawal",
                    data: @json($withdrawals_graph), // Pass PHP-generated withdrawal data
                    pointBackgroundColor: "rgba(50,150,255,1)",
                    pointBorderColor: "#fff",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(50,150,255,1)",
                    tension: 0.4,
                    fill: false,
                }
            ],
        };

        window.addEventListener("load", function() {
            var canvas = document.getElementById("canvas");
            if (!canvas) {
                console.error("Canvas element not found!");
                return;
            }

            var ctx = canvas.getContext("2d");

            var gradientProfit = ctx.createLinearGradient(0, 0, canvas.width, 0);
            gradientProfit.addColorStop(0, "rgba(255,100,50,1)");
            gradientProfit.addColorStop(1, "rgba(255,200,50,1)");
            lineChartData.datasets[0].borderColor = gradientProfit;

            var gradientDeposit = ctx.createLinearGradient(0, 0, canvas.width, 0);
            gradientDeposit.addColorStop(0, "rgba(50,150,50,1)");
            gradientDeposit.addColorStop(1, "rgba(100,200,50,1)");
            lineChartData.datasets[1].borderColor = gradientDeposit;

            var gradientWithdrawal = ctx.createLinearGradient(0, 0, canvas.width, 0);
            gradientWithdrawal.addColorStop(0, "rgba(50,150,255,1)");
            gradientWithdrawal.addColorStop(1, "rgba(100,200,255,1)");
            lineChartData.datasets[2].borderColor = gradientWithdrawal;

            new Chart(ctx, {
                type: "line",
                data: lineChartData,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1000,
                                color: "#1ED6FF",
                            },
                        },
                        x: {
                            beginAtZero: true,
                            ticks: {
                                color: "#1ED6FF",
                            },
                        },
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: "top",
                        },
                        tooltip: {
                            callbacks: {
                                title: function(tooltipItem) {
                                    return `Day: ${tooltipItem[0].label}`;
                                },
                                label: function(tooltipItem) {
                                    return `${tooltipItem.dataset.label}: ${tooltipItem.raw} {{ site('currency') }}`;
                                },
                            },
                        },
                    },
                },
            });
        });
    </script>

    <!-- jQuery Script for Sidebar Toggle and right dropdown-->
    <script>
        $(document).ready(function() {
            $("#all_history_btn").on("click", function() {
                $("#all_history").slideDown().removeClass('hidden');
                $("#withdrawal_history, #deposit_history").slideUp().addClass('hidden');

                $("#withdrawal_history_btn, #deposit_history_btn").removeClass('border-b-4');
                $("#all_history_btn").addClass('border-b-4');
            });

            $("#withdrawal_history_btn").on("click", function() {
                $("#withdrawal_history").slideDown().removeClass('hidden');
                $("#all_history, #deposit_history").slideUp().addClass('hidden');

                $("#all_history_btn, #deposit_history_btn").removeClass('border-b-4');
                $("#withdrawal_history_btn").addClass('border-b-4');
            });

            $("#deposit_history_btn").on("click", function() {
                $("#deposit_history").slideDown().removeClass('hidden');
                $("#all_history, #withdrawal_history").slideUp().addClass('hidden');

                $("#withdrawal_history_btn, #all_history_btn").removeClass('border-b-4');
                $("#deposit_history_btn").addClass('border-b-4');
            });
        });
    </script>
@endsection

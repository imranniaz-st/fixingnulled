@php

    $page_title = 'Live AI trading';
    $short_description = 'Watch live trading done by our trading bot as the execute these trades';

@endphp

{{-- layout --}}
@extends('templates.'. site('template') .'.layouts.front')


@section('css')
@endsection

@section('header')
    <div class="w-[90%] mx-auto lg:h-[545px] h-[30vh] flex items-center justify-center overflow-hidden">
        <div class="max-w-screen-lg text-center lg:mt-20 mt-32 lg:py-0 py-10" data-aos="fade-up">
            <p class="text-white font-light lg:text-9xl text-2xl lg:mb-3 lg:mt-44"><span class="font-bold">Live</span> Ai</p>
            <p class="lg:text-2xl text-lg text-white font-extralight"
                style="font-family: 'Noto Sans', sans-serif; font-weight: 100; ">
                <a href="" class="text-[#D8D8D8] text-opacity-45">Home</a> / <a href="">Ai Bots</a>
            </p>
        </div>
    </div>
@endsection


@section('contents')
    {{-- --}}
    <section class="w-full mb-10" data-aos="fade-up">
        <img src="{{ asset('/assets/templates/valent/images/3d-ai-trading-rb_39641.png') }}" alt="img"
            class="absolute right-0 lg:block hidden -z-10 animate-pulse w-[678px]">
        <div class="w-[90%] mx-auto py-10">
            <div class="lg:flex justify-start items-center lg:h-[70vh]">
                <div class="col-span-1">
                    <p class="text-[#B4B1B1] lg:text-left text-center">Live</p>
                    <p class="text-[#3F7DF2] lg:text-5xl text-2xl lg:mb-3 lg:text-left text-center">Live AI</p>
                    <p class="text-white font-bold lg:text-7xl text-4xl lg:mb-3 lg:text-left text-center">Trading </p>
                    <p
                        class="text-[#B4B1B1] lg:text-2xl text-lg leading-relaxed max-w-xl lg:text-left text-center lg:py-14 py-6">
                        {{ $short_description }}</p>
                </div>
                <div class="lg:hidden block">
                    <img src="{{ asset('/assets/templates/valent/images/3d-ai-trading-rb_39641.png') }}" alt="img"
                        class="lg:w-auto w-1/2 mx-auto animate-pulse">
                </div>
            </div>
        </div>
    </section>

    <!--trade from anywhere-->
    <section class="w-full mb-10 bg-cover bg-no-repeat bg-center" data-aos="fade-up">
        <div class="w-[90%] mx-auto py-4 px-3">
            <div class="w-full py-10">
                <p class="text-center text-[#B4B1B1] text-lg">BOTS</p>
                <p class="text-white font-bold lg:text-5xl text-2xl lg:mb-3 leading-relaxed text-center">
                    <span
                        class="font-bold bg-gradient-to-r from-[#3F7DF2] via-[#09C241] to-[#ffffff] to-[70%] bg-clip-text text-transparent leading-relaxed">Live
                        Trades</span>
                </p>
            </div>

            <div class="w-full bg-blue-200 bg-opacity-10 px-10 py-4 rounded-3xl">

                <div class="block overflow-auto w-full">
                    <table class="w-full">
                        <tbody id="tradeTableBody"></tbody>
                    </table>
                </div>

            </div>


        </div>
    </section>
@endsection

@section('scripts')
    {{-- recent trades table data --}}
    <script>
        let tradeData = @json(recentTradesAll());

        const tradeData1 = [{
                time: "2025-01-30T07:40:31Z",
                location: "Macao",
                network: "490.25",
                aibot: "GYRON-8MIG",
                market: "SPELLUSDT",
                price: "8,486.11",
                trend: "-4.25"
            },
            {
                time: "2025-01-30T07:40:31Z",
                location: "Macao",
                network: "490.25",
                aibot: "GYRON-8MIG",
                market: "SPELLUSDT",
                price: "8,486.11",
                trend: "+4.25"
            },
            {
                time: "2025-01-30T07:40:31Z",
                location: "Macao",
                network: "490.25",
                aibot: "GYRON-8MIG",
                market: "SPELLUSDT",
                price: "8,486.11",
                trend: "+4.25"
            },
            {
                time: "2025-01-30T07:40:31Z",
                location: "Macao",
                network: "490.25",
                aibot: "GYRON-8MIG",
                market: "SPELLUSDT",
                price: "8,486.11",
                trend: "+4.25"
            },
            {
                time: "2025-01-30T07:40:31Z",
                location: "Macao",
                network: "490.25",
                aibot: "GYRON-8MIG",
                market: "SPELLUSDT",
                price: "8,486.11",
                trend: "+4.25"
            },
            {
                time: "2025-01-30T07:40:31Z",
                location: "Macao",
                network: "490.25",
                aibot: "GYRON-8MIG",
                market: "SPELLUSDT",
                price: "8,486.11",
                trend: "+4.25"
            },
            {
                time: "2025-01-30T07:40:31Z",
                location: "Macao",
                network: "490.25",
                aibot: "GYRON-8MIG",
                market: "SPELLUSDT",
                price: "8,486.11",
                trend: "-4.25"
            },
            {
                time: "2025-01-30T07:40:31Z",
                location: "Macao",
                network: "490.25",
                aibot: "GYRON-8MIG",
                market: "SPELLUSDT",
                price: "8,486.11",
                trend: "+4.25"
            },
            {
                time: "2025-01-30T07:40:31Z",
                location: "Macao",
                network: "490.25",
                aibot: "GYRON-8MIG",
                market: "SPELLUSDT",
                price: "8,486.11",
                trend: "+4.25"
            },
            {
                time: "2025-01-30T07:40:31Z",
                location: "Macao",
                network: "490.25",
                aibot: "GYRON-8MIG",
                market: "SPELLUSDT",
                price: "8,486.11",
                trend: "+4.25"
            },
            {
                time: "2025-01-30T07:40:31Z",
                location: "Macao",
                network: "490.25",
                aibot: "GYRON-8MIG",
                market: "SPELLUSDT",
                price: "8,486.11",
                trend: "-4.25"
            },
            {
                time: "2025-01-30T07:40:31Z",
                location: "Macao",
                network: "490.25",
                aibot: "GYRON-8MIG",
                market: "SPELLUSDT",
                price: "8,486.11",
                trend: "+4.25"
            },
            {
                time: "2025-01-30T07:40:31Z",
                location: "Macao",
                network: "490.25",
                aibot: "GYRON-8MIG",
                market: "SPELLUSDT",
                price: "8,486.11",
                trend: "+4.25"
            },
            {
                time: "2025-01-30T07:40:31Z",
                location: "Macao",
                network: "490.25",
                aibot: "GYRON-8MIG",
                market: "SPELLUSDT",
                price: "8,486.11",
                trend: "-4.25"
            },
            {
                time: "2025-01-30T07:40:31Z",
                location: "Macao",
                network: "490.25",
                aibot: "GYRON-8MIG",
                market: "SPELLUSDT",
                price: "8,486.11",
                trend: "+4.25"
            },
            {
                time: "2025-01-30T07:40:31Z",
                location: "Macao",
                network: "490.25",
                aibot: "GYRON-8MIG",
                market: "SPELLUSDT",
                price: "8,486.11",
                trend: "-4.25"
            },
            {
                time: "2025-01-30T07:40:31Z",
                location: "Macao",
                network: "490.25",
                aibot: "GYRON-8MIG",
                market: "SPELLUSDT",
                price: "8,486.11",
                trend: "+4.25"
            },
        ];

        function updateTradeTable() {
            const tableBody = document.getElementById("tradeTableBody");
            tableBody.innerHTML = ""; // Clear existing rows

            tradeData.forEach((trade) => {
                const row = document.createElement("tr");
                row.className = `border-b border-opacity-25 border-blue-200 py-6 ${
            trade.profit.startsWith("-") ? "text-[#EA0A0E]" : "text-[#00AA39]"
        }`;

                row.innerHTML = `
            <td class="p-2 py-6"><p class="px-4">${new Date().toLocaleTimeString()}</p></td>
            <td class="p-2 py-6 text-right"><p class="px-4">${trade.country}</p></td>
            <td class="p-2 py-6 text-right"><p class="px-4">${trade.exchange}</p></td>
            <td class="p-2 py-6 text-right"><p class="px-4">${trade.bot}</p></td>
            <td class="p-2 py-6 text-right"><p class="px-4">${trade.pair}</p></td>
            <td class="p-2 py-6 text-right"><p class="px-4">$ ${trade.amount}</p></td>
            <td class="p-2 py-6 text-right"><p class="px-4">${trade.profit}</p></td>
        `;

                tableBody.appendChild(row);
            });
        }

        // Function to swap first row to last every 2 seconds
        function rotateRows() {
            if (tradeData.length > 1) {
                const firstRow = tradeData.shift(); // Remove first row
                tradeData.push(firstRow); // Add it to the end
                updateTradeTable(); // Refresh the table with new order
            }
        }

        // Initial table setup
        updateTradeTable();

        // Start row rotation every 2 seconds
        setInterval(rotateRows, 1000);
    </script>
@endsection

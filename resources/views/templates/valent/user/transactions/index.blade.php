@extends('templates.' . site('template') . '.layouts.user')

@section('contents')
    <!--my transaction-->
    <div class="w-full py-6" id="pageContent">
        <div class="lg:max-w-screen-xl mx-auto p-4 mb-3 text-white">

            <div class="block py-4 mb-10">
                <div action="" class="lg:block hidden w-full" id="filterForm">
                    <div class="w-full flex border rounded-full">

                        <input type="text" placeholder="Txn ref" id="search-transaction-input" value="{{ request()->s }}"
                            class="py-3 h-14s px-6 rounded-l-full bg-transparent w-full text-white">

                        <div class="simple-pagination" data-paginator="transactions">
                            <a id="search-transaction-button" data-link="{{ route('user.transactions.index') }}"
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
                <h1 class="text-xl lg:text-3xl font-bold">Transactions</h1>
            </div>

            <div class="lg:flex justify-between items-center mb-5 py-5">
                <div class="mb-3 block p-2">
                    <p> <span class="bg-black text-white px-6 py-2 rounded-xl border-b-4 border-[#0040BC]">My
                            Transactions</span></p>
                </div>

            </div>


            <div class="lg:grid grid-cols-4 gap-10" id="transactions">
                <div class="col-span-3 mb-10" data-aos="zoom-in">
                    <div
                        class="block bg-blue-600 bg-opacity-10 border border-opacity-15 border-blue-200 rounded-t-2xl overflow-auto w-full min-h-[60vh]">
                        <table class="w-full" id="transactionsTable">
                            <thead class="text-left bg-gray-400 bg-opacity-25">
                                <th class="p-6 lg:min-w-32 min-w-[50vw]">Date/Time</th>
                                <th class="p- lg:min-w-32 min-w-[50vw]">Description</th>
                                <th class="p-2 lg:min-w-32 min-w-[50vw]">Ref</th>
                                <th class="p-2 lg:min-w-32 min-w-[30vw]">Amount</th>
                                <th class="p-2 lg:min-w-32 min-w-[20vw]"></th>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
                                    <tr class="border-b border-opacity-25 border-blue-200 py-6">
                                        <td class="py-6 px-4">
                                            <p>{{ date('d-m-y H:i:s', strtotime($transaction->created_at)) }}</p>
                                        </td>
                                        <td class="py-6">
                                            <p class="cursor-pointer" data-copy="{{ $transaction->description }}">
                                                {{ $transaction->description }}</p>
                                        </td>
                                        <td class="py-6" data-transaction_tnx="{{ $transaction->ref }}">
                                            <p class="clipboard cursor-pointer" data-copy="{{ $transaction->ref }}">
                                                {{ $transaction->ref }}</p>
                                        </td>
                                        <td class="py-6">
                                            <p>{{ formatAmount($transaction->amount) }}</p>
                                        </td>
                                        <td class="py-6 flex justify-end px-4">
                                            @if ($transaction->type == 'debit')
                                                <span
                                                    class="text-end rounded-full w-auto bg-[#EA0A0E] bg-opacity-15 py-1 px-3 text-sm text-[#EA0A0E]">{{ $transaction->type }}</span>
                                            @else
                                                <span
                                                    class="text-end rounded-full w-auto bg-[#08C949] bg-opacity-15 py-1 px-3 text-sm text-[#08C949]">{{ $transaction->type }}</span>
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
                                            <span>Empty Record!</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="cursor-pointer simple-pagination" data-paginator="transactions">
                        {{ $transactions->links('templates.' . site('template') . '.paginations.simple') }}
                    </div>

                </div>

                <div class="col-span-1 mb-10">
                    <div class="flex items-center h-full">
                        <div data-aos="zoom-in" id="addWalletsAddress"
                            class="block mb-10 bg-gradient-to-r from-[#3E7CF2] to-[#0040BC] border border-opacity-15 border-blue-200 rounded-2xl w-full p-6">

                            <div class="py-10  lg:mb-6mb-4">
                                <h2 class="text-xl text-center text-white">Total Transactions</h2>
                            </div>

                            <div class="w-full text-center lg:mb-10 mb-4">
                                <p
                                    class="font-light text-[64px] p-0 m-0 leading-none bg-gradient-to-tl from-white  from-30% via-slate-600 via-80% to-white to-40% bg-clip-text text-transparent">
                                    {{ $transactions->total() }}</p>
                                <p class="p-0 m-0 leading-none">Transactions made</p>
                            </div>

                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
    <!--end my transaction-->
@endsection

@section('scripts')
    <script>
        // search transaction
        $(document).on('input keyup', '#search-transaction-input', function(e) {
            var ref = $(this).val();
            var base_link = $('#search-transaction-button').data('link');
            var encodedRef = encodeURIComponent(ref);

            // Append the query parameter to the URL
            var link = base_link + '?s=' + encodedRef;
            $('#search-transaction-button').attr('href', link);
        });
    </script>
@endsection

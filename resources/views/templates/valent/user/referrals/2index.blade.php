@extends('templates.' . site('template') . '.layouts.user')

@section('contents')
    <!--my referral-->
    <div class="w-full py-6">
        <div class="lg:max-w-screen-xl mx-auto p-4 mb-3 text-white">

            <div class="block mb-3">
                <h1 class="text-xl lg:text-3xl font-bold">Referrals</h1>
            </div>

            <div class="lg:flex justify-between items-center mb-5 py-5">
                <div class="mb-3 block p-2">
                    <p> <span class="bg-black text-white px-6 py-2 rounded-xl border-b-4 border-[#0040BC]">My
                            Referrals</span></p>
                </div>

            </div>


            <div class="lg:grid grid-cols-2 gap-10">
                <div class="col-span-1 mb-10" data-aos="zoom-in">
                    <div
                        class="block bg-blue-600 bg-opacity-10 border border-opacity-15 border-blue-200 rounded-t-2xl min-h-[60vh] overflow-auto w-full">
                        <div class="block bg-gray-400 bg-opacity-25">
                            <p class="font-bold text-lg p-6">My Referral Tree</p>
                        </div>

                        @php
                            function displayReferralTree($user, $level = 0, $maxLevels = 10)
                            {
                                if ($level >= $maxLevels) {
                                    return;
                                }

                                $referredUsers = $user->referredUsers;

                                if ($referredUsers->count() > 0) {
                                    echo '<div class="w-full">';
                                    foreach ($referredUsers as $referredUser) {
                                        echo '<div class="border-b border-opacity-25 border-blue-200 mb-1 bg-blue-200 bg-opacity-15" style="margin-left:' .
                                            40 * $level .
                                            'px"> <p class="px-4 border-l-8 border-blue-600 p-6">' .
                                            $referredUser->username .
                                            '</p></div>';
                                        displayReferralTree($referredUser, $level + 1, $maxLevels);
                                    }
                                    echo '</div>';
                                }
                            }
                        @endphp
                        <div class="w-full">
                            @php
                                displayReferralTree(user());
                            @endphp
                        </div>



                    </div>
                </div>

                <div class="col-span-1 mb-10">
                    <div class="flex items-center h-full" data-aos="zoom-in">
                        <div id="addWalletsAddress"
                            class="block mb-10  bg-gray-200 bg-opacity-10 border border-opacity-15 border-blue-200 rounded-2xl w-full p-6">

                            <div class="flex justify-between items-center lg:mb-10 mb-4">
                                <h2 class="text-xl font-semibold mb-4 text-white">Direct Referrals</h2>
                            </div>

                            <div class="w-full text-center lg:mb-10 mb-4">
                                <p
                                    class="font-light text-[128px] p-0 m-0 leading-none bg-gradient-to-tl from-white  from-30% via-slate-600 via-70% to-white to-40% bg-clip-text text-transparent">
                                    {{ user()->referredUsers->count() }}</p>
                                <p class="p-0 m-0 leading-none">Direct Referrals</p>
                            </div>

                            <div class="w-full text-center mb-4">
                                <p class="text-center text-gray-400 flex gap-3 justify-center items-center">
                                    <img src="{{ asset('/assets/templates/valent/images/icon/copy_icon.svg') }}"
                                        data-copy="{{ route('user.register', ['ref' => user()->username ?? 'notset']) }}"
                                        alt="icon" class="clipboard" style="cursor: pointer;">
                                    <span data-copy="{{ route('user.register', ['ref' => user()->username ?? 'notset']) }}"
                                        class="lg:text-md text-[12px] cursor-pointer clipboard">{{ route('user.register', ['ref' => user()->username ?? 'notset']) }}</span>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
    <!--end my referral-->
@endsection

@extends('templates.' . site('template') . '.layouts.user')

@section('contents')
    <!--my profile-->
    <div class="w-full py-6" id="refresh">
        <div class="lg:max-w-screen-xl mx-auto lg:p-4 mb-3 text-white">

            <div class="block mb-3">
                <h1 class="text-xl lg:text-3xl font-bold">KYC</h1>
            </div>

            <div class="lg:flex justify-between items-center mb-5 py-5">
                <div class="mb-3 block p-2">
                    <p> <span class="bg-black text-white px-6 py-2 rounded-xl border-b-4 border-[#0040BC]">My KYC
                            Record</span></p>
                </div>

            </div>


            <div
                class="block bg-gray-200 bg-opacity-10 border border-opacity-45 border-white rounded-t-2xl overflow-auto w-full p-6">
                @if ($kyc_records->count() > 0)
                    <div class="w-full p-4 px-10 border border-white border-opacity-15 rounded-2xl mb-10">
                        <div class="flex justify-between items-center mb-10">
                            <p class="text-lg">My KYC Record</p>
                        </div>

                        <div class="grid lg:grid-cols-3 grid-cols-1 gap-10 w-full">
                            @foreach ($kyc_records as $record)
                                <div class="col-span-1">
                                    <img src="{{ asset('storage/kyc/' . json_decode($record->photos)->front) }}"
                                        alt="id_card" class="mb-3 w-full">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="block mb-3 p-0 leading-none" style="text-transform: capitalize;">
                                                {{ $record->document_type }}</p>
                                            <p class="block text-[#7B7979] mb-3 p-0">
                                                {{ date('M d, Y', strtotime($record->created_at)) }}</p>
                                        </div>
                                        <div>
                                            @if ($record->status == 'approved')
                                                <svg width="24" height="24" viewBox="0 0 19 19" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8.65505 1.74993C8.92055 1.48478 9.27577 1.32877 9.65064 1.31266C10.0255 1.29656 10.3928 1.42153 10.6801 1.66293L10.7761 1.75068L12.2011 3.17493H14.2156C14.5939 3.175 14.9582 3.31801 15.2355 3.57531C15.5128 3.8326 15.6827 4.18519 15.7111 4.56243L15.7156 4.67493V6.68943L17.1406 8.11443C17.4059 8.37996 17.5621 8.73533 17.5782 9.11038C17.5943 9.48542 17.4692 9.85288 17.2276 10.1402L17.1398 10.2354L15.7148 11.6604V13.6749C15.7149 14.0534 15.572 14.4179 15.3147 14.6953C15.0574 14.9728 14.7047 15.1428 14.3273 15.1712L14.2156 15.1749H12.2018L10.7768 16.5999C10.5113 16.8653 10.1559 17.0214 9.78085 17.0375C9.40581 17.0536 9.03836 16.9285 8.75105 16.6869L8.6558 16.5999L7.2308 15.1749H5.21555C4.83712 15.175 4.47263 15.0321 4.19514 14.7748C3.91766 14.5175 3.74769 14.1648 3.7193 13.7874L3.71555 13.6749V11.6604L2.29055 10.2354C2.0252 9.9699 1.86905 9.61452 1.85295 9.23948C1.83684 8.86443 1.96194 8.49698 2.20355 8.20968L2.29055 8.11443L3.71555 6.68943V4.67493C3.71562 4.29663 3.85863 3.93232 4.11593 3.65499C4.37323 3.37767 4.72582 3.2078 5.10305 3.17943L5.21555 3.17493H7.23005L8.65505 1.74993Z"
                                                        fill="#08C949" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M12.0238 6.91219L8.84078 10.0952L7.51478 8.76919C7.37405 8.62856 7.18321 8.5496 6.98426 8.54967C6.78531 8.54974 6.59453 8.62884 6.4539 8.76957C6.31327 8.9103 6.2343 9.10113 6.23438 9.30008C6.23445 9.49904 6.31355 9.68981 6.45428 9.83044L8.25728 11.6334C8.33389 11.7101 8.42485 11.7709 8.52497 11.8124C8.62509 11.8539 8.7324 11.8752 8.84078 11.8752C8.94915 11.8752 9.05646 11.8539 9.15658 11.8124C9.2567 11.7709 9.34766 11.7101 9.42428 11.6334L13.0843 7.97269C13.2209 7.83124 13.2965 7.64179 13.2948 7.44514C13.2931 7.2485 13.2142 7.06039 13.0751 6.92133C12.9361 6.78227 12.748 6.7034 12.5513 6.70169C12.3547 6.69998 12.1652 6.77558 12.0238 6.91219Z"
                                                        fill="#F0FCFF" />
                                                </svg>
                                            @elseif ($record->status == 'pending')
                                                <svg width="24" height="24" viewBox="0 0 19 19" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="0.0820312" y="0.322632" width="18" height="18"
                                                        rx="9" fill="#D8D8D8" fill-opacity="0.11"></rect>
                                                    <circle cx="5" cy="5" r="5"
                                                        transform="matrix(-1 0 0 1 14.082 4.32263)" fill="#D8D8D8"></circle>
                                                </svg>
                                            @else
                                                <svg width="24" height="24" viewBox="0 0 19 19" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M8.65505 1.80913C8.92055 1.54399 9.27577 1.38797 9.65064 1.37187C10.0255 1.35576 10.3928 1.48074 10.6801 1.72213L10.7761 1.80988L12.2011 3.23413H14.2156C14.5939 3.2342 14.9582 3.37721 15.2355 3.63451C15.5128 3.89181 15.6827 4.24439 15.7111 4.62163L15.7156 4.73413V6.74863L17.1406 8.17363C17.4059 8.43916 17.5621 8.79454 17.5782 9.16958C17.5943 9.54463 17.4692 9.91208 17.2276 10.1994L17.1398 10.2946L15.7148 11.7196V13.7341C15.7149 14.1126 15.572 14.4771 15.3147 14.7545C15.0574 15.032 14.7047 15.202 14.3273 15.2304L14.2156 15.2341H12.2018L10.7768 16.6591C10.5113 16.9245 10.1559 17.0806 9.78085 17.0967C9.40581 17.1128 9.03836 16.9877 8.75105 16.7461L8.6558 16.6591L7.2308 15.2341H5.21555C4.83712 15.2343 4.47263 15.0913 4.19514 14.834C3.91766 14.5767 3.74769 14.224 3.7193 13.8466L3.71555 13.7341V11.7196L2.29055 10.2946C2.0252 10.0291 1.86905 9.67373 1.85295 9.29868C1.83684 8.92364 1.96194 8.55618 2.20355 8.26888L2.29055 8.17363L3.71555 6.74863V4.73413C3.71562 4.35583 3.85863 3.99152 4.11593 3.7142C4.37323 3.43687 4.72582 3.267 5.10305 3.23863L5.21555 3.23413H7.23005L8.65505 1.80913Z"
                                                        fill="#EA0A0E" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M12.0238 6.9714L8.84078 10.1544L7.51478 8.8284C7.37405 8.68777 7.18321 8.6088 6.98426 8.60887C6.78531 8.60894 6.59453 8.68804 6.4539 8.82877C6.31327 8.9695 6.2343 9.16034 6.23438 9.35929C6.23445 9.55824 6.31355 9.74902 6.45428 9.88965L8.25728 11.6926C8.33389 11.7693 8.42485 11.8301 8.52497 11.8716C8.62509 11.9131 8.7324 11.9344 8.84078 11.9344C8.94915 11.9344 9.05646 11.9131 9.15658 11.8716C9.2567 11.8301 9.34766 11.7693 9.42428 11.6926L13.0843 8.0319C13.2209 7.89045 13.2965 7.70099 13.2948 7.50435C13.2931 7.3077 13.2142 7.11959 13.0751 6.98053C12.9361 6.84148 12.748 6.7626 12.5513 6.76089C12.3547 6.75918 12.1652 6.83478 12.0238 6.9714Z"
                                                        fill="#F0FCFF" />
                                                </svg>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="w-full p-4 px-10 border border-white border-opacity-15 rounded-2xl mb-10">
                        <div class="flex justify-between items-center mb-10">
                            <p class="text-lg">All KYC to be completed</p>
                        </div>

                        <div class="grid lg:grid-cols-3 grid-cols-1 gap-4 w-full">
                            <div class="text-left lg:block flex gap-2">

                                <div class=" mb-3">
                                    <svg width="24" height="24" viewBox="0 0 19 19" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.65505 1.74993C8.92055 1.48478 9.27577 1.32877 9.65064 1.31266C10.0255 1.29656 10.3928 1.42153 10.6801 1.66293L10.7761 1.75068L12.2011 3.17493H14.2156C14.5939 3.175 14.9582 3.31801 15.2355 3.57531C15.5128 3.8326 15.6827 4.18519 15.7111 4.56243L15.7156 4.67493V6.68943L17.1406 8.11443C17.4059 8.37996 17.5621 8.73533 17.5782 9.11038C17.5943 9.48542 17.4692 9.85288 17.2276 10.1402L17.1398 10.2354L15.7148 11.6604V13.6749C15.7149 14.0534 15.572 14.4179 15.3147 14.6953C15.0574 14.9728 14.7047 15.1428 14.3273 15.1712L14.2156 15.1749H12.2018L10.7768 16.5999C10.5113 16.8653 10.1559 17.0214 9.78085 17.0375C9.40581 17.0536 9.03836 16.9285 8.75105 16.6869L8.6558 16.5999L7.2308 15.1749H5.21555C4.83712 15.175 4.47263 15.0321 4.19514 14.7748C3.91766 14.5175 3.74769 14.1648 3.7193 13.7874L3.71555 13.6749V11.6604L2.29055 10.2354C2.0252 9.9699 1.86905 9.61452 1.85295 9.23948C1.83684 8.86443 1.96194 8.49698 2.20355 8.20968L2.29055 8.11443L3.71555 6.68943V4.67493C3.71562 4.29663 3.85863 3.93232 4.11593 3.65499C4.37323 3.37767 4.72582 3.2078 5.10305 3.17943L5.21555 3.17493H7.23005L8.65505 1.74993Z"
                                            fill="#08C949" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.0238 6.91219L8.84078 10.0952L7.51478 8.76919C7.37405 8.62856 7.18321 8.5496 6.98426 8.54967C6.78531 8.54974 6.59453 8.62884 6.4539 8.76957C6.31327 8.9103 6.2343 9.10113 6.23438 9.30008C6.23445 9.49904 6.31355 9.68981 6.45428 9.83044L8.25728 11.6334C8.33389 11.7101 8.42485 11.7709 8.52497 11.8124C8.62509 11.8539 8.7324 11.8752 8.84078 11.8752C8.94915 11.8752 9.05646 11.8539 9.15658 11.8124C9.2567 11.7709 9.34766 11.7101 9.42428 11.6334L13.0843 7.97269C13.2209 7.83124 13.2965 7.64179 13.2948 7.44514C13.2931 7.2485 13.2142 7.06039 13.0751 6.92133C12.9361 6.78227 12.748 6.7034 12.5513 6.70169C12.3547 6.69998 12.1652 6.77558 12.0238 6.91219Z"
                                            fill="#F0FCFF" />
                                    </svg>

                                </div>

                                <p class="inline mb-3 p-0">Account Updated</p>
                            </div>

                            <div class="text-left lg:block flex gap-2">
                                @if ($kyc_records->count() > 0)
                                    <div class=" mb-3">
                                        <svg width="24" height="24" viewBox="0 0 19 19" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M8.65505 1.74993C8.92055 1.48478 9.27577 1.32877 9.65064 1.31266C10.0255 1.29656 10.3928 1.42153 10.6801 1.66293L10.7761 1.75068L12.2011 3.17493H14.2156C14.5939 3.175 14.9582 3.31801 15.2355 3.57531C15.5128 3.8326 15.6827 4.18519 15.7111 4.56243L15.7156 4.67493V6.68943L17.1406 8.11443C17.4059 8.37996 17.5621 8.73533 17.5782 9.11038C17.5943 9.48542 17.4692 9.85288 17.2276 10.1402L17.1398 10.2354L15.7148 11.6604V13.6749C15.7149 14.0534 15.572 14.4179 15.3147 14.6953C15.0574 14.9728 14.7047 15.1428 14.3273 15.1712L14.2156 15.1749H12.2018L10.7768 16.5999C10.5113 16.8653 10.1559 17.0214 9.78085 17.0375C9.40581 17.0536 9.03836 16.9285 8.75105 16.6869L8.6558 16.5999L7.2308 15.1749H5.21555C4.83712 15.175 4.47263 15.0321 4.19514 14.7748C3.91766 14.5175 3.74769 14.1648 3.7193 13.7874L3.71555 13.6749V11.6604L2.29055 10.2354C2.0252 9.9699 1.86905 9.61452 1.85295 9.23948C1.83684 8.86443 1.96194 8.49698 2.20355 8.20968L2.29055 8.11443L3.71555 6.68943V4.67493C3.71562 4.29663 3.85863 3.93232 4.11593 3.65499C4.37323 3.37767 4.72582 3.2078 5.10305 3.17943L5.21555 3.17493H7.23005L8.65505 1.74993Z"
                                                fill="#08C949" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M12.0238 6.91219L8.84078 10.0952L7.51478 8.76919C7.37405 8.62856 7.18321 8.5496 6.98426 8.54967C6.78531 8.54974 6.59453 8.62884 6.4539 8.76957C6.31327 8.9103 6.2343 9.10113 6.23438 9.30008C6.23445 9.49904 6.31355 9.68981 6.45428 9.83044L8.25728 11.6334C8.33389 11.7101 8.42485 11.7709 8.52497 11.8124C8.62509 11.8539 8.7324 11.8752 8.84078 11.8752C8.94915 11.8752 9.05646 11.8539 9.15658 11.8124C9.2567 11.7709 9.34766 11.7101 9.42428 11.6334L13.0843 7.97269C13.2209 7.83124 13.2965 7.64179 13.2948 7.44514C13.2931 7.2485 13.2142 7.06039 13.0751 6.92133C12.9361 6.78227 12.748 6.7034 12.5513 6.70169C12.3547 6.69998 12.1652 6.77558 12.0238 6.91219Z"
                                                fill="#F0FCFF" />
                                        </svg>

                                    </div>
                                @else
                                    <div class=" mb-3">
                                        <svg width="24" height="24" viewBox="0 0 20 21" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.8334 8.29888H9.16675V6.63221H10.8334M10.8334 14.9655H9.16675V9.96555H10.8334M10.0001 2.46555C8.90573 2.46555 7.8221 2.68109 6.81105 3.09988C5.80001 3.51867 4.88135 4.1325 4.10752 4.90632C2.54472 6.46913 1.66675 8.58874 1.66675 10.7989C1.66675 13.009 2.54472 15.1286 4.10752 16.6914C4.88135 17.4653 5.80001 18.0791 6.81105 18.4979C7.8221 18.9167 8.90573 19.1322 10.0001 19.1322C12.2102 19.1322 14.3298 18.2542 15.8926 16.6914C17.4554 15.1286 18.3334 13.009 18.3334 10.7989C18.3334 9.70453 18.1179 8.6209 17.6991 7.60985C17.2803 6.5988 16.6665 5.68014 15.8926 4.90632C15.1188 4.1325 14.2002 3.51867 13.1891 3.09988C12.1781 2.68109 11.0944 2.46555 10.0001 2.46555Z"
                                                fill="#f97316" />
                                        </svg>
                                    </div>
                                @endif
                                <p class="inline mb-3 p-0">KYC Documents Uploaded</p>
                            </div>

                            <div class="text-left lg:block flex gap-2">
                                @if (user()->kyc_verified_at)
                                    <div class=" mb-3">
                                        <svg width="24" height="24" viewBox="0 0 19 19" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M8.65505 1.74993C8.92055 1.48478 9.27577 1.32877 9.65064 1.31266C10.0255 1.29656 10.3928 1.42153 10.6801 1.66293L10.7761 1.75068L12.2011 3.17493H14.2156C14.5939 3.175 14.9582 3.31801 15.2355 3.57531C15.5128 3.8326 15.6827 4.18519 15.7111 4.56243L15.7156 4.67493V6.68943L17.1406 8.11443C17.4059 8.37996 17.5621 8.73533 17.5782 9.11038C17.5943 9.48542 17.4692 9.85288 17.2276 10.1402L17.1398 10.2354L15.7148 11.6604V13.6749C15.7149 14.0534 15.572 14.4179 15.3147 14.6953C15.0574 14.9728 14.7047 15.1428 14.3273 15.1712L14.2156 15.1749H12.2018L10.7768 16.5999C10.5113 16.8653 10.1559 17.0214 9.78085 17.0375C9.40581 17.0536 9.03836 16.9285 8.75105 16.6869L8.6558 16.5999L7.2308 15.1749H5.21555C4.83712 15.175 4.47263 15.0321 4.19514 14.7748C3.91766 14.5175 3.74769 14.1648 3.7193 13.7874L3.71555 13.6749V11.6604L2.29055 10.2354C2.0252 9.9699 1.86905 9.61452 1.85295 9.23948C1.83684 8.86443 1.96194 8.49698 2.20355 8.20968L2.29055 8.11443L3.71555 6.68943V4.67493C3.71562 4.29663 3.85863 3.93232 4.11593 3.65499C4.37323 3.37767 4.72582 3.2078 5.10305 3.17943L5.21555 3.17493H7.23005L8.65505 1.74993Z"
                                                fill="#08C949" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M12.0238 6.91219L8.84078 10.0952L7.51478 8.76919C7.37405 8.62856 7.18321 8.5496 6.98426 8.54967C6.78531 8.54974 6.59453 8.62884 6.4539 8.76957C6.31327 8.9103 6.2343 9.10113 6.23438 9.30008C6.23445 9.49904 6.31355 9.68981 6.45428 9.83044L8.25728 11.6334C8.33389 11.7101 8.42485 11.7709 8.52497 11.8124C8.62509 11.8539 8.7324 11.8752 8.84078 11.8752C8.94915 11.8752 9.05646 11.8539 9.15658 11.8124C9.2567 11.7709 9.34766 11.7101 9.42428 11.6334L13.0843 7.97269C13.2209 7.83124 13.2965 7.64179 13.2948 7.44514C13.2931 7.2485 13.2142 7.06039 13.0751 6.92133C12.9361 6.78227 12.748 6.7034 12.5513 6.70169C12.3547 6.69998 12.1652 6.77558 12.0238 6.91219Z"
                                                fill="#F0FCFF" />
                                        </svg>

                                    </div>
                                @else
                                    <div class=" mb-3">
                                        <svg width="24" height="24" viewBox="0 0 20 21" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.8334 8.29888H9.16675V6.63221H10.8334M10.8334 14.9655H9.16675V9.96555H10.8334M10.0001 2.46555C8.90573 2.46555 7.8221 2.68109 6.81105 3.09988C5.80001 3.51867 4.88135 4.1325 4.10752 4.90632C2.54472 6.46913 1.66675 8.58874 1.66675 10.7989C1.66675 13.009 2.54472 15.1286 4.10752 16.6914C4.88135 17.4653 5.80001 18.0791 6.81105 18.4979C7.8221 18.9167 8.90573 19.1322 10.0001 19.1322C12.2102 19.1322 14.3298 18.2542 15.8926 16.6914C17.4554 15.1286 18.3334 13.009 18.3334 10.7989C18.3334 9.70453 18.1179 8.6209 17.6991 7.60985C17.2803 6.5988 16.6665 5.68014 15.8926 4.90632C15.1188 4.1325 14.2002 3.51867 13.1891 3.09988C12.1781 2.68109 11.0944 2.46555 10.0001 2.46555Z"
                                                fill="#f97316" />
                                        </svg>
                                    </div>
                                @endif
                                <p class="inline mb-3 p-0">KYC Documents Verified</p>
                            </div>
                        </div>

                    </div>
                @endif

                @if (!user()->kyc_verified_at && $kyc_records->where('status', '!=', 'rejected')->count() < 1)
                    <div class="w-full p-4 border border-white border-opacity-15 rounded-2xl mb-10">
                        <div class="flex justify-between items-center mb-5">
                            <p class="text-lg">Start KYC Verification</p>
                        </div>

                        <div class="text-gray-400  rounded p-2 ts-gray-1 h-52 overflow-y-auto pb-10">
                            <h2 class="font-bold">KYC Disclaimer</h2>
                            <div class="font-mono text-sm text-justify">
                                <p class="mb-3">
                                    {{ site('name') }} fully complies with {{ site('country') }}'s and
                                    International
                                    Anti-Money Laundering and Anti-Terrorism Financing Laws . Such legislation is
                                    the
                                    applicable institutional framework on preventing and combating money laundering
                                    and
                                    terrorist financing and incorporates the provisions of Directive (EU) 2015/849,
                                    2018/843 of the European Parliament and of the Council, the Financial Action
                                    Task
                                    Force (FATF) 2012 and US BSA/AML Act.
                                </p>

                                <p class="mb-3">
                                    It is the policy of {{ site('name') }} to prohibit and actively prevent money
                                    laundering and any activity that facilitates money laundering or the funding of
                                    terrorist or criminal activities by complying with all applicable requirements
                                    under
                                    the Bank Secrecy Act (BSA) and its implementing regulations.
                                </p>

                                <p class="mb-3">
                                    Our AML policies, procedures and internal controls are designed to ensure
                                    compliance
                                    with all applicable BSA regulations and FINRA rules and will be reviewed and
                                    updated
                                    on a regular basis to ensure appropriate policies, procedures and internal
                                    controls
                                    are in place to account for both changes in regulations and changes in our
                                    business.
                                    <br>
                                    <b class="font-bold">Rules: 31 C.F.R. § 1023.210; FINRA Rule 3310.</b>
                                </p>

                                <p class="mb-3">
                                    Pursuant to the BSA and its implementing regulations, financial institutions are
                                    required to make certain searches of their records upon receiving an information
                                    request from FinCEN.
                                </p>

                                <p class="mb-3">
                                    We will respond to a Financial Crimes Enforcement Network (FinCEN) request
                                    concerning accounts and transactions (a 314(a) Request) by immediately searching
                                    our
                                    records to determine whether we maintain or have maintained any account for, or
                                    have
                                    engaged in any transaction with, each individual, entity or organization named
                                    in
                                    the 314(a)
                                </p>
                            </div>

                        </div>
                    </div>

                    <div class="w-full p-4 border border-white border-opacity-15 rounded-2xl mb-10">
                        <div class="flex gap-2 items-center mb-10">
                            <img src="{{ asset('/assets/templates/valent/images/icon/kyc_icon.svg') }}" alt="icon">
                            <p class="text-sm">Select your KYC Document type to proceed</p>
                        </div>

                        <div class="p-2">
                            <form action="{{ route('user.kyc.upload') }}" class="mt-5 gen-form"
                                enctype="multipart/form-data" data-action="reload">
                                @csrf
                                <input type="hidden" name="document_type" id="document_type">

                                <div class="w-full grid lg:grid-cols-4 grid-cols-2 lg:gap-10 gap-2 mb-5 mt-5">

                                    <div data-target="national_id" data-value="national id card"
                                        class="bg-black text-white px-6 py-2 rounded-xl border-b-4 border-[#0040BC] lg:text-md text-sm cursor-pointer type">
                                        <div class="relative type_select hidden" id="national_id"></div>
                                        <div class=" px-2 flex item-center justify-center">
                                            National ID Card
                                        </div>
                                    </div>

                                    <div data-target="passport" data-value="passport"
                                        class="bg-black text-white px-6 py-2 rounded-xl hover:border-b-4 border-[#0040BC] lg:text-md text-sm cursor-pointer type">
                                        <div class="relative type_select hidden" id="passport"></div>
                                        <div class=" px-2 flex item-center justify-center">
                                            Int'l Passport
                                        </div>
                                    </div>

                                    <div data-target="voters_card" data-value="voters card"
                                        class="bg-black text-white px-6 py-2 rounded-xl hover:border-b-4 border-[#0040BC] lg:text-md text-sm cursor-pointer type">
                                        <div class="relative type_select hidden" id="voters_card"></div>
                                        <div class=" px-2 flex item-center justify-center">
                                            Voters Card
                                        </div>
                                    </div>

                                    <div data-target="drivers_license" data-value="drivers license"
                                        class="bg-black text-white px-6 py-2 rounded-xl hover:border-b-4 border-[#0040BC] lg:text-md text-sm cursor-pointer type">
                                        <div class="relative type_select hidden" id="drivers_license"></div>
                                        <div class=" px-2 flex item-center justify-center">
                                            Drivers License
                                        </div>
                                    </div>


                                </div>

                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">

                                    <div class="w-full grid grid-cols-1  gap-5 mb-3 kyc-field hidden">
                                        <label for="" class="flex font-medium font-mono items-center space-x-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-purple-500"
                                                fill="currentColor" class="bi bi-1-circle-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM9.283 4.002H7.971L6.072 5.385v1.271l1.834-1.318h.065V12h1.312V4.002Z" />
                                            </svg>
                                            <span>Front ID</span>

                                        </label>
                                        <label
                                            class="h-52 rounded font-medium flex flex-grow justify-center items-center border border-slate-800 hover:border-slate-600 cursor-pointer"
                                            for="front">
                                            <span id="front-preview"
                                                class="uploadIcon rounded w-full h-full  flex justify-center items-center border border-slate-800 hover:border-slate-600"
                                                style="background-image: url({{ asset('assets/images/front-id.png') }}); background-size: cover; background-repeat: no-repeat;">
                                                <span
                                                    class="bg-gray-500 hover:bg-blue-600 border p-2 text-white rounded-full">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </span>
                                        </label>
                                        <input class="hidden" type="file" accept="image/*" name="front"
                                            id="front" data-preview="front-preview">
                                    </div>

                                    <div class="w-full grid grid-cols-1  gap-5 mb-3 kyc-field hidden" id="kyc-field-back">
                                        <label for="" class="flex font-medium font-mono items-center space-x-1">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-purple-500"
                                                fill="currentColor" class="bi bi-2-circle-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM6.646 6.24c0-.691.493-1.306 1.336-1.306.756 0 1.313.492 1.313 1.236 0 .697-.469 1.23-.902 1.705l-2.971 3.293V12h5.344v-1.107H7.268v-.077l1.974-2.22.096-.107c.688-.763 1.287-1.428 1.287-2.43 0-1.266-1.031-2.215-2.613-2.215-1.758 0-2.637 1.19-2.637 2.402v.065h1.271v-.07Z" />
                                            </svg>
                                            <span>Back ID</span>

                                        </label>
                                        <label
                                            class="h-52 rounded font-medium flex flex-grow justify-center items-center border border-slate-800 hover:border-slate-600 cursor-pointer"
                                            for="back">
                                            <span id="back-preview"
                                                class="uploadIcon rounded w-full h-full  flex justify-center items-center border border-slate-800 hover:border-slate-600"
                                                style="background-image: url({{ asset('assets/images/back-id.png') }}); background-size: cover; background-repeat: no-repeat;">
                                                <span
                                                    class="bg-gray-500 hover:bg-blue-600 border p-2 text-white rounded-full">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </span>
                                        </label>
                                        <input class="hidden" type="file" accept="image/*" name="back"
                                            id="back" data-preview="back-preview">
                                    </div>

                                    <div class="w-full grid grid-cols-1  gap-5 mb-3 kyc-field hidden">
                                        <label for="" class="flex font-medium font-mono items-center space-x-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-purple-500"
                                                fill="currentColor" class="bi bi-3-circle-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0Zm-8.082.414c.92 0 1.535.54 1.541 1.318.012.791-.615 1.36-1.588 1.354-.861-.006-1.482-.469-1.54-1.066H5.104c.047 1.177 1.05 2.144 2.754 2.144 1.653 0 2.954-.937 2.93-2.396-.023-1.278-1.031-1.846-1.734-1.916v-.07c.597-.1 1.505-.739 1.482-1.876-.03-1.177-1.043-2.074-2.637-2.062-1.675.006-2.59.984-2.625 2.12h1.248c.036-.556.557-1.054 1.348-1.054.785 0 1.348.486 1.348 1.195.006.715-.563 1.237-1.342 1.237h-.838v1.072h.879Z" />
                                            </svg>
                                            <span>Selfie</span>

                                        </label>

                                        <label
                                            class="w-44 h-52 rounded font-medium flex flex-grow justify-center items-center border border-slate-800 hover:border-slate-600 cursor-pointer"
                                            for="selfie">
                                            <span id="selfie-preview"
                                                class="uploadIcon rounded w-full h-full  flex justify-center items-center border border-slate-800 hover:border-slate-600"
                                                style="background-image: url({{ asset('assets/images/selfie.jpg') }}); background-size: cover; background-repeat: no-repeat;">
                                                <span
                                                    class="bg-gray-500 hover:bg-blue-600 border p-2 text-white rounded-full">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </span>
                                        </label>
                                        <input class="hidden" type="file" accept="image/*" name="selfie"
                                            id="selfie" data-preview="selfie-preview">


                                    </div>
                                </div>


                                <div class="py-6 kyc-field hidden">
                                    <button
                                        type="submit"class="border rounded-full lg:px-10 py-2 px-6 text-lg bg-gradient-to-r from-[#306FE6] to-[#0040BC] hover:text-[#0040BC] hover:bg-gradient-to-r hover:from-[#3F7DF2] hover:via-[#FFFFFF] hover:to-[#09C241] transition delay-100 duration-200 ease-in-out">
                                        Upload Documents </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
    <!--end my profile-->
@endsection

@section('scripts')
    <script>
 
        $(document).ready(function() {
            $(document).on('click', ".type", function(e) {
                // Hide all type_select elements
                $('.type_select').addClass('hidden');

                // Show the selected type
                var target = '#' + $(this).data('target');
                $(target).toggleClass('hidden');

                // Update the document type value
                var type = $(this).data('value');
                $('#document_type').val(type);

                // Hide all KYC fields and conditionally show them
                $('.kyc-field').addClass('hidden');
                if (type === 'passport') {
                    $('.kyc-field').not('#kyc-field-back')
                        .removeClass('hidden')
                        .hide()
                        .fadeIn(2000);
                } else {
                    $('.kyc-field').removeClass('hidden').hide().fadeIn(2000);
                }

                // Remove border-b-4 from all .type elements and add to clicked one
                $('.type').removeClass('border-b-4');
                $(this).addClass('border-b-4');
            });

            // Image preview update
            $(document).on("change", "input[type='file']", function(e) {
                var input = e.target;
                var previewId = $(this).data("preview");

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $("#" + previewId).css({
                            "background-image": "url(" + e.target.result + ")",
                            "background-size": "cover",
                            "background-repeat": "no-repeat",
                            "background-position": "center",
                        });
                    };

                    reader.readAsDataURL(input.files[0]); // Read the image file as a data URL.
                }
            });
        });
    </script>
@endsection

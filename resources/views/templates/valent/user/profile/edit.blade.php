@extends('templates.' . site('template') . '.layouts.user')

@section('css')
    <style>
        .animate_card {
            display: grid;
            place-items: center;
            position: relative;
            background-color: #031A45;
            height: 50px;
            width: 100%;
            border-bottom-right-radius: 1.5rem
                /* 24px */
            ;
            border-bottom-left-radius: 1.5rem
                /* 24px */
            ;
        }

        .animate_card::before {
            position: absolute;
            content: "";
            background: linear-gradient(45deg, #3F7DF2, #FFFFFF, #09C241);
            z-index: -1;
            transition: 0.3s;
            animation: animate 2s linear infinite;
            height: 50px;
            width: 100%;
            border-bottom-right-radius: 1.5rem
                /* 24px */
            ;
            border-bottom-left-radius: 1.5rem
                /* 24px */
            ;
        }

        .animate_card:hover::before {
            height: 55px;
            width: 100%;
            color: linear-gradient(45deg, #3F7DF2, #FFFFFF, #09C241);
        }

        @keyframes animate {
            0% {
                filter: hue-rotate(0deg);
            }

            50% {
                filter: hue-rotate(180deg);
            }

            100% {
                filter: hue-rotate(360deg);
            }
        }
    </style>
@endsection

@section('contents')
    <!--my profile-->
    <div class="w-full py-6" id="refresh">
        <div class="lg:max-w-screen-xl mx-auto lg:p-4 mb-3 text-white">

            <div class="block mb-3">
                <h1 class="text-xl lg:text-3xl font-bold">Edit Profile</h1>
            </div>

            <div class="lg:flex justify-between items-center mb-5 py-5">
                <div class="mb-3 block p-2">
                    <div class="flex gap-4">
                        <button id="editProfileBtn"
                            class="bg-black text-white px-6 py-2 rounded-xl border-b-4 border-[#0040BC] lg:text-md text-sm">Edit
                            Profile</button>
                        <button id="securityBtn"
                            class="bg-black text-white px-6 py-2 rounded-xl hover:border-b-4 border-[#0040BC] lg:text-md text-sm">Security</button>
                    </div>
                </div>

                <div class="mb-3 block p-2">
                    <button id="saveChangesBtn"
                        class="border rounded-full lg:px-10 pdx-5 lg:py-4 py-2 px-6 text-lg bg-gradient-to-r from-[#306FE6] to-[#0040BC] hover:text-[#0040BC] hover:bg-gradient-to-r hover:from-[#3F7DF2] hover:via-[#FFFFFF] hover:to-[#09C241] transition delay-100 duration-200 ease-in-out">Save
                        Changes</button>
                </div>

            </div>


            <div id="editProfile"
                class="block bg-gray-200 bg-opacity-10 border border-opacity-45 border-white rounded-t-2xl overflow-auto w-full p-6 mb-3">

                <div class="w-full p-4 lg:px-10 border border-white border-opacity-15 rounded-2xl mb-10">
                    <div class="flex justify-between items-center mb-10">
                        <p class="text-lg">Update Profile Information</p>
                    </div>

                    <div class="lg:flex gap-6 items-center justify-center">
                        <div class="block text-center mb-6 lg:w-[300px]">
                            {{-- <form action="{{ route('user.profile.photo') }}" class="mt-5 gen-form"
                                enctype="multipart/form-data">
                                @csrf
                                <img src="{{ asset('storage/profile/' . user()->photo) }}" alt="icon"
                                    class="w-[200px] h-[200px] mb-4 mx-auto rounded-full">

                                <button type="button">
                                    <label for="profile_photo" id="selectProfilePhoto"
                                        class="flex gap-2 justify-center mx-auto text-end rounded-full bg-white bg-opacity-15 py-1 px-6 text-sm">
                                        <img src="{{ asset('/assets/templates/valent/images/icon/pen_edit_icon.svg') }}"
                                            alt="icon">
                                        <span class=" text-white">Edit</span>
                                    </label>
                                </button>

                                <input type="file" name="photo" id="profile_photo" accept="image/*" hidden>

                                <button type="submit"
                                    class="hidden mx-auto text-end rounded-full bg-white bg-opacity-15 py-1 px-6 text-sm">
                                    <span class=" text-white">Save</span>
                                </button>
                            </form> --}}

                            <form action="{{ route('user.profile.photo') }}" method="POST" enctype="multipart/form-data"
                                class="mt-5 gen-form">
                                @csrf

                                <!-- Profile Image -->
                                <img id="profileImage" src="{{ asset('storage/profile/' . user()->photo) }}"
                                    alt="Profile Photo" class="w-[200px] h-[200px] mb-4 mx-auto rounded-full">

                                <!-- Hidden File Input -->
                                <input type="file" name="photo" id="profile_photo" accept="image/*" hidden>

                                <div class="flex gap-2 justify-center">
                                    <!-- Edit Button (Triggers File Input) -->
                                    <button type="button" id="selectProfilePhoto">
                                        <label
                                            class="flex gap-2 justify-center mx-auto text-end rounded-full bg-white bg-opacity-15 
                                                  py-1 px-6 text-sm cursor-pointer">
                                            <img src="{{ asset('/assets/templates/valent/images/icon/pen_edit_icon.svg') }}"
                                                alt="Edit Icon">
                                            <span class="text-white">Edit</span>
                                        </label>
                                    </button>

                                    <!-- Save Button (Initially Hidden) -->
                                    <button type="submit"
                                        class="hidden mx-auto text-end rounded-full bg-blue-600 hover:bg-[#1252CC] py-1 px-6 text-sm">
                                        <span class="text-white">Save</span>
                                    </button>
                                </div>
                            </form>



                        </div>

                        <div class="block w-full">
                            <form action="{{ route('user.profile.edit-validate') }}" class="mt-5 gen-form">
                                @csrf

                                <div class="w-full mb-10">
                                    <fieldset class="border px-4 py-1 rounded-2xl">
                                        <legend class="px-3 mx-8 text-white"><label class="text-white text-sm">Name
                                                {!! is_required('name') !!}</label></legend>
                                        <div class="w-full text-white flex gap-4">
                                            <img src="{{ asset('/assets/templates/valent/images/icon/user_icon_gradient.svg') }}"
                                                alt="icon">
                                            <div class="w-full">
                                                <input type="text" name="name" id="name"
                                                    class="w-full p-2 bg-transparent text-white border-0 focus:outline-none flex-1"
                                                    placeholder="Enter Fullname" value="{{ old('name') ?? user()->name }}"
                                                    {!! is_required('name', false) !!}>
                                            </div>
                                        </div>
                                        <span class="text-sm text-[#EA0A0E]">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </fieldset>
                                </div>

                                <div class="w-full mb-10">
                                    <fieldset class="border px-4 py-1 rounded-2xl">
                                        <legend class="px-3 mx-8 text-white"><label class="text-white text-sm">Email
                                                {!! is_required('email') !!}</label></legend>
                                        <div class="w-full text-white flex gap-4">
                                            <img src="{{ asset('/assets/templates/valent/images/icon/user_icon_gradient.svg') }}"
                                                alt="icon">
                                            <div class="w-full">
                                                <input type="email" name="email" id="email"
                                                    class="w-full p-2 bg-transparent text-white border-0 focus:outline-none flex-1"
                                                    placeholder="user@user.com" value="{{ old('email') ?? user()->email }}"
                                                    disabled {!! is_required('email', false) !!}>
                                            </div>
                                        </div>
                                        <span class="text-sm text-[#EA0A0E]">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </fieldset>
                                </div>

                                <div class="w-full mb-10">
                                    <fieldset class="border px-4 py-1 rounded-2xl">
                                        <legend class="px-3 mx-8 text-white"><label class="text-white text-sm">Phone Number
                                                {!! is_required('phone') !!}</label></legend>
                                        <div class="w-full text-white flex gap-4">
                                            <img src="{{ asset('/assets/templates/valent/images/icon/user_icon_gradient.svg') }}"
                                                alt="icon">
                                            <div class="w-full">
                                                <input type="number" name="phone" id="phone"
                                                    class="w-full p-2 bg-transparent text-white border-0 focus:outline-none flex-1"
                                                    placeholder="4494895984" value="{{ old('phone') ?? user()->phone }}"
                                                    {!! is_required('phone', false) !!}>
                                            </div>
                                        </div>
                                        <span class="text-sm text-[#EA0A0E]">
                                            @error('phone')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </fieldset>
                                </div>

                                <div class="w-full mb-10">
                                    <fieldset class="border px-4 py-1 rounded-2xl">
                                        <legend class="px-3 mx-8 text-white"><label class="text-white text-sm">Username
                                                {!! is_required('username') !!}</label></legend>
                                        <div class="w-full text-white flex gap-4">
                                            <img src="{{ asset('/assets/templates/valent/images/icon/user_icon_gradient.svg') }}"
                                                alt="icon">
                                            <div class="w-full">
                                                <input type="text" name="username" id="username"
                                                    class="w-full p-2 bg-transparent  text-white border-0 focus:outline-none flex-1"
                                                    placeholder="Username"
                                                    value="{{ old('username') ?? user()->username }}"
                                                    @if (user()->username) disabled @endif
                                                    {!! is_required('username', false) !!}>
                                            </div>
                                        </div>
                                        <span class="text-sm text-[#EA0A0E]">
                                            @error('username')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </fieldset>
                                </div>

                                <div class="lg:grid grid-cols-3 gap-6">

                                    <div class="w-full mb-10">
                                        <fieldset class="border px-4 py-1 rounded-2xl">
                                            <legend class="px-3 mx-8 text-white"><label class="text-white text-sm">Address
                                                    {!! is_required('address') !!}</label></legend>
                                            <div class="w-full text-white flex gap-4">
                                                <img src="{{ asset('/assets/templates/valent/images/icon/user_icon_gradient.svg') }}"
                                                    alt="icon">
                                                <div class="w-full">
                                                    <input type="text" name="address" id="address"
                                                        class="w-full p-2 bg-transparent text-white border-0 focus:outline-none flex-1"
                                                        placeholder="City Address"
                                                        value="{{ old('address') ?? user()->address }}"
                                                        {!! is_required('address', false) !!}>
                                                </div>
                                            </div>
                                            <span class="text-sm text-[#EA0A0E]">
                                                @error('address')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </fieldset>
                                    </div>

                                    <div class="w-full mb-10">
                                        <fieldset class="border px-4 py-1 rounded-2xl">
                                            <legend class="px-3 mx-8 text-white"><label class="text-white text-sm">City
                                                    {!! is_required('city') !!}</label></legend>
                                            <div class="w-full text-white flex gap-4">
                                                <img src="{{ asset('/assets/templates/valent/images/icon/user_icon_gradient.svg') }}"
                                                    alt="icon">
                                                <div class="w-full">
                                                    <input type="text" name="city" id="city"
                                                        class="w-full p-2 bg-transparent text-white border-0 focus:outline-none flex-1"
                                                        placeholder="City" value="{{ old('city') ?? user()->city }}"
                                                        {!! is_required('city', false) !!}>
                                                </div>
                                            </div>
                                            <span class="text-sm text-[#EA0A0E]">
                                                @error('city')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </fieldset>
                                    </div>

                                    <div class="w-full mb-10">
                                        <fieldset class="border px-4 py-1 rounded-2xl">
                                            <legend class="px-3 mx-8 text-white"><label class="text-white text-sm">Country
                                                    {!! is_required('country') !!}<label></legend>
                                            <div class="w-full text-white flex gap-4">
                                                <img src="{{ asset('/assets/templates/valent/images/icon/user_icon_gradient.svg') }}"
                                                    alt="icon">
                                                <div class="w-full">

                                                    <select type="country" name="country" placeholder="Country"
                                                        id="country"
                                                        class="w-full p-2 custom-select bg-transparent text-white border-0 focus:outline-none flex-1"
                                                        {!! is_required('country', false) !!}>
                                                        <option disabled @if (!old('country') || !user()->country) selected @endif>
                                                            Select Country
                                                        </option>
                                                        @foreach (countries() as $country)
                                                            <option value="{{ $country->english_name }}"
                                                                @if (old('country') ?? user()->country == $country->english_name) selected @endif>
                                                                {{ $country->english_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <span class="text-sm text-[#EA0A0E]">
                                                @error('country')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </fieldset>
                                    </div>

                                    <div class="w-full mb-10">
                                        <fieldset class="border px-4 py-1 rounded-2xl">
                                            <legend class="px-3 mx-8 text-white"><label class="text-white text-sm">State
                                                    {!! is_required('state') !!}</label></legend>
                                            <div class="w-full text-white flex gap-4">
                                                <img src="{{ asset('/assets/templates/valent/images/icon/user_icon_gradient.svg') }}"
                                                    alt="icon">
                                                <div class="w-full">
                                                    <input type="text" name="state" id="state"
                                                        class="w-full p-2 bg-transparent text-white border-0 focus:outline-none flex-1"
                                                        placeholder="State" value="{{ old('state') ?? user()->state }}"
                                                        {!! is_required('state', false) !!}>
                                                </div>
                                            </div>
                                            <span class="text-sm text-[#EA0A0E]">
                                                @error('state')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </fieldset>
                                    </div>

                                    <div class="w-full mb-10">
                                        <fieldset class="border px-4 py-1 rounded-2xl">
                                            <legend class="px-3 mx-8 text-white"><label class="text-white text-sm">Date of
                                                    birth {!! is_required('dob') !!}</label></legend>
                                            <div class="w-full text-white flex gap-4">
                                                <img src="{{ asset('/assets/templates/valent/images/icon/user_icon_gradient.svg') }}"
                                                    alt="icon">
                                                <div class="w-full">
                                                    <input type="date" name="dob" id="dob"
                                                        class="w-full p-2 bg-transparent text-white border-0 focus:outline-none flex-1"
                                                        placeholder="12/07/2025" value="{{ old('dob') ?? user()->dob }}"
                                                        {!! is_required('dob', false) !!}>
                                                </div>
                                            </div>
                                            <span class="text-sm text-[#EA0A0E]">
                                                @error('dob')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </fieldset>
                                    </div>

                                    <div class="w-full mb-10">
                                        <fieldset class="border px-4 py-1 rounded-2xl">
                                            <legend class="px-3 mx-8 text-white"><label class="text-white text-sm">Gender
                                                    {!! is_required('gender') !!}</label></legend>
                                            <div class="w-full text-white flex gap-4">
                                                <img src="{{ asset('/assets/templates/valent/images/icon/user_icon_gradient.svg') }}"
                                                    alt="icon">
                                                <div class="w-full">
                                                    <select name="gender" placeholder="Gender" id="gender"
                                                        class="w-full p-2 custom-select bg-transparent text-white border-0 focus:outline-none flex-1"
                                                        {!! is_required('gender', false) !!}>
                                                        <option disabled @if (!old('gender') || !user()->gender) selected @endif>
                                                            Select Gender
                                                        </option>
                                                        <option value="male"
                                                            @if (old('gender') ?? user()->gender == 'male') selected @endif>Male
                                                        </option>
                                                        <option value="female"
                                                            @if (old('gender') ?? user()->gender == 'female') selected @endif>Female
                                                        </option>
                                                        <option value="neutral"
                                                            @if (old('gender') ?? user()->gender == 'neutral') selected @endif>Neutral
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <span class="text-sm text-[#EA0A0E]">
                                                @error('gender')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </fieldset>
                                    </div>

                                </div>

                                <button type="submit" id="submitUpdateBtn" class="text-blue-500"></button>

                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div id="editProfileSecurity" class="hidden">
                <div class="lg:flex gap-6">

                    <div id="password_update"
                        class="block mb-6 bg-gray-200 bg-opacity-10 border border-opacity-45 border-white rounded-b-3xl w-full relative">

                        <form action="{{ route('user.profile.password') }}"
                            class="relative flex flex-col h-full gen-form">
                            @csrf

                            <div class="flex-grow mb-10 p-6">
                                <div class="w-full p-4 lg:px-10 border border-white border-opacity-15 rounded-2xl">
                                    <div class="flex justify-between items-center mb-10">
                                        <p class="text-lg">Update Password</p>
                                    </div>

                                    <div class="block w-full">
                                        <!-- Current Password -->
                                        <div class="w-full mb-10">
                                            <fieldset class="border px-4 py-1 rounded-2xl">
                                                <legend class="px-3 mx-8 text-white">
                                                    <label class="text-white text-sm">Current Password</label>
                                                </legend>
                                                <div class="w-full text-white flex gap-4">
                                                    <img src="{{ asset('/assets/templates/valent/images/icon/user_icon_gradient.svg') }}"
                                                        alt="icon">
                                                    <div class="w-full">
                                                        <input type="password" name="current_password"
                                                            id="current_password"
                                                            class="w-full p-2 bg-transparent text-white border-0 focus:outline-none flex-1"
                                                            placeholder="Input previous password" required>
                                                    </div>
                                                </div>
                                                <span class="text-sm text-[#EA0A0E]">
                                                    @error('current_password')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </fieldset>
                                        </div>

                                        <!-- New Password -->
                                        <div class="w-full mb-10">
                                            <fieldset class="border px-4 py-1 rounded-2xl">
                                                <legend class="px-3 mx-8 text-white">
                                                    <label class="text-white text-sm">New Password</label>
                                                </legend>
                                                <div class="w-full text-white flex gap-4">
                                                    <img src="{{ asset('/assets/templates/valent/images/icon/user_icon_gradient.svg') }}"
                                                        alt="icon">
                                                    <div class="w-full">
                                                        <input type="password" name="password" id="password"
                                                            class="w-full p-2 bg-transparent text-white border-0 focus:outline-none flex-1"
                                                            placeholder="Input new password" required>
                                                    </div>
                                                </div>
                                                <span class="text-sm text-[#EA0A0E]">
                                                    @error('password')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </fieldset>
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="w-full mb-10">
                                            <fieldset class="border px-4 py-1 rounded-2xl">
                                                <legend class="px-3 mx-8 text-white">
                                                    <label class="text-white text-sm">Confirm Password</label>
                                                </legend>
                                                <div class="w-full text-white flex gap-4">
                                                    <img src="{{ asset('/assets/templates/valent/images/icon/user_icon_gradient.svg') }}"
                                                        alt="icon">
                                                    <div class="w-full">
                                                        <input type="password" name="password_confirmation"
                                                            id="password_confirmation"
                                                            class="w-full p-2 bg-transparent text-white border-0 focus:outline-none flex-1"
                                                            placeholder="Confirm password">
                                                    </div>
                                                </div>
                                                <span class="text-sm text-[#EA0A0E]">
                                                    @error('password_confirmation')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Save Changes Button -->
                            <button type="submit"
                                class="h-12 mt-auto w-full p-2 rounded-b-3xl text-lg bg-gradient-to-r from-[#306FE6] to-[#0040BC] hover:text-[#0040BC] hover:bg-gradient-to-r hover:from-[#3F7DF2] hover:via-[#FFFFFF] hover:to-[#09C241] transition delay-100 duration-200 ease-in-out flex items-center justify-center">
                                Save Changes
                            </button>
                        </form>
                    </div>

                    @if (user()->g2fa == 0)
                        <div id="enable_2fa_update"
                            class="block mb-6 bg-gray-200 bg-opacity-10 border border-opacity-45 border-white rounded-b-3xl w-full">
                            <form action="{{ route('user.profile.g2fa') }}" class="relative h-full gen-form"
                                data-action="reload">
                                @csrf

                                <div class="mb-10 p-6">
                                    <div class="w-full p-4 lg:px-10 rounded-2xl">
                                        <div class="flex justify-between items-center mb-10">
                                            <p class="text-lg">Enable 2FA</p>
                                        </div>

                                        <div class="block w-full">

                                            <div class="flex w-full justify-center mb-10">
                                                <div class="bg-blue-100 rounded-xl bg-opacity-20 p-2">
                                                    <div id="wallet_qrcode" class="clipboard" data-copy=""></div>
                                                </div>
                                            </div>

                                            <div class="w-full mb-4">
                                                <fieldset class="border px-4 py-1 rounded-2xl">
                                                    <legend class="px-3 mx-8 text-white"><label
                                                            class="text-white text-sm">2FA
                                                            Code *</label></legend>
                                                    <div class="w-full text-white flex gap-4">
                                                        <img src="{{ asset('/assets/templates/valent/images/icon/user_icon_gradient.svg') }}"
                                                            alt="icon">
                                                        <div class="w-full">
                                                            <input type="text" name="one_time_password"
                                                                id="one_time_password"
                                                                class="w-full p-2 bg-transparent text-white border-0 focus:outline-none flex-1"
                                                                placeholder="Input here" required>
                                                        </div>
                                                    </div>
                                                    <span class="text-sm text-[#EA0A0E]">
                                                        @error('one_time_password')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </fieldset>
                                            </div>
                                            <div class="w-full mb-4">
                                                <p class="text-white text-sm mb-3">Scan the QRCode above or copy the 2FA
                                                    Code below to set up your 2fa</p>
                                                <p
                                                    class="text-center text-gray-400 flex gap-3 items-center justify-center overflow-hidden copy-icon">
                                                    <img src="{{ asset('/assets/templates/valent/images/icon/copy_icon.svg') }}"
                                                        alt="icon" class="copy-icon clipboard"
                                                        data-copy="{{ user()->g2fa_secret }}" style="cursor: pointer;">
                                                    <span id="2fa_code"
                                                        class="lg:text-lg">{{ user()->g2fa_secret }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button class="absolute bottom-0 w-full p-2 text-lg border rounded-b-3xl animate_card">Save
                                    Changes</button>

                            </form>
                        </div>
                    @else
                        <div id="disable_2fa_update" class="w-full">
                            <div
                                class="block bg-gray-200 bg-opacity-10 border border-opacity-45 border-white rounded-b-3xl w-full h-auto">
                                <form action="{{ route('user.profile.g2fa') }}" class="relative h-full gen-form"
                                    data-action="reload">
                                    @csrf

                                    <div class="mb-10 p-6">
                                        <div class="w-full p-4 lg:px-10 rounded-2xl">
                                            <div class="flex justify-between items-center mb-10">
                                                <p class="text-lg">2FA</p>
                                            </div>

                                            <div class="block w-full">

                                                <div class="w-full mb-4">
                                                    <fieldset class="border px-4 py-1 rounded-2xl">
                                                        <legend class="px-3 mx-8 text-white"><label
                                                                class="text-white text-sm">2FA Code *</label></legend>
                                                        <div class="w-full text-white flex gap-4">
                                                            <img src="{{ asset('/assets/templates/valent/images/icon/user_icon_gradient.svg') }}"
                                                                alt="icon">
                                                            <div class="w-full">
                                                                <input type="text" name="one_time_password"
                                                                    id="one_time_password"
                                                                    class="w-full p-2 bg-transparent text-white border-0 focus:outline-none flex-1"
                                                                    placeholder="Input here" required>
                                                            </div>
                                                        </div>
                                                        <span class="text-sm text-[#EA0A0E]">
                                                            @error('one_time_password')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                    </fieldset>
                                                </div>

                                                <p class="text-white text-sm mb-3">Enter the One time passcode from your
                                                    google authenticator app to disable your g2fa</p>

                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit"
                                        class="absolute bottom-0 w-full p-2 text-lg border rounded-b-3xl animate_card">Disable
                                        2FA</button>

                                </form>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
    <!--end my profile-->
@endsection

@section('scripts')
    @if (user()->g2fa == 0)
        <script>
            $(document).ready(function() {
                // create qrcode
                var qrCodeElement = document.getElementById('wallet_qrcode');
                var text = "{{ $qr_code_url }}";
                var qrCode = new QRCode(qrCodeElement, {
                    text: text,
                    width: 200,
                    height: 200
                });

                var walletQrCodeDiv = document.getElementById('wallet_qrcode');
                walletQrCodeDiv.classList.add('disabled');
                var imageElement = walletQrCodeDiv.querySelector('img');
                imageElement.classList.add('rounded-lg', 'border', 'border-slate-800',
                    'hover:border-slate-600', 'cursor-pointer', 'p-1');
            });
        </script>
    @endif

    <script>
        function initializeProfileTabs() {
            //console.log("Profile Tabs Initialized");

            // Handle Profile Tab Click
            $(document).off("click", "#editProfileBtn").on("click", "#editProfileBtn", function() {
                $("#editProfile").slideDown().removeClass("hidden");
                $("#editProfileSecurity").slideUp().addClass("hidden");
                $("#saveChangesBtn").slideDown().removeClass("hidden");

                $("#securityBtn").removeClass("border-b-4");
                $("#editProfileBtn").addClass("border-b-4");
            });

            // Handle Security Tab Click
            $(document).off("click", "#securityBtn").on("click", "#securityBtn", function() {
                $("#editProfileSecurity").slideDown().removeClass("hidden");
                $("#editProfile").slideUp().addClass("hidden");
                $("#saveChangesBtn").slideUp().addClass("hidden");

                $("#editProfileBtn").removeClass("border-b-4");
                $("#securityBtn").addClass("border-b-4");
            });
        }

        // Run profile tab initialization on page load
        $(document).ready(function() {
            initializeProfileTabs();
        });

        //////////// submit update
        $(document).on("click", "#saveChangesBtn", function() {
            $("#submitUpdateBtn").trigger("click"); // Triggers the submit button programmatically
        });
    </script>

    <script>
        $(document).ready(function() {
            // Open file input when clicking on the "Edit" button
            $("#selectProfilePhoto").on("click", function() {
                $("#profile_photo").trigger("click");
            });

            // When a new file is selected, update the profile image preview
            $("#profile_photo").on("change", function(event) {
                var input = event.target;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $("#profileImage").attr("src", e.target.result); // Update image preview
                        $("button[type='submit']").removeClass("hidden").fadeIn(); // Show Save button
                    };

                    reader.readAsDataURL(input.files[0]); // Read the selected image
                }
            });
        });
    </script>
@endsection

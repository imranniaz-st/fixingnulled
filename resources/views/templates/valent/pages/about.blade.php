@php
    
    $page_title = 'About ' . site('name');
    $short_description = site('name') . ' uses advanced Ai robots trained on extensive trading data and algorithms to analyze market trends and execute profitable trades with high precision.';
    
@endphp

{{-- layout --}}
@extends('templates.'. site('template') .'.layouts.front')

@section('css')
    
@endsection

@section('header')
<div class="w-[90%] mx-auto lg:h-[545px] h-[30vh] flex items-center justify-center overflow-hidden">
    <div class="max-w-screen-lg text-center lg:mt-20 mt-32 lg:py-0 py-10" data-aos="fade-up">
      <p class="text-white font-light lg:text-9xl text-2xl lg:mb-3 lg:mt-44"><span class="font-bold">About</span> Us</p>
      <p class="lg:text-2xl text-lg text-white font-extralight" style="font-family: 'Noto Sans', sans-serif; font-weight: 100; "> 
        <a href="" class="text-[#D8D8D8] text-opacity-45">Home</a> / <a href="">About Us</a>
      </p>
    </div>
  </div>
@endsection


@section('contents')
{{-- welcome --}}
<section class="w-full mb-10 lg:bg-cover lg:bg-center bg-local lg:bg-[url(../../assets/images/frame_background.png)]" data-aos="fade-up">
    <div class="w-[90%] mx-auto py-20">
      <div class="flex justify-end items-center lg:h-[130vh]">
        <div class="flex-1 justify-end items-center">
          <p class="text-[#B4B1B1] lg:text-right text-center">Revolutionizing the World of Trading</p>
          <p class="text-[#3F7DF2] lg:text-5xl text-2xl lg:mb-3 lg:text-right text-center">Welcome to</p>
          <p class="text-white font-bold lg:text-7xl text-4xl lg:mb-3 lg:text-right text-center">{{ site('name') }} </p>
          <div class="flex justify-end">
            <p class="text-white lg:text-2xl text-lg leading-relaxed max-w-xl lg:text-right text-center lg:py-14 py-6" style="font-family: 'Noto Sans', sans-serif; font-weight: 100; ">At {{ site('name') }} we are pioneers in the world of financial technology. Our mission is to empower traders, both novice and seasoned, with a powerful yet user-friendly platform that simplifies the complexities of trading. With our advanced AI robots, extensively trained on extensive trading data and cutting-edge algorithms, we offer an unparalleled trading experience.</p>
          </div>
          <div class="flex lg:justify-end justify-center gap-10 py-3 text-center">
            <a href="{{ route('user.register') }}" class="border lg:w-52 rounded-full lg:py-4 py-2 px-10 block text-center text-white text-lg  bg-gradient-to-r from-[#306FE6] via-[#3b82f6] to-[#0040BC] hover:text-[#0040BC] hover:bg-gradient-to-r hover:from-[#3F7DF2] hover:via-[#FFFFFF] hover:to-[#09C241] transition delay-100 duration-200 ease-in-out">Sign Up</a>
            <a href="{{ route('user.login') }}" class="border rounded-full lg:py-4 py-2 px-10 block text-center text-white text-lg animate_card ">Login</a>
          </div>
        </div>
      </div>
    </div>      
</section>

  {{-- about --}}
  <section class="w-full mb-10" data-aos="fade-up">
    <div class="w-[90%] mx-auto py-10">
      <div class="grid lg:grid-cols-2 grid-cols-1">
        <div class="col-span-1">
            <p class="text-[#B4B1B1] lg:text-left text-center">Know Us</p>
            <p class="text-[#3F7DF2] lg:text-5xl text-2xl lg:mb-3 lg:text-left text-center">About</p>
            <p class="text-white font-bold lg:text-7xl text-4xl lg:mb-3 lg:text-left text-center">{{ site('name') }} </p>
            <p class="text-[#B4B1B1] lg:text-2xl text-lg leading-relaxed max-w-xl lg:text-left text-center lg:py-14 py-6">{{ $short_description }}</p>
        </div>
        <div class="col-span-1 flex justify-end">
          <img src="{{ asset('/assets/templates/valent/images/vecteezy_big-golden-bitcoin-coin-stand-on-neon-pink-and-blue-business_255502781.png') }}" alt="img" class="lg:w-auto w-1/2 mx-auto  animate-pulse">
        </div>
      </div>
    </div>      
  </section>

  {{-- experience --}}
  <section class="w-full mb-10" data-aos="fade-up">
    <img src="{{ asset('/assets/templates/valent/images/robot_on-mouse.png') }}" alt="crypto" class="absolute left-0 lg:block hidden -z-10 animate-pulse">
    <div class="w-[90%] mx-auto py-10">
      <div class="flex justify-end items-center lg:h-[80vh]">
        <div class="flex-1 justify-end items-center">
          <p class="text-[#B4B1B1] lg:text-right text-center">Experienced Minds at Work</p>
          <p class="bg-gradient-to-r from-[#3F7DF2] lg:from-[80%] via-[#09C241] lg:via-[90%] to-white lg:to-[95%] to-[70%] bg-clip-text text-transparent lg:text-5xl text-2xl lg:mb-3 lg:text-right text-center">The Team At</p>
          <p class="text-white font-bold lg:text-7xl text-4xl lg:mb-3 lg:text-right text-center">{{ site('name') }} </p>
          <div class="flex justify-end">
            <p class="text-white lg:text-2xl text-lg leading-relaxed max-w-xl lg:text-right text-center lg:py-14 py-6" style="font-family: 'Noto Sans', sans-serif; font-weight: 100; ">At {{ site('name') }} we are pioneers in the world of financial technology. Our mission is to empower traders, both novice and seasoned, with a powerful yet user-friendly platform that simplifies the complexities of trading. With our advanced AI robots, extensively trained on extensive trading data and cutting-edge algorithms, we offer an unparalleled trading experience.</p>
          </div>
        </div>
      </div>
    </div>      
  </section>

  {{-- tech behind --}}
  <section class="w-full mb-10" data-aos="fade-up">
    <img src="{{ asset('/assets/templates/valent/images/tech_behind_ai.png') }}" alt="crypto" class="absolute right-0 lg:block hidden -z-10 animate-pulse">
    <div class="w-[90%] mx-auto py-10">
      <div class="flex justify-start items-center lg:h-[80vh]">
        <div class="col-span-1">
          <p class="text-[#B4B1B1] lg:text-left text-center">Revolutionizing the World of Trading</p>
          <p class="bg-gradient-to-r from-[#3F7DF2] slg:from-[80%] via-[#09C241] lsg:via-[90%] to-white slg:to-[95%] to-[70%] bg-clip-text text-transparent lg:text-5xl text-2xl lg:mb-3 lg:text-left text-center">The Technology Behind</p>
          <p class="text-white font-bold lg:text-7xl text-4xl lg:mb-3 lg:text-left text-center">{{ site('name') }} </p>
          <p class="text-[#B4B1B1] lg:text-2xl text-lg leading-relaxed max-w-xl lg:text-left text-center lg:py-14 py-6">{{ site('name') }} uses advanced Ai robots trained on extensive trading data and algorithms to analyze market trends and execute profitable trades with high precision.</p>
        </div>
      </div>
    </div>      
  </section>

  {{-- integrity --}}
  <section class="w-full mb-10" data-aos="fade-up">
    <img src="{{ asset('/assets/templates/valent/images/integrity_transparent_img.png') }}" alt="crypto" class="absolute left-0 lg:block hidden -z-10 animate-pulse">
    <div class="w-[90%] mx-auto py-10">
      <div class="flex justify-end items-center lg:h-[70vh]">
        <div class="flex-1 justify-end items-center">
          <p class="text-[#B4B1B1] lg:text-right text-center">Experienced Minds at Work</p>
          <p class="bg-gradient-to-r from-[#3F7DF2] lg:from-[80%] via-[#09C241] lg:via-[90%] to-white lg:to-[95%] to-[70%] bg-clip-text text-transparent lg:text-5xl text-2xl lg:mb-3 lg:text-right text-center">Upholding Values of</p>
          <p class="text-white font-bold lg:text-7xl text-4xl lg:mb-3 lg:text-right text-center">Integrity and Transparency </p>
          <div class="flex justify-end">
            <p class="text-white lg:text-2xl text-lg leading-relaxed max-w-screen-lg lg:text-right text-center lg:py-14 py-6" style="font-family: 'Noto Sans', sans-serif; font-weight: 100; ">Behind every successful technology is a team of dedicated experts. Our team is a fusion of seasoned traders, data scientists, and technologists who bring a wealth of knowledge and experience. We work tirelessly to ensure {{ site('name') }} remains a frontrunner in the field.</p>
          </div>
        </div>
      </div>
    </div>      
  </section>

  {{-- connecting --}}
  <section class="w-full" data-aos="fade-up">
    <img src="{{ asset('/assets/templates/valent/images/cyborg-hand-finger-moving-artificial-intelligence-dexterous-robot1.png') }}" alt="crypto" class="absolute right-0 lg:block hidden z-10 animate-pulse">
    <div class="w-full lg:pt-20">
      <div class="lg:h-[50vh] bg-[#fff] bg-opacity-10">
        <div class="w-[90%] mx-auto py-10">
          <div class="flex justify-start items-center">
            <div class="col-span-1">
              <p class="text-[#B4B1B1] lg:text-left text-center">Connecting with</p>
              <p class="bg-gradient-to-r from-[#3F7DF2] slg:from-[80%] via-[#09C241] lsg:via-[90%] to-white slg:to-[95%] to-[70%] bg-clip-text text-transparent lg:text-5xl text-2xl lg:mb-3 lg:text-left text-center">The Technology Behind</p>
              <p class="text-white font-bold lg:text-7xl text-4xl lg:mb-3 lg:text-left text-center">{{ site('name') }} </p>
              <p class="text-[#B4B1B1] lg:text-2xl text-lg leading-relaxed max-w-screen-lg lg:text-left text-center lg:py-14 py-6">With {{ site('name') }}, you're not just trading; you're part of a revolutionary movement in the world of finance. Join us today and experience the future of trading - where innovation, technology, and your success converge.</p>
            </div>
          </div>
        </div> 
      </div>     
    </div>
  </section>
@endsection

@section('scripts')

@endsection

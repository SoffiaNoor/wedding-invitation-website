<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Nabiilah & Zulfi Wedding</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">

  {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

  <script src="https://unpkg.com/gsap@3/dist/gsap.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Serif+Text:ital@0;1&family=Monsieur+La+Doulaise&family=Raleway:ital,wght@0,100..900;1,100..900&family=Rouge+Script&display=swap"
    rel="stylesheet">
  <link href="https://fonts.cdnfonts.com/css/brittany-signature" rel="stylesheet">

  <link rel="preload" as="image" href="{{ asset('assets/images/nz.png') }}">
  <link rel="preload" as="image" href="{{ asset('assets/images/circle.png') }}">
  
  <link rel="stylesheet" href="{{ asset('assets/css/build.css') }}">
  <script src="{{ asset('assets/js/build.js') }}"></script>

  <style>
    .fade-in {
      animation: fadeIn 2s ease-in-out forwards;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: scale(0.9);
      }

      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    .navbar-minimized {
      height: 40px;
      opacity: 0.6;
    }

    .navbar-full {
      height: 60px;
      opacity: 1;
    }
  </style>
  <style>
    .scrollbar-hide::-webkit-scrollbar {
      display: none;
    }

    .scrollbar-hide {
      -ms-overflow-style: none;
      /* IE/Edge */
      scrollbar-width: none;
      /* Firefox */
    }
  </style>

  <style>
    @keyframes floatyText {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-6px);
      }
    }

    @keyframes shimmer {
      0% {
        background-position: -200px 0;
      }

      100% {
        background-position: 200px 0;
      }
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: scale(0.98);
      }

      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    .animate-float {
      animation: floatyText 4s ease-in-out infinite;
    }

    .animate-progress {
      background-size: 200% 100%;
      animation: shimmer 1.5s linear infinite;
    }

    .animate-fadeIn {
      animation: fadeIn 0.6s ease-out forwards;
    }
  </style>
</head>

<body class="bg-white text-gray-800">
  <audio id="bg-music" autoplay loop>
    <source src="{{ asset('assets/music/music1.mp3') }}" type="audio/mpeg">
    Your browser does not support the audio element.
  </audio>

  @include('partials.landing')

  @include('partials.transition')

  @include('partials.pre-loader')

  <section id="mainContent" class="hidden flex flex-col min-h-screen bg-white">
    <div class="flex-1 overflow-y-auto scroll-smooth">
      @include('partials.opening')
      @include('partials.couple')
      @include('partials.date')
      @include('partials.quotes')
      @include('partials.barcode')
      @include('partials.gallery')
      @include('partials.wedding-gift')
    </div>
    @include('partials.navbar')
  </section>

  <script src="{{asset('assets/js/main.js')}}"></script>
  <script src="{{asset('assets/js/preLoader.js')}}"></script>
</body>

</html>
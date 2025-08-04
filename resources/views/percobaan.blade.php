<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Wedding Invitation</title>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <script src="https://unpkg.com/gsap@3/dist/gsap.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Text:ital@0;1&family=Monsieur+La+Doulaise&family=Raleway:ital,wght@0,100..900;1,100..900&family=Rouge+Script&display=swap"
        rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/brittany-signature" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets_new/css/build2.css') }}">
    <script src="{{ asset('assets_new/js/build2.js') }}"></script>

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

</head>

<body class="bg-white text-gray-800">
    <audio id="bg-music" autoplay loop>
        <source src="{{ asset('assets_new/music/music1.mp3') }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    @include('percobaan.landing')

    @include('percobaan.transition')

    <section id="mainContent" class="hidden flex flex-col min-h-screen bg-white">
        <div class="flex-1 overflow-y-auto scroll-smooth">
            @include('percobaan.opening')
            @include('percobaan.couple')
            @include('percobaan.date')
        </div>
        @include('percobaan.navbar')
    </section>

    <script src="{{asset('assets_new/js/percobaan.js')}}"></script>
</body>

</html>
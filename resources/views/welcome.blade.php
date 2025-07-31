<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>Nabila & Zulfi Wedding</title>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <script src="https://unpkg.com/gsap@3/dist/gsap.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Text:ital@0;1&family=Monsieur+La+Doulaise&family=Raleway:ital,wght@0,100..900;1,100..900&family=Rouge+Script&display=swap"
        rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/brittany-signature" rel="stylesheet">

    
    <link rel="stylesheet" href="{{ asset('assets_new/css/build.css') }}">
    <script src="{{ asset('assets_new/js/build.js') }}"></script>
</head>

<body class="relative h-screen overflow-hidden">
    <audio id="bg-music" autoplay loop>
        <source src="{{ asset('assets_new/music/music1.mp3') }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <div id="intro-screen"
        class="h-screen w-screen flex items-center justify-center bg-cover bg-center bg-no-repeat relative"
        style="background-image: url('{{ asset('assets_new/images/background-red.png') }}');">

        <!-- Decorative Flowers -->
        <img id="flower1"
            class="absolute right-[-60px] lg:bottom-[-120px] bottom-[-50px] lg:w-[30%] md:w-[40%] w-[50%] h-auto z-20"
            src="{{ asset('assets_new/images/flower-1.png') }}" alt="flower" />
        <img id="flower2"
            class="absolute left-[-60px] lg:left-[-200px] lg:top-[-120px] top-[-80px] lg:w-[30%] md:w-[40%] w-[50%] h-auto z-20"
            src="{{ asset('assets_new/images/flower-2.png') }}" alt="flower" />

        <!-- Corners -->
        <img id="borderTR" class="absolute top-[20px] right-[20px] lg:w-[10%] w-[25%] h-auto z-20"
            src="{{ asset('assets_new/images/border-tr.png') }}" />
        <img id="borderBL" class="absolute bottom-[20px] left-[20px] lg:w-[10%] w-[25%] h-auto z-20"
            src="{{ asset('assets_new/images/border-bl.png') }}" />

        <!-- Centered Content -->
        <div class="z-30 text-center flex flex-col items-center justify-center w-full max-w-screen-md px-4">
            <h2 class="font-brittany text-white text-5xl md:text-6xl lg:text-7xl mb-6">
                The Wedding Of
            </h2>

            <div class="relative w-[70%] md:w-[50%] lg:w-[40%] aspect-square mx-auto mb-6">
                <img id="circle" class="absolute inset-0 w-full h-full object-contain z-10"
                    src="{{ asset('assets_new/images/circle.png') }}" />
                <img id="nz"
                    class="absolute top-1/2 left-1/2 w-[60%] h-auto z-20 transform -translate-x-1/2 -translate-y-1/2"
                    src="{{ asset('assets_new/images/nz.png') }}" />
            </div>

            <div class="text-white text-lg md:text-xl font-dmSerif mb-6">
                To: John Doe & Family
            </div>

            <button id="openInvitation" onclick="enterInvitation()" class="relative overflow-hidden group px-10 py-5 text-2xl font-brittany rounded-full 
               bg-[#fffded] text-[#641b0f] shadow-lg shadow-[#fffded]/20
               transition-transform duration-300 ease-out
               hover:scale-105">
                <span class="absolute inset-0 bg-gradient-to-r from-red-200 via-white to-red-200
                     transform -translate-x-full group-hover:translate-x-0
                     transition-transform duration-500 ease-out"></span>

                <span class="relative z-10 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                        <polyline points="22,6 12,13 2,6" />
                    </svg>
                    Open Invitation
                </span>
            </button>
        </div>
    </div>


    <div id="transition-screen"
        class="fixed inset-0 bg-white flex items-center justify-center opacity-0 pointer-events-none">
        <img id="transition-img" src="{{ asset('assets_new/images/background-image.png') }}"
            class="w-full h-screen opacity-0 object-cover" alt="Transition" />

        <img id="ground" src="{{asset('assets_new/images/ground.png')}}"
            class="lg:w-full w-[120%] h-auto lg:bottom-[-100px] md:bottom-[-20px] bottom-0 absolute opacity-0" />

        <img id="bride" src="{{asset('assets_new/images/bride.png')}}"
            class="lg:w-[40%] md:w-[70%] w-[100%] h-auto lg:bottom-[-200px] md:bottom-[-100px] bottom-[-50px] absolute opacity-0 z-30" />

        <img id="birds" src="{{asset('assets_new/images/birds.png')}}"
            class="lg:w-[20%] md:w-[40%] w-[60%] h-auto md:bottom-[300px] bottom-[200px] left-[-200px] absolute opacity-0" />

        <img id="cloud" src="{{asset('assets_new/images/awan.png')}}"
            class="w-[30%] h-auto top-[200px] left-[-200px] absolute opacity-0" />

        <img id="cloud2" src="{{asset('assets_new/images/awan.png')}}"
            class="w-[30%] h-auto top-[100px] left-[-500px] absolute opacity-0" />

        <img id="leftLeaf" src="{{asset('assets_new/images/daun-kiri.png')}}"
            class="lg:w-[30%] md:w-[50%] w-[70%] h-auto top-0 lg:left-[-200px] left-[-100px] absolute opacity-0" />

        <img id="leftLeaf2" src="{{asset('assets_new/images/daun-kiri.png')}}"
            class="lg:w-[30%] md:w-[50%] w-[70%] h-auto lg:top-[-300px] top-[-100px] lg:left-[-100px] left-[-100px] absolute rotate-2 opacity-0" />

        <img id="rightLeaf" src="{{asset('assets_new/images/daun-kanan.png')}}"
            class="lg:w-[30%] md:w-[50%] w-[70%] h-auto top-0 lg:right-[-200px] right-[-100px] absolute opacity-0" />

        <img id="rightLeaf2" src="{{asset('assets_new/images/daun-kanan.png')}}"
            class="lg:w-[30%] md:w-[50%] w-[70%] h-auto lg:top-[-300px] top-[-100px] lg:right-[-100px] right-[-100px] absolute rotate-2 opacity-0" />

        <img id="leftFlower" src="{{asset('assets_new/images/flower3.png')}}"
            class="lg:w-[25%] md:w-[30%] w-[50%] h-auto lg:bottom-[-100px] bottom-[-20px] left-0 absolute opacity-0 z-50 rotate-4" />

        <img id="leftLeaf3" src="{{asset('assets_new/images/daun-kiri.png')}}"
            class="lg:w-[30%] w-[50%] h-auto bottom-[-300px] left-[200px] absolute opacity-0 -rotate-[10deg]" />

        <img id="rightFlower" src="{{asset('assets_new/images/flower4.png')}}"
            class="lg:w-[25%] md:w-[30%] w-[50%] h-auto lg:bottom-[-100px] bottom-[-20px] right-0 absolute opacity-0 rotate-2 z-50" />

        <img id="rightLeaf3" src="{{asset('assets_new/images/daun-kanan.png')}}"
            class="lg:w-[30%] w-[50%] h-auto bottom-[-300px] right-[200px] absolute opacity-0 -rotate-[10deg]" />

    </div>

    <div id="main-content" class="hidden">
        @include('pages.opening')

        @include('pages.couple')

        @include('pages.date')

        @include('pages.quotes')

        @include('pages.barcode')

        @include('pages.gallery')

        @include('pages.wedding-gift')

        @include('pages.navbar')
    </div>

    <script src="{{asset('assets_new/js/main.js')}}"></script>

</body>

</html>
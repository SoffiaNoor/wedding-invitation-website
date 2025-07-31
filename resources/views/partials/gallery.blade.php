<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>Nabila & Zulfi Wedding</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/gsap@3/dist/gsap.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Text:ital@0;1&family=Monsieur+La+Doulaise&family=Raleway:ital,wght@0,100..900;1,100..900&family=Rouge+Script&display=swap"
        rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/brittany-signature" rel="stylesheet">
    {{-- <script src="{{asset('assets_new/js/transition.js')}}"></script> --}}

</head>

<body class="relative h-screen overflow-hidden">
    <div id="gallery" class="page-section h-screen w-screen flex flex-col items-center justify-center 
           bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('assets_new/images/background-red.png') }}');">

        <div class="absolute top-28 w-full text-center z-10">
            <h2 class="font-brittany text-7xl text-white">
                Piece of our Memories
            </h2>
        </div>

        <img class="absolute top-[300px] right-[-100px] w-[20%] h-auto z-10"
            src="{{ asset('assets_new/images/gallery-leaf-r.png') }}" alt="flower" />

        <img class="absolute bottom-0 right-[-60px] w-[20%] h-auto z-20"
            src="{{ asset('assets_new/images/gallery-flower-r.png') }}" alt="flower" />

        <img class="absolute top-[200px] left-[-100px] w-[20%] h-auto z-10"
            src="{{ asset('assets_new/images/gallery-leaf-l.png') }}" alt="flower" />

        <img class="absolute bottom-[-100px] left-[-200px] w-[35%] h-auto z-20"
            src="{{ asset('assets_new/images/gallery-flower-l.png') }}" alt="flower" />

        <div class="relative z-10 w-full max-w-4xl grid grid-cols-3 gap-4">
            <div class="col-span-2 row-span-2 grid grid-cols-2 grid-rows-2 gap-4">
                <img src="{{asset('assets_new/images/galeri-1.png')}}" alt="Couple 1"
                    class="w-full h-full object-cover rounded-xl shadow-lg transition-transform duration-300 hover:scale-105" />
                <img src="{{asset('assets_new/images/galeri-2.png')}}" alt="Couple 2"
                    class="w-full h-full object-cover rounded-xl shadow-lg transition-transform duration-300 hover:scale-105" />
                <img src="{{asset('assets_new/images/galeri-3.png')}}" alt="Couple 3"
                    class="w-full h-full object-cover rounded-xl shadow-lg transition-transform duration-300 hover:scale-105" />
                <img src="{{asset('assets_new/images/galeri-4.png')}}" alt="Couple 4"
                    class="w-full h-full object-cover rounded-xl shadow-lg transition-transform duration-300 hover:scale-105" />
            </div>

            <img src="{{asset('assets_new/images/galeri-5.png')}}" alt="Couple 5"
                class="row-span-2 w-full h-full object-cover rounded-xl shadow-lg transition-transform duration-300 hover:scale-105" />
        </div>
    </div>

    @include('pages.navbar')
</body>

</html>
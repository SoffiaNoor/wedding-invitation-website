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
    <div id="opening" class="page-section h-screen w-screen flex flex-col items-center justify-center 
           bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('assets_new/images/background-cream.png') }}');">

        <img class="opening-flower-1 absolute lg:bottom-[-120px] md:bottom-[-100px] bottom-[-50px] right-[-60px] lg:w-[30%] md:w-[40%] w-[60%] h-auto z-20 flower1"
            src="{{ asset('assets_new/images/flower-1.png') }}" alt="flower" />
        <img class="opening-flower-2 absolute lg:bottom-[-120px] bottom-[-50px] lg:left-[-200px] left-[-100px] lg:w-[30%] md:w-[45%] w-[60%] h-auto z-20 flower2"
            src="{{ asset('assets_new/images/flower-2.png') }}" alt="flower" />

        <img class="absolute top-[30px] right-[30px] lg:w-[10%] md:w-[20%] w-[30%] h-auto z-40"
            src="{{ asset('assets_new/images/border-tr2.png') }}" />
        <img class="absolute top-[30px] left-[30px] lg:w-[10%] md:w-[20%] w-[30%] h-auto z-40"
            src="{{ asset('assets_new/images/border-tl.png') }}" />

        <div class="title-wrapper absolute lg:top-28 top-[200px] w-full text-center z-10">
            <h2 class="font-brittany lg:text-7xl text-5xl text-[#641b0f]">
                The Wedding Of
            </h2>
        </div>

        <div class="date-wrapper absolute lg:top-[280px] md:top-[350px] top-[300px] justify-center inset-0 absolute text-center z-20">
            <img class="object-cover lg:w-[15%] md:w-[40%] w-[60%] relative h-auto place-self-center"
                src="{{ asset('assets_new/images/nz.png') }}" />
        </div>

        <div class="date-text absolute bottom-[250px] w-full text-center z-10">
            <h2 class="font-dmSerif lg:text-4xl text-3xl text-[#641b0f] font-light">
                Jum’at | 05 Sept 2025
            </h2>
            <h2 class="font-dmSerif lg:text-5xl text-4xl text-[#641b0f] lg:mt-5 mt-3">
                Save The Date
            </h2>
        </div>
    </div>

    @include('pages.navbar')
</body>

</html>
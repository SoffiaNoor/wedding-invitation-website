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
    <div id="couple" class="h-screen w-screen flex flex-col items-center justify-center 
           bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('assets_new/images/background-red.png') }}');">
        <img class="absolute top-0 w-[30%] h-auto z-20" src="{{ asset('assets_new/images/flower-on-top.png') }}"
            alt="flower" />
        <img class="absolute bottom-0 right-0 w-[30%] h-auto z-20"
            src="{{ asset('assets_new/images/couple-flower-r.png') }}" alt="flower" />
        <img class="absolute bottom-0 left-0 w-[30%] h-auto z-20"
            src="{{ asset('assets_new/images/couple-flower-l.png') }}" alt="flower" />


        <div class="absolute top-[220px] w-full text-center z-10">
            <h2 class="font-dmSerif text-4xl text-white">
                Barcode </br>
                to enter our wedding
            </h2>
            <div class="mx-5 mt-10">
                <img src="{{asset('assets_new/images/barcode2.png')}}" class="mx-auto" />
            </div>
        </div>
    </div>

    @include('pages.navbar')
</body>

</html>
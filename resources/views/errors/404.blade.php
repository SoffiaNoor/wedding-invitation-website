<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Nabiilah & Zulfi Wedding</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Text:ital@0;1&family=Monsieur+La+Doulaise&family=Raleway:ital,wght@0,100..900;1,100..900&family=Rouge+Script&display=swap"
        rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/brittany-signature" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/build.css') }}">
    <script src="{{ asset('assets/js/build.js') }}"></script>
</head>

<body class="bg-white text-gray-800">
    <section id="landing"
        class="relative min-h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat overflow-hidden"
        style="background-image: url('{{ asset('assets/images/background-red.png') }}');">

        <img id="flower1"
            class="absolute right-[-60px] lg:bottom-[-120px] bottom-[-50px] lg:w-[30%] md:w-[40%] w-[50%] h-auto z-20"
            src="{{ asset('assets/images/flower-1.png') }}" alt="decorative flower" />
        <img id="flower2"
            class="absolute left-[-60px] lg:left-[-200px] lg:top-[-120px] top-[-80px] lg:w-[30%] md:w-[40%] w-[50%] h-auto z-20"
            src="{{ asset('assets/images/flower-2.png') }}" alt="decorative flower" />

        <img id="borderTR" class="absolute top-[20px] right-[20px] lg:w-[10%] w-[25%] h-auto z-20"
            src="{{ asset('assets/images/border-tr.png') }}" alt="border top right" />
        <img id="borderBL" class="absolute bottom-[20px] left-[20px] lg:w-[10%] w-[25%] h-auto z-20"
            src="{{ asset('assets/images/border-bl.png') }}" alt="border bottom left" />

        <div class="z-30 text-center flex flex-col items-center justify-center w-full px-6">
            <h2 class="font-dmSerif text-white text-4xl md:text-6xl lg:text-7xl mb-2">
                404
            </h2>

            <div class="relative w-[40%] md:w-[40%] lg:w-[20%] aspect-square mx-auto">
                <img id="circle" class="absolute inset-0 w-full h-full object-contain z-10"
                    src="{{ asset('assets/images/circle.png') }}" alt="decorative circle" />
                <img id="nz"
                    class="absolute top-1/2 left-1/2 w-[50%] lg:w-[60%] h-auto z-20 transform -translate-x-1/2 -translate-y-1/2"
                    src="{{ asset('assets/images/nz.png') }}" alt="logo placeholder" />
            </div>

            <div class="font-dmSerif text-white text-lg md:text-xl font-dmSerif mt-5">
                Oops — the page you’re looking for can’t be found.
            </div>
        </div>
    </section>
</body>

</html>
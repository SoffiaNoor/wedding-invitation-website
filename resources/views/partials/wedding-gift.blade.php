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
    <div id="weddingGift" class="page-section h-screen w-screen flex flex-col items-center justify-center 
           bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('assets_new/images/background-cream.png') }}');">

        <img class="wedding-gift-leaf-r  absolute lg:bottom-[-100px] bottom-[-70px] lg:right-[-100px] right-[20px] lg:w-[25%] w-[40%] h-auto z-10"
            src="{{ asset('assets_new/images/gallery-leaf-r.png') }}" alt="flower" />

        <img class="wedding-gift-bride absolute lg:bottom-[-300px] bottom-[-100px] lg:right-[-100px] right-[-50px] lg:w-[30%] md:w-[45%] w-[60%] h-auto z-10"
            src="{{ asset('assets_new/images/pengantin-wanita.png') }}" alt="flower" />

        <img class="wedding-gift-leaf-l absolute lg:bottom-[-100px] bottom-[-70px] lg:left-[-100px] left-[20px] lg:w-[25%] w-[40%] h-auto z-10"
            src="{{ asset('assets_new/images/gallery-leaf-l.png') }}" alt="flower" />

        <img class="wedding-gift-groom absolute lg:bottom-[-300px] bottom-[-100px] lg:left-[-100px] left-[-50px] lg:w-[30%] md:w-[45%] w-[60%] h-auto z-10"
            src="{{ asset('assets_new/images/pengantin-pria.png') }}" alt="flower" />

        <img class="wedding-gift-flower-3 absolute lg:bottom-[-120px] bottom-[-40px] right-[-60px] lg:w-[15%] md:w-[25%] w-[35%] h-auto z-20"
            src="{{ asset('assets_new/images/flower3.png') }}" alt="flower" />

        <img class="wedding-gift-flower-4 absolute lg:bottom-[-120px] bottom-[-40px] left-[-60px] lg:w-[15%] md:w-[25%] w-[35%] h-auto z-20"
            src="{{ asset('assets_new/images/flower4.png') }}" alt="flower" />

        <div
            class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-screen-md px-4 text-center z-10">

            <h2 class="wedding-gift-title font-brittany text-3xl sm:text-5xl md:text-6xl text-[#641b0f] mb-6">
                Wedding Gift
            </h2>

            <div
                class="wedding-gift-text font-dmSerif text-base sm:text-lg md:text-2xl text-[#641b0f] leading-relaxed mt-5">
                Doa restu Anda adalah anugerah terindah bagi kami. <br />
                Dan apabila Bapak/Ibu berkenan mengungkapkan tanda kasih melalui hadiah,
                kami juga menyediakan pilihan pemberian secara cashless.
            </div>
        </div>

    </div>

    @include('pages.navbar')
</body>

</html>
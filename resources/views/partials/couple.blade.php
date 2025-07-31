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
        style="background-image: url('{{ asset('assets_new/images/background-cream.png') }}');">
        <img class="absolute bottom-0 right-0 lg:w-[30%] md:w-[40%] w-[50%] h-auto z-20"
            src="{{ asset('assets_new/images/couple-flower-r.png') }}" alt="flower" />
        <img class="absolute bottom-0 left-0 lg:w-[30%] md:w-[40%] w-[50%] h-auto z-20"
            src="{{ asset('assets_new/images/couple-flower-l.png') }}" alt="flower" />

        <div class="absolute lg:top-24 md:top-20 top-10 justify-center text-center mx-auto w-full text-center z-10">
            <img src="{{asset('assets_new/images/bismillah.png')}}"
                class="place-self-center mx-auto lg:w-[20%] md:w-[40%] w-[60%]" />
        </div>

        <div class="absolute lg:top-[220px] md:top-[240px] top-[150px] w-full text-center z-10">
            <h2 class="font-dmSerif lg:text-2xl md:text-xl text-lg text-[#641b0f]">
                Assalamualaikum Wr. Wb.
            </h2>
            <div class="lg:mx-20 md:mx-3 mx-2 lg:px-40 md:px-3 px-2 text-center mt-5">
                <div class="font-dmSerif lg:text-2xl md:text-xl text-lg text-[#641b0f]">
                    Dengan penuh rasa syukur dan ridho Allah Subhanahu wa ta’ala kami bermaksud
                </div>
                <div class="font-dmSerif lg:text-2xl md:text-xl text-lg text-[#641b0f]">
                    mengundang saudara untuk menghadiri acara pernikahan putra dan putri kami,
                </div>
            </div>
            <div class="lg:mx-20 mx-2 lg:px-40 px-2 text-center lg:mt-10 mt-5">
                <div class="font-rouge lg:text-5xl md:text-5xl text-4xl font-semibold text-[#641b0f]">
                    Nabiilah Dwi Putri Fatmawati S.Ikom
                </div>
            </div>
            <div class="lg:mx-20 mx-2 lg:px-40 px-2 text-center mt-5">
                <div class="font-dmSerif lg:text-2xl md:text-xl text-lg text-[#641b0f]">
                    Putri </br>
                    dari H. Fatchur Rochman & Hj. Rachmawati
                </div>
            </div>
            <div class="font-rouge lg:text-5xl text-4xl font-semibold text-[#641b0f]">
                &
            </div>
            <div class="lg:mx-20 mx-2 lg:px-40 px-2 text-center lg:mt-10 mt-5">
                <div class="font-rouge lg:text-5xl md:text-5xl text-4xl font-semibold text-[#641b0f]">
                    Mochammad Zulfi S. Kom
                </div>
            </div>
            <div class="lg:mx-20 mx-2 lg:px-40 px-2 text-center mt-5">
                <div class="font-dmSerif lg:text-2xl md:text-xl text-lg text-[#641b0f]">
                    Putra </br>
                    dari Anis (alm) & Yayuk Siti Rahayu
                </div>
            </div>
        </div>
    </div>

    @include('pages.navbar')
</body>

</html>
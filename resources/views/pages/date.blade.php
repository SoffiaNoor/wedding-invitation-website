<div id="date" class="page-section h-screen w-screen flex flex-col items-center justify-center 
           bg-cover bg-center bg-no-repeat hidden"
    style="background-image: url('{{ asset('assets_new/images/background-cream.png') }}');">
    <img class="date-flower-1 absolute bottom-[-50px] right-[-60px] lg:w-[20%] md:w-[40%] w-[50%] h-auto z-20"
        src="{{ asset('assets_new/images/flower-1.png') }}" alt="flower" />
    <img class="date-flower-2 absolute lg:top-[100px] top-[-100px] lg:left-[-200px] left-[-100px] lg:w-[35%] md:w-[40%] w-[60%] h-auto z-20"
        src="{{ asset('assets_new/images/flower-2.png') }}" alt="flower" />

    <div
        class="absolute lg:top-[170px] md:top-[250px] top-[150px] justify-center text-center mx-auto w-full text-center z-10">
        <h2 class="font-dmSerif lg:text-2xl md:text-2xl text-xl text-[#641b0f]">
            Majelis Pernikahan akan berlangsung pada
        </h2>
        <div class="lg:mx-20 md:mx-3 mx-2 lg:px-40 text-center lg:mt-10 mt-5">
            <div class="font-rouge lg:text-7xl text-5xl font-semibold text-[#641b0f]">
                Jum’at
            </div>
            <div class="font-raleway lg:text-4xl text-2xl text-[#641b0f]">
                05.09.2025
            </div>
        </div>
        <div class="lg:mx-20 md:mx-3 mx-2 lg:px-40 text-center lg:mt-10 mt-5">
            <h2 class="font-dmSerif lg:text-2xl md:text-2xl text-xl text-[#641b0f]">
                Akad Nikah:
            </h2>
            <div class="font-raleway lg:text-4xl text-2xl text-[#641b0f]">
                07.00 - 08.00
            </div>
        </div>
        <img src="{{asset('assets_new/images/line-decor.png')}}"
            class="lg:w-[20%] w-[70%] h-auto place-self-center mx-auto my-5" />
        <div class="lg:mx-20 md:mx-3 mx-2 lg:px-40 text-center lg:mt-10 mt-5">
            <h2 class="font-dmSerif lg:text-2xl md:text-2xl text-xl text-[#641b0f]">
                Lokasi Majelis
            </h2>
            <div class="font-rouge lg:text-6xl text-4xl font-semibold text-[#641b0f] mt-2">
                Gedung Pertemuan Widya Kartika
            </div>
            <div class="font-dmSerif lg:text-2xl md:text-2xl text-xl text-[#641b0f] mt-2">
                (Jl. Dukuh Kupang Timur XIII No.12, Pakis, Sawahan, Surabaya)
            </div>
        </div>
    </div>

    <div
        class="absolute lg:right-[300px] md:bottom-[200px] bottom-[120px] lg:top-1/2 lg:transform lg:-translate-y-1/2 z-50">
        <div class="mx-5">
            <div class="font-dmSerif font-bold uppercase lg:text-2xl text-lg text-[#641b0f]">SCAN QR LOCATION</div>
            <img src="{{asset('assets_new/images/barcode.png')}}"
                class="date-barcode mt-5 mx-auto lg:w-[70%] w-[40%]" />
        </div>
    </div>
</div>
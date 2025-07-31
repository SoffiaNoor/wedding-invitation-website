<div id="date" class="page-section h-screen w-screen flex flex-col items-center justify-center 
        bg-cover bg-center bg-no-repeat hidden relative text-center px-4"
    style="background-image: url('{{ asset('assets_new/images/background-cream.png') }}');">

    <!-- Background Flowers -->
    <img class="date-flower-1 absolute bottom-[-50px] right-[-60px] lg:w-[20%] md:w-[40%] w-[50%] h-auto z-10"
        src="{{ asset('assets_new/images/flower-1.png') }}" alt="flower" />
    <img class="date-flower-2 absolute lg:top-[100px] top-[-100px] lg:left-[-200px] left-[-100px] lg:w-[35%] md:w-[40%] w-[50%] h-auto z-10"
        src="{{ asset('assets_new/images/flower-2.png') }}" alt="flower" />

    <!-- Main Content -->
    <div class="z-20 w-full max-w-3xl mx-auto space-y-4">
        <h2 class="font-dmSerif text-base md:text-lg text-[#641b0f]">
            Majelis Pernikahan akan berlangsung pada
        </h2>

        <div class="space-y-1">
            <div class="font-rouge font-bold text-3xl md:text-5xl text-[#641b0f]">Jum’at</div>
            <div class="font-raleway text-base md:text-xl text-[#641b0f]">05.09.2025</div>
        </div>

        <div class="space-y-1">
            <h2 class="font-dmSerif text-base md:text-lg text-[#641b0f]">Akad Nikah:</h2>
            <div class="font-raleway text-base md:text-xl text-[#641b0f]">07.00 - 08.00</div>
        </div>

        <img src="{{asset('assets_new/images/line-decor.png')}}" class="date-line-decor w-[60%] md:w-[15%] h-auto mx-auto my-1" />

        <div class="space-y-1">
            <h2 class="font-dmSerif text-base md:text-lg text-[#641b0f]">Lokasi Majelis</h2>
            <div class="font-rouge font-bold text-2xl md:text-4xl text-[#641b0f]">
                Gedung Pertemuan Widya Kartika
            </div>
            <div class="font-dmSerif text-sm md:text-base text-[#641b0f]">
                (Jl. Dukuh Kupang Timur XIII No.12, Pakis, Sawahan, Surabaya)
            </div>
        </div>

        <!-- QR Code Section -->
        <div class="pt-2">
            <div class="font-dmSerif font-bold uppercase text-sm md:text-base text-[#641b0f]">
                SCAN QR LOCATION
            </div>
            <img src="{{asset('assets_new/images/barcode.png')}}" class="date-location-barcode mt-3 mx-auto w-[30%] md:w-[25%]" />
        </div>
    </div>
</div>